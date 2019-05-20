<?php

namespace Modules\CorePlanification\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CorePlanification\Entities\Linea;
use Modules\CorePlanification\Entities\Indicador;
use Modules\CorePlanification\Entities\Mensaje;
use Modules\Agency\Entities\Agency;
use Auth;
class EjecuterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        if (isset($_GET['agency'])) {
            $lineas = Linea::where('agency_id',$_GET['agency'])->get();
        }
          else

          {
                  $lineas = Linea::where('agency_id',0)->get();
          }

          if (isset($_GET['index'])) {

                    $index =  Indicador::where('id',$_GET['index'])->first();

          }
          else {

                    $index =  Indicador::where('id',0)->first();
          }
                    $agencias = Agency::where('belong_to',0)->get();


        return view('coreplanification::ejecuter.index',['lineas' => $lineas,'agencias' => $agencias,'index' => $index]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('coreplanification::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function mensaje_store(Request $request)
    {

        $mensaje = new Mensaje;

        $mensaje->autor_id =  Auth::user()->id;
        $mensaje->indicador_id = $request->indicador_id;
        $mensaje->mensaje =  $request->mensaje;
        $mensaje->save();

        return redirect(url()->previous());
    }
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function mensaje_delete(Request $request)
    {

        $mensaje =  Mensaje::find($request->id);
        if ($mensaje->id == Auth::user()->id) {
           $mensaje->delete();
        }

       
        

        return redirect(url()->previous());
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('coreplanification::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('coreplanification::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function indicador_core_update(Request $request)
    {
        $indicador = Indicador::find($request->id);
        if (isset($request->status_evaluation)) {
                    $indicador->status_evaluation = $request->status_evaluation;
            
        }
        else {
        $indicador->status_core = $request->status;

        }

        $indicador->save();
        return redirect(url()->previous());
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
