<?php

namespace Modules\Emergency\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Emergency\Entities\EventType;

class EventTypeController extends Controller
{

    public function __construct()
    {      
        // Pagina para el menú
        $page = route('events-types.index');

        // Compartimos la variable
        view()->share(compact('page'));
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $event_types = EventType::paginate();

        return view('emergency::events-types.index', compact('event_types'));
    }

    /**
     * 
     * @return Response
     */
    public function modify($id)
    {
        $event_type = EventType::findOrFail($id);

        return view('emergency::events-types.update', compact('event_type'));
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
            'name' => 'required|string|max:255|unique:event_types,slug,' . $slug,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Creamos el país.
        $event_type = EventType::create([
            'slug' => $slug,
        ]);

        // Creamos una nueva traducción
        $translation = translations('event_types-list');

        $translation->add($slug, $request->name);

        $translation->publish();

        return redirect()
                ->route('events-types.index')
                ->with('action' , 'created');

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $event_type = EventType::findOrFail($id);

        // Validaciones
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:event_types,slug,' . $event_type->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Creamos una nueva traducción
        $translation = translations('event_types-list');

        $translation->add($event_type->slug, $request->name);

        $translation->publish();

        return redirect()->route('events-types.index')->with('action', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $event_type = EventType::findOrFail($id);

        $event_type->delete();

        return redirect()->route('events-types.index')->with('action', 'destroy');
    }
}
