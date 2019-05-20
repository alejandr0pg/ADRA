<?php

namespace Modules\CorePlanification\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

//modelos
use Modules\Agency\Entities\Agency;
use Modules\Country\Entities\Country;
use Modules\CorePlanification\Entities\Linea;
use Modules\CorePlanification\Entities\Objetivo;
use Modules\CorePlanification\Entities\Indicador;

use Modules\CorePlanification\Entities\Document;

class RegisterController extends Controller
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
    
        $agencias = Agency::where('belong_to',0)->get();

        return view('coreplanification::register.index', compact('lineas','agencias'));
    }



/**
     * Display a listing of the resource.
     * @return Response
     */
    public function document_store(Request $request)
    {   
         $imagen = new Document ;
         if (isset($request->verification_id)) {
            
             $imagen->verification_id = $request->verification_id;
         }
         else {
                  $imagen->indicador_id = $request->indicador_id;

            
         }
                $imagen->description = $request->description;
                  
              
                $random = str_random(100);

              $path =  $request->document;


             $imagen->path = $random. $path->getClientOriginalName();
              $name = $random.$path->getClientOriginalName();\Storage::disk('local')->put($name,\File::get($path));

         
              $imagen->save();

        return redirect(url()->previous());
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function delete_document(Request $request)
    {   
         $imagen = Document::find($request->id) ;
                
                  
              
              

           
           \Storage::delete($request->path);

         
              $imagen->delete();

        return redirect(url()->previous());
    }





 /**
     * Registro de lineas de accion
     * @return Response
     */
    public function store(Request $request)
    { 
    
    	// Validaciones
        $validator = \Validator::make($request->all(), [
            'description' => 'required',
            'fecha_creacion' => 'required',
            'vigencia' => 'required',
            'agency_id' => 'required',
          
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        if (isset($request->id)) {
         
          $line = Linea::find($request->id);
        }
        else{

           // Creamos la agencia
        $line = new Linea;
        }
 
       
        $line->descripcion = $request->description;
        $line->fecha_creacion = $request->fecha_creacion;
        if ($request->vigencia == "on") {
          # code...  
          $line->vigencia = 1;
        }
        else{
           $line->vigencia = 0;
        }
  
        $line->agency_id = $request->agency_id;
        $line->save();

        return redirect(  url()->previous()  );
    
    }

 /**
     * Registro de objetivos
     * @return Response
     */
    public function objetivos_store(Request $request)
    { 

      // Validaciones
        $validator = \Validator::make($request->all(), [
            'description' => 'required',
            'fecha_creacion' => 'required',
            'vigencia' => 'required',
            'linea_id' => 'required',
          
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        if (isset($request->id)) {
         
          $objetivo = Objetivo::find($request->id);
        }
        else{

           // Creamos la agencia
        $objetivo = new Objetivo;
        }
 
       
        $objetivo->descripcion = $request->description;
        $objetivo->fecha_creacion = $request->fecha_creacion;
        if ($request->vigencia == "on") {
          # code...  
          $objetivo->vigencia = 1;
        }
        else{
           $objetivo->vigencia = 0;
        }
  
        $objetivo->linea_id = $request->linea_id;
        $objetivo->save();

        return redirect(url()->previous());
    
    }


     /**
     * Registro de objetivos
     * @return Response
     */
    public function indicador_store(Request $request)
    { 

      // Validaciones
        $validator = \Validator::make($request->all(), [
            'description' => 'required',
            'fecha_creacion' => 'required',
            'vigencia' => 'required',
            'objetivo_id' => 'required',
          
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        if (isset($request->id)) {
         
          $objetivo = Indicador::find($request->id);
        }
        else{

           // Creamos la agencia
        $objetivo = new Indicador;
        }
 
       
        $objetivo->descripcion = $request->description;
        $objetivo->fecha_creacion = $request->fecha_creacion;
        if ($request->vigencia == "on") {
          # code...  
          $objetivo->vigencia = 1;
        }
        else{
           $objetivo->vigencia = 0;
        }
  
        $objetivo->objetivo_id = $request->objetivo_id;
        $objetivo->save();

        return redirect(url()->previous());
    
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function edit($id)
    {  switch ($_GET['action']) {
      case 'line':
       
        $linea = Linea::find($id);

       break;
      
      case 'objetive':
      
        $linea = Objetivo::find($id);


      break;
      
      case 'indicator':
            
        $linea = Indicador::find($id);


      break;
      

    }


        return view('coreplanification::register.edit', compact('linea'));



        
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function delete(Request $request)
    {   
          $linea = Linea::find($request->id);
          $linea->delete();
            return redirect(url()->previous());



        
    }
      /**
     * Display a listing of the resource.
     * @return Response
     */
    public function delete_objetivo(Request $request)
    {   
          $Objetivo = Objetivo::find($request->id);
          $Objetivo->delete();
            return redirect(url()->previous());



        
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function delete_indicador(Request $request)
    {   
          $Indicador = Indicador::find($request->id);
          $Indicador->delete();
            return redirect(url()->previous());



        
    }


    
}
