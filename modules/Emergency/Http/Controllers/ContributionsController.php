<?php

namespace Modules\Emergency\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Emergency\Entities\Contribution;

class ContributionsController extends Controller
{
    public function __construct()
    {      
        // Pagina para el menú
        $page = route('contributions.index');

        // Compartimos la variable
        view()->share(compact('page'));
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $contributions = Contribution::paginate();

        return view('emergency::contributions.index', compact('contributions'));
    }

    /**
     * 
     * @return Response
     */
    public function modify($id)
    {
        $contribution = Contribution::findOrFail($id);

        return view('emergency::contributions.update', compact('contribution'));    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $slug = str_slug($request->name, '-');

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:contributions,slug,' . $slug,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Creamos el país.
        $contribution = Contribution::create([
            'slug' => $slug,
        ]);

        // Creamos una nueva traducción
        $translation = translations('contributions-list');

        $translation->add($slug, $request->name);

        $translation->publish();

        return redirect()
                ->route('contributions.index')
                ->with('action' , 'created');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $contribution = Contribution::findOrFail($id);

        // Validaciones
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:contributions,slug,' . $contribution->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Creamos una nueva traducción
        $translation = translations('contributions-list');

        $translation->add($contribution->slug, $request->name);

        $translation->publish();

        return redirect()->route('contributions.index')->with('action', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $contribution = Contribution::findOrFail($id);

        $contribution->delete();

        return redirect()->route('contributions.index')->with('action', 'destroy');
    }
}
