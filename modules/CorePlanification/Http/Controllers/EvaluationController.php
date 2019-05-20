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

class EvaluationController extends Controller
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


        return view('coreplanification::evaluation.index',['lineas' => $lineas,'agencias' => $agencias,'index' => $index]);
       
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
    public function store(Request $request)
    {
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
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
