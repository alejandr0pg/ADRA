<?php

namespace Modules\Donors\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
//
use Modules\Donors\Entities\Donors;
use Modules\Donors\Entities\Origin;
use Modules\Country\Entities\Country;

class DonorsController extends Controller
{
    public function __construct()
    {      
        // Pagina para el menú
        $page = route('donors.index');

        // Compartimos la variable
        view()->share(compact('page'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $donors = Donors::paginate();
        $origins = Origin::all();
        $countries = Country::all();

        return view('donors::index', compact('donors', 'countries', 'origins'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('donors::create');
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
            'name' => "required|string|max:191|unique:donors",
            'origin' => 'required|integer|max:11',
            'contact_name' => 'required|string|max:191',
            'contact_phone' => 'required|string|max:191',
            'contact_email' => 'required|string|max:191',
            'vigency' => 'required|string|max:191'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $donor = new Donors;
        $donor->name = $request->name;
        $donor->origin_id = $request->origin;
        $donor->contact_name = $request->contact_name;
        $donor->contact_email = $request->contact_email;
        $donor->contact_phone = $request->contact_phone;
        $donor->vigency = $request->vigency ? 1 : 0;
        $donor->save();

        return redirect('admin/donors')
                ->with('action', 'create');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('donors::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $donor = Donors::findOrFail($id);

        $origins = Origin::all();
        $countries = Country::all();

        return view('donors::update', compact('donor', 'origins', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $donor = Donors::findOrFail($id);
        // Validaciones
        $validator = \Validator::make($request->all(), [
            'name' => "required|string|max:191|unique:donors,name,$donor->id",
            'origin' => 'required|integer|max:11',
            'contact_name' => 'required|string|max:191',
            'contact_phone' => 'required|string|max:191',
            'contact_email' => 'required|string|max:191',
            'vigency' => 'required|string|max:191'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $donor->name = $request->name;
        $donor->origin_id = $request->origin;
        $donor->contact_name = $request->contact_name;
        $donor->contact_email = $request->contact_email;
        $donor->contact_phone = $request->contact_phone;
        $donor->vigency = $request->vigency ? 1 : 0;
        $donor->save();

        return redirect('admin/donors')
                ->with('action', 'update');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $donor = Donors::findOrFail($id);
            
        $donor->delete();   
     
        return redirect('/admin/donors')
                ->with('action', 'destroy');
    }
}
