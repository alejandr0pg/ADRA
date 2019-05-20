<?php

namespace Modules\Agency\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
//
use Modules\Agency\Entities\Agency;
use Modules\Country\Entities\Country;
use Modules\Currency\Entities\Currency;
use Modules\Agency\Entities\ProfileBankInformation;
use Modules\Agency\Entities\Treasury;
// 
use App\User;


class AgencyController extends Controller
{
    public function __construct(Request $request)
    {
        $page = route('agency');

        view()->share(compact('page'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $_agency = Agency::where('belong_to', 0);

        $agencies = Agency::paginate();

        $agencies_selects = $_agency->get();

        $countries = Country::all();

        $employees = User::role('employee')->get();

        return view('agency::index', compact('agencies', 'countries', 'agencies_selects', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validaciones
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:agencies',
            'country' => 'required|integer|max:11',
            'director' => 'required|integer|max:11',
            'mission' => 'required',
            'vision' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Creamos la agencia
        $agency = new Agency;
        $agency->name = $request->name;
        $agency->country_id = $request->country;
        $agency->belong_to = $request->belong_to ? $request->belong_to : 0;
        $agency->director_id = $request->director;
        $agency->mission = $request->mission;
        $agency->vision = $request->vision;
        $agency->vigency = $request->vigency ? 1 : 0;
        $agency->save();

        return redirect()
                ->route('agency')
                ->with('action', 'create');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $agency = Agency::findOrFail($id);
         
        $agencies_selects = Agency::where('belong_to', 0)->get();

        $countries = Country::all();

        $employees = User::role('employee')->get();

        return view('agency::update', compact('agency', 'countries', 'agencies_selects', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $agency = Agency::findOrFail($id);

        // Validaciones
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:agencies,name,' . $agency->id,
            'country' => 'required|integer|max:11',
            'director' => 'required|integer|max:11',
            'mission' => 'required',
            'vision' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Creamos la agencia
        $agency->name = $request->name;
        $agency->country_id = $request->country;
        $agency->belong_to = $request->belong_to ? $request->belong_to : 0;
        $agency->director_id = $request->director;
        $agency->mission = $request->mission;
        $agency->vision = $request->vision;
        $agency->vigency = $request->vigency ? 1 : 0;
        $agency->save();

        return redirect()
                ->route('agency')
                ->with('action', 'update');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $agency = Agency::findOrFail($id);
            
        $agency->delete();   
     
        return redirect()
                ->route('agency')
                ->with('action', 'destroy');
    }

    private function input($input, $model)
    {
        // Verficamos si tenemos 
        if( $old = old($input) ) {
            //
            return $old;
        } elseif($model && $model->count()) {
            //
            return $model->{$input};
        }

        return '';
    }

    public function getTreasuryInfo($id)
    {
        $agency = Agency::findOrFail($id);

        $treasury = $agency->treasury;

        if($treasury) {
            $user = User::find($treasury->receiver_id);

            $bankInfo = ProfileBankInformation::where('user_id', $user->id)->first();
            //
            view()->share(compact('user', 'bankInfo'));
        }

        $employees = User::role('employee')->get();

        $currencies = Currency::all();

        $input = function($input) use ($treasury) {
            return $this->input($input, $treasury);
        };

        return view('agency::treasury_info', compact('agency', 'treasury', 'employees', 'currencies', 'input'));
    }

    public function storeTreasuryInfo(Request $request, $id)
    {
        // Validaciones
        $validator = \Validator::make($request->all(), [
            'receiver_id' => 'required',
            'bank_name' => 'required',
            'bank_route' => 'required',
            'currency_id' => 'required',
            'counter_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $treasury = Treasury::firstOrCreate([
            'agency_id' => $id
        ]);

        $treasury->receiver_id = $request->receiver_id;
        $treasury->bank_name = $request->bank_name;
        $treasury->bank_route = $request->bank_route;
        $treasury->counter_id = $request->counter_id;
        $treasury->currency_id = $request->currency_id;
        $treasury->ivan = $request->ivan;
        $treasury->save();

        return redirect()->back()->with('action', 'updated');
    }

    public function profileTabBankInfo(Request $request)
    {
        $user = \Auth::user();
        $profile = $user->profile;

        $bankInfo = ProfileBankInformation::where('user_id', $user->id)->first();

        $input = function($input) use ($bankInfo) {
            return $this->input($input, $bankInfo);
        };

        return view('agency::tab-bank-info', compact('user', 'profile', 'bankInfo','input'));
    }

    public function profileTabBankInfoStore(Request $request)
    {
        // Validaciones
        $validator = \Validator::make($request->all(), [
            'bank_name' => 'required',
            'account_route' => 'required',
            'account_number' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $user = \Auth::user();

        $bankInfo = ProfileBankInformation::firstOrCreate([
            'user_id' => $user->id,
        ]);

        $bankInfo->bank_name = $request->bank_name;
        $bankInfo->account_route = $request->account_route;
        $bankInfo->account_number = $request->account_number;
        $bankInfo->save();

        return redirect('profile?tab=informacion-bancaria');
    }
}
