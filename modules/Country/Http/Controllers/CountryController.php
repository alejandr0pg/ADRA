<?php

namespace Modules\Country\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
//
use Modules\Country\Entities\Country;
use Modules\Currency\Entities\Currency;

class CountryController extends Controller
{
    public function __construct()
    {      
        // Pagina para el menú
        $page = route('countries.index');

        // Compartimos la variable
        view()->share(compact('page'));
    
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $countries =  Country::paginate(20);

        $currencies = Currency::all();

        return view('country::index', compact('countries', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $slug = str_slug($request->name, '-');

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:countries,slug,' . $slug,
            'currency' => 'required|integer|max:11',
            'lang' => 'required|integer|max:11',
            'iso' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        
        // Creamos el país.
        $country = Country::create([
            'slug' => $slug,
            'currency_id' => $request->currency,
            'lang_id' => $request->lang,
            'iso' => $request->iso
        ]);

        // Creamos una nueva traducción
        $translation = translations('countries-list');

        $translation->add($slug, $request->name);

        $translation->publish();

        return redirect('admin/settings/country')
                ->with('success' , trans('country::country.stored'));
    }

    public function modify($id)
    {
         return view('country::update', [
            'country' => Country::findOrFail($id),
            'currencies' => Currency::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // Obtenemos el país
        $country = Country::findOrFail($id);

        // Validaciones
        $validator = \Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('countries', 'slug')->ignore($country->id)->ignore($country->slug, 'slug')
            ],
            'currency' => "required|integer|max:11",
            'lang' => 'required|integer|max:11',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $country->currency_id = $request->currency;
        $country->lang_id = $request->lang;
        $country->iso = $request->iso;
        $country->save();

        // Modificamos la traducción
        $translation = translations('countries-list');

        $translation->add($country->slug, $request->name);

        $translation->publish();

        return redirect('admin/settings/country')
                ->with('success' , trans('country::country.updated'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy( $id )
    {
        $country = Country::findOrFail($id);
            
        $country->delete();
     
        return redirect('/admin/settings/country')
                ->with('success' , trans('country::country.destroyed'));
    }
}
