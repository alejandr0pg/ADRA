<?php

namespace Modules\Emergency\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use Modules\Emergency\Entities\Emergency;
use Modules\Emergency\Entities\Sitrep;
use Modules\Emergency\Entities\SitrepExtraInfo;
use Modules\Emergency\Entities\Files;
use Modules\Emergency\Entities\Contribution;
use Modules\Emergency\Entities\EventType;
use Modules\Emergency\Entities\Budget;
use Modules\Emergency\Entities\ConceptExpenditure;
use Modules\Emergency\Entities\Expenditure;

use Modules\Tasks\Entities\Task;
use Modules\Tasks\Entities\TasksChecklist;

use Modules\Currency\Entities\Currency;

use Modules\Donors\Entities\Donors;

use Modules\Agency\Entities\Agency;

use App\User;

use Carbon\Carbon;

//use Barryvdh\DomPDF\Facade as PDF;

class EmergencyController extends Controller
{
    public function __construct()
    {      
        // Pagina para el menú
        $page = route('emergency.index');

        // Compartimos la variable
        view()->share(compact('page'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $emergencies = Emergency::orderBy('created_at', 'desc');

        if( $request->has('agency') ) {
            $emergencies = $emergencies->where('agency_id', $request->agency);

            // Obtenemos la agencia, y comprobamos que sea una regional.
            $agency_selected = Agency::where('id', $request->agency)
                            ->where('belong_to', '>', 0)
                            ->where('vigency', 1)
                            ->firstOrFail();

            view()->share(compact('agency_selected'));
        }

        $format_date = function ($date, $dayPlus = false, $format = false) {
            return $this->format_date($date, $dayPlus, $format);
        };

        $agencies = Agency::where('belong_to', 0)->get();
        $emergencies = $emergencies->paginate();
        $types = EventType::all();
        $contributions = Contribution::all();
        $currencies = Currency::all();
        $employees = User::role('employee')->get();

        return view('emergency::index', compact('emergencies', 'types', 'contributions', 'currencies', 'employees', 'agencies', 'format_date'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'code' => 'required|string|max:192|unique:emergencies',
            'name' => 'required|string|max:192',
            'description' => 'required',
            'belong_to' => 'required',
            'type' => 'required',
            'contribution' => 'required',
            'currency' => 'required',
            'cordinator' => 'required',
            'start_date' => 'required',
            'event_date' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $agency = Agency::where('id', $request->belong_to)
        			->where('belong_to', '>', 0)->firstOrFail();

        $emergency = new Emergency;
        $emergency->agency_id = $agency->id;
        $emergency->country_id = $agency->country_id;
        $emergency->code = $request->code;
        $emergency->name = $request->name;
        $emergency->description = $request->description;
        $emergency->event_type_id = $request->type;
        $emergency->currency_id = $request->currency;
        $emergency->contribution_id = $request->contribution;
        $emergency->director_regional_id = $agency->director_id;
        $emergency->director_national_id = $agency->belongs_to->director_id;
        $emergency->cordinator_id = $request->cordinator;
        $emergency->event_date = $request->event_date;
        $emergency->start_date = $request->start_date;
        $emergency->status = $request->vigency ? 1 : 0;
        $emergency->save();

        return redirect()->route('emergency.index')->with('action', 'created');
    }

    public function modify($id)
    {
        $emergency = Emergency::findOrFail($id);
        $types = EventType::all();
        $contributions = Contribution::all();
        $currencies = Currency::all();
        $employees = User::role('employee')->get();

        view()->share([
            'agencies' => Agency::where('vigency', 1)->get()
        ]);

        return view('emergency::update', compact('emergency', 'types', 'contributions', 'currencies', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $agency = Agency::where('id', $request->belong_to)
        			->where('belong_to', '>', 0)->firstOrFail();

        $emergency = Emergency::findOrFail($id);

        $validator = \Validator::make($request->all(), [
            'code' => [
                'required',
                'string',
                'max:192',
                Rule::unique('emergencies')->ignore($emergency->id)
            ],
            'name' => 'required|string|max:192',
            'description' => 'required',
            'belong_to' => 'required',
            'type' => 'required',
            'contribution' => 'required',
            'currency' => 'required',
            'cordinator' => 'required',
            'start_date' => 'required',
            'event_date' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $emergency->agency_id = $agency->id;
        $emergency->country_id = $agency->country_id;
        $emergency->code = $request->code;
        $emergency->name = $request->name;
        $emergency->description = $request->description;
        $emergency->event_type_id = $request->type;
        $emergency->currency_id = $request->currency;
        $emergency->contribution_id = $request->contribution;
        $emergency->director_regional_id = $agency->director_id;
        $emergency->director_national_id = $agency->belongs_to->director_id;
        $emergency->cordinator_id = $request->cordinator;
        $emergency->event_date = $request->event_date;
        $emergency->start_date = $request->start_date;
        $emergency->status = $request->vigency ? 1 : 0;
        $emergency->save();

        return redirect()->route('emergency.index')->with('action', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $emergency = Emergency::findOrFail($id);

        $emergency->delete();

        return redirect()->route('emergency.index')->with('action', 'deleted');
    }

    public function dashboard($id)
    {
        $emergency = Emergency::findOrFail($id);

        $types = Task::all();

        $tasks = function($emergency) use ($types) {
            $data = collect([]);
            foreach ($types as $task) {
                $obj = $task;
                $obj['list'] = collect([]);

                foreach ($task->checklist as $checklist) {
                    
                    $checklist['checked'] = $this->taskIsChecked($checklist->id, $emergency);
                    
                    $obj['list']->push($checklist);
                }

                $data->push($obj);
            }

            return $data;
        };

        $expenditureConcepts = ConceptExpenditure::with(['expenditure' => function($query) use ($emergency){
            return $query->where('emergency_id', $emergency->id);
        }])->get();

        $documents = Files::where('type', 0)->where('emergency_id', $emergency->id)->get();

        $pictures = Files::where('type', 1)->where('emergency_id', $emergency->id)->get();

        $sitrep = Sitrep::where('emergency_id', $emergency->id)->first();

        $donors = Donors::where('vigency', 1)->get();

        $budgets = Budget::where('emergency_id', $emergency->id)->get();

        $currencies = Currency::all();

        $date = function($date){
            return new Carbon($date);
        };

        $format_date = function ($date, $dayPlus = false, $format = false) {
            return $this->format_date($date, $dayPlus, $format);
        };

        $diff = function($start_date, $end_date) {
            $date = new Carbon($start_date);
            $date->setLocale(config('app.locale'));
            $date = $date->diffForHumans($end_date, true);
            return $date;
        };

        return view('emergency::dashboard.index', compact('emergency', 'tasks', 'documents', 'sitrep', 'date', 'format_date', 'diff', 'pictures', 'types', 'donors', 'currencies', 'budgets', 'expenditureConcepts'));
    }

    public function budgetStore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'donor' => 'required|integer',
            'type' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'currency_origin' => 'required|integer',
            'quantity' => 'required',
            'tasa' => 'required',
            'emergency' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $emergency = Emergency::findOrFail($request->emergency);

        $budget = new Budget;
        $budget->emergency_id = $emergency->id;
        $budget->donor_id = $request->donor;
        $budget->budget_type = $request->type;
        $budget->description = $request->description;
        $budget->date = $request->date;
        $budget->origin_currency_id = $request->currency_origin;
        $budget->origin_amount = $request->quantity;
        $budget->tasa = $request->tasa;
        $budget->currency_id = $emergency->currency->id;
        $budget->total_amount = $request->quantity * $request->tasa;
        $budget->save();

        $emergency->budget += $budget->total_amount;
        $emergency->save();

        return redirect()->route('emergency.dashboard', $emergency->id)->with('action', 'updated-buget');
    }

    public function budgetDelete(Request $request, $emergency, $id)
    {
    	$budget = Budget::findOrFail($id);

    	$emergency = Emergency::findOrFail($emergency);

    	$emergency->budget -= $budget->total_amount;
    	$emergency->save();

    	$budget->delete();

    	return redirect()->back()->with('action', 'budget-deleted');
    }

    public function expenditureStore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'concept_expenditure' => 'required|integer',
            'description' => 'required|string',
            'date' => 'required|date',
            'amount' => 'required|integer',
            'proveedor' => 'required',
            'emergency' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $emergency = Emergency::findOrFail($request->emergency);

        $expenditure = new Expenditure;
        $expenditure->emergency_id = $emergency->id;
        $expenditure->concept_id = $request->concept_expenditure;
        $expenditure->currency_id = $emergency->currency->id;
        $expenditure->description = $request->description;
        $expenditure->date = $request->date;
        $expenditure->amount = $request->amount;
        $expenditure->proveedor = $request->proveedor;

        if($request->has('support')) {
            $expenditure->document_path = $this->uploadFile($request->file('support'), 'emergency/' . $request->emergency . '/supports');
        }

        $expenditure->save();

        $emergency->total_cost += $expenditure->amount;
        $emergency->save();

        return redirect()->route('emergency.dashboard', $emergency->id)->with('action', 'updated-expenditure');
    }

    public function expenditureDelete(Request $request, $emergency, $id)
    {
    	$expenditure = Expenditure::findOrFail($id);

    	$emergency = Emergency::findOrFail($emergency);
    	$emergency->total_cost -= $expenditure->amount;
    	$emergency->save();

    	$expenditure->delete();

    	return redirect()->back()->with('action', 'expenditure-deleted');
    }

    private function format_date($date, $dayPlus, $format)
    {
        $date = new Carbon($date);

        if($dayPlus) {
            $date = $date->addDay($dayPlus);
        }
        
        $date = $date->formatLocalized($format ? $format : '%d %B, %Y');

        return $date;
    }

    private function taskIsChecked($checklist, $emergency)
    {
        $task = DB::table('emergency_tasks_check')
            ->where('checklist_id', '=', $checklist)
            ->where('emergency_id', '=', $emergency)
            ->first();

        return $task ? true : false;
    }

    public function toggleTask(Request $request)
    {
        // Obtenemos el rol y el permiso.
        $emergency = Emergency::findOrFail($request->emergency);
        $task = TasksChecklist::findOrFail($request->task);

        if($this->taskIsChecked($task->id, $emergency->id)) {
            // Eliminamos el checked.
            DB::table('emergency_tasks_check')
                ->where('checklist_id', '=', $task->id)
                ->where('emergency_id', '=', $emergency->id)
                ->delete();
        } else {
            DB::table('emergency_tasks_check')->insert([
                'checklist_id' => $task->id,
                'emergency_id' => $emergency->id
            ]);
        }

        return response()->json([
            'error' => false
        ]);
    }

    private function uploadFile($file, $_path)
    {
        $time = time();

        $name = $time . md5($file->getClientOriginalName()) .'.'. $file->getClientOriginalExtension();

        $file->storeAs('public/uploads/' . $_path, $name);

        return 'storage/uploads/' . $_path . '/' . $name;
    }

    public function uploadDocument(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'doc' => 'required',
            'emergency' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $file_path = $this->uploadFile($request->file('doc'), 'emergency/' . $request->emergency . '/docs');

        $file = Files::create([
            'type' => 0,
            'path' => $file_path,
            'name' => $request->name,
            'file_type_id' => $request->type,
            'emergency_id' => $request->emergency
        ]);

        return redirect()->back()->with('action', 'uploaded-document');
    }

    public function uploadPicture(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'pic' => 'required',
            'emergency' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $file_path = $this->uploadFile($request->file('pic'), 'emergency/' . $request->emergency . '/pictures');

        $file = Files::create([
            'type' => 1,
            'path' => $file_path,
            'name' => $request->name,
            'file_type_id' => $request->type,
            'emergency_id' => $request->emergency
        ]);

        return redirect()->back()->with('action', 'uploaded-picture');
    }

    private function deleteFile($id)
    {
    	$file = Files::findOrFail($id);

    	$file->delete();

    	return true;
    }

    public function deletePicture(Request $request, $id)
    {
    	$picture = $this->deleteFile($id);

    	return redirect()->back()->with('action', 'picture-deleted');
    }


    public function deleteDocument(Request $request, $id)
    {
    	$picture = $this->deleteFile($id);

    	return redirect()->back()->with('action', 'document-deleted');
    }


    public function sitrep(Request $request, $emergency)
    {
        $emergency = Emergency::findOrFail($emergency);

        $sitrep = Sitrep::firstOrCreate([
            'emergency_id' => $emergency->id
        ]);

        $format_date = function ($date, $dayPlus = false, $format = false) {
            return $this->format_date($date, $dayPlus, $format);
        };

        $trans = function ($slug) {
            if(trans($slug) != $slug) {
                return trans($slug);
            } else {
                return '';
            }
        };

        return view('emergency::dashboard.sitrep.modify', compact('emergency', 'format_date', 'sitrep', 'trans'));
    }

    public function sitrepStore(Request $request, $emergency)
    {
        $emergency = Emergency::findOrFail($emergency);

        $sitrep = Sitrep::firstOrCreate([
            'emergency_id' => $emergency->id
        ]);

        $sitrep->latitud = $request->latitud;
        $sitrep->longitud = $request->longitud;
        $sitrep->save();

        // Creamos las traducciones
        $translation = translations('sitrep-' . $emergency->id . '-details');

        $translation->add('title', $request->title);
        $translation->add('emergency-info', $request->emergency_info);
        $translation->add('people-affected', $request->people_affected);
        $translation->add('humanitarian_situation', $request->humanitarian_situation);
        $translation->add('necessities_analysis', $request->necessities_analysis);
        $translation->add('response_activities', $request->response_activities);
        $translation->add('financing_opportunities', $request->financing_opportunities);
        $translation->add('other_difficulties', $request->other_difficulties);
        $translation->add('cluster_meetings', $request->cluster_meetings);
        $translation->add('coordination_organizations', $request->coordination_organizations);
        $translation->add('media', $request->media);
        $translation->add('quotes', $request->quotes);
        $translation->add('circulate_sitrep', $request->circulate_sitrep);

        $translation->publish();

        return redirect()->route('emergency.dashboard', $emergency->id)->with('action', 'updated-sitrep');
    }

    public function sitrepAddInfo(Request $request, $emergency)
    {
        $emergency = Emergency::findOrFail($emergency);

        $sitrep = Sitrep::firstOrCreate([
            'emergency_id' => $emergency->id
        ]);

        $info = new SitrepExtraInfo;
        $info->sitrep_id = $sitrep->id;
        $info->slug = $slug = str_slug($request->description);
        $info->value = $request->value;
        $info->save();

        // Creamos una nueva traducción
        $translation = translations('sitrep-extra-info-' . $emergency->id . '-list');
        $translation->add($slug, $request->description);
        $translation->publish();

        return response()->json([
            'error' => false,
            'view' => view('emergency::dashboard.sitrep.extra_info', compact('emergency', 'sitrep', 'info'))->render()
        ]);
    }

    public function sitrepInfoDelete(Request $request, $emergency, $sitrep)
    {
    	$emergency = Emergency::findOrFail($emergency);
    	$sitrep = Sitrep::findOrFail($sitrep);

    	$info = SitrepExtraInfo::findOrFail($request->extra_info);
    	$info->delete();

    	return response()->json([
    		'error' => false
    	]);
    }

    public function showPDF($emergency, $sitrep)
    {
    	$emergency = Emergency::findOrFail($emergency);

    	$sitrep = Sitrep::firstOrCreate([
            'emergency_id' => $emergency->id
        ]);

        $format_date = function ($date, $dayPlus = false, $format = false) {
            return $this->format_date($date, $dayPlus, $format);
        };

        $pictures = Files::where('type', 1)->where('emergency_id', $emergency->id)->get();

        $trans = function ($slug) {
            if(trans($slug) != $slug) {
                return trans($slug);
            } else {
                return '';
            }
        };

    	$pdf = \PDF::loadView('emergency::dashboard.sitrep.pdf', compact('emergency', 'sitrep', 'format_date', 'trans', 'pictures'));
        

		return $pdf->stream('sitrep.pdf');
    }
}
