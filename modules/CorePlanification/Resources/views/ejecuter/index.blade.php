@extends('layouts.app')


@section('title')
    {{ trans('coreplanification::ejecuter.title') }}
@stop
@section('styles')
 <link href="{{ asset('assets/plugins/nestable/nestable.css') }}" rel="stylesheet"> 
  <style type="text/css">
     li {
       list-style-type: none;
      }
  </style>

@stop


@section('content')
    <div class="row page-titles">
        <div class="col-md-7 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('coreplanification::ejecuter.title') }}</h3>
            <ol class="breadcrumb">
                <li  class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('coreplanification::breadcrumb.title') }}</li>
            </ol>
        </div>
        <div class="col-md-5 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
              
                
                    <form class="form-inline">
                        <i class="fas fa-filter" style="float: left;margin-right: 15px;"></i>
                                <select onchange="filterByAgency(event)" id="agency_select" class="form-control" style="margin-top: -9px;">

                                    @forelse($agencias as $agencia)
                                    <option>Selecciona una agencia</option>
                                                         <optgroup label="{{$agencia->name}}">
                                                                                @forelse($agencia->childrens as $child)
                                                                         
                                                                                        <option  @if(isset($_GET['agency'])) @if($child->id == $_GET['agency'] ) selected  @endif @endif value="{{$child->id}}">
                                                                                          {{$child->name}}
                                                                                        </option> 
                                                                             

                                                                                    @empty
                                                                                    @endforelse
                                                         </optgroup>

                                                                                    @empty

                                                                                    @endforelse
                                                                    </select>
                            </form>
            </div>
        </div>
    </div>




                <div class="row">

                    <div class="col-lg-6 col-md-6">
                        <div class="card">

                            <div class="card-body">
                                <h4 class="card-title">{{ trans('coreplanification::register.linea_de_accion') }}/ {{ trans('coreplanification::register.objetivos') }} / {{ trans('coreplanification::register.indicadores') }}</h4>
                                <div class="myadmin-dd dd" id="nestable">
                                    <ol class="dd-list">
                                        
                             

                                        @forelse($lineas as $linea)

                                        <li class="dd-item " >

                                            <div class="dd-handle">
                                                  <a class="btn-minimize" data-toggle="collapse" href="#linea{{$linea->id}}" aria-expanded="false" aria-controls="linea{{$linea->id}}" ><i class="mdi mdi-arrow-expand"></i>
                                                  </a>
                                                

                                         {{$linea->descripcion}}
                                        

                                             </div>
                   <div class="collapse" id="linea{{$linea->id}}"  data-id="linea{{$linea->id}}">
                                             @forelse($linea->objetivos as $objetivo)
                                               
                                                    <ol class="dd-list  show">
                                                <li class="dd-item" data-id="3">
                                                    <div class="dd-handle"><a class="btn-minimize" data-toggle="collapse" href="#objetivo{{$objetivo->id}}" aria-expanded="true" aria-controls="objetivo{{$objetivo->id}}"><i class="mdi mdi-arrow-expand"></i>
                                                  </a> {{$objetivo->descripcion}}

 <div class="collapse" id="objetivo{{$objetivo->id}}"  data-id="objetivo{{$objetivo->id}}">
                                                           @forelse($objetivo->indicadores as $indicador)
                                               
                                                    <ol class="dd-list  show">
                                                <li class="dd-item" data-id="3">
                                                    <div class="dd-handle">
                                                    <a class="btn-minimize" data-toggle="collapse" href="#indicador{{$indicador->id}}" aria-expanded="false" aria-controls="indicador{{$indicador->id}}" ><i class="mdi mdi-arrow-expand"></i>
                                                  </a>
                                               @if(isset($_GET['agency']))   <a href="{{url('admin/planification/ejecuter')}}?agency={{$_GET['agency']}}&index={{$indicador->id}}" > @else   @endif  {{$indicador->descripcion}} </a>

                                          
                                                     </div>
                                   <div class="collapse" id="indicador{{$indicador->id}}"  data-id="indicador{{$indicador->id}}">
                                                               @forelse($indicador->documentos as $documento)
                                              
                                                    <ol class="dd-list  show">
                                                <li class="dd-item" data-id="3">
                                                    <div class="dd-handle"><a href="{{url('../storage/app')}}/{{$documento->path}}" target="_blank"><i class="mdi mdi-file-document"></i></a> {{$documento->description}}

                                           

                                               
                                                     </div>
                                                </li>
                                            </ol>

                                                
                                               
                                            @empty 

                                            @endforelse
                                                    </div>
                                                </li>
                                            </ol>

                                               
                                               
                                            @empty 

                                            @endforelse 
                                                    </div>
                                                </li>
                                            </ol>

                                                
                                               
                                            @empty 

                                            @endforelse
                                          </div>
                                        </li  >
                                        @empty
                                        @endforelse
                            
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div> 
                      @if(isset($_GET['index']))
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                          



                            <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card blog-widget">
                            <div class="card-body">
                            
                             <h4 class="card-title">{{ trans('coreplanification::register.linea_de_accion') }}/ {{ $index->objetivo->descripcion }} /  {{ $index->descripcion }} </h4>
                                <h3>{{ trans('coreplanification::ejecuter.declaracion_administrativa') }}</h3>
                          
                           <div class="">
                                   <div class="switch">
                                          
                                                <form id="dc-form1" action="{{route('indicador_core_update')}}" method="POST">
                                                    {{csrf_field()}}
                                                      <label>
                                                        @if($index->status_core ==  1)
                                                        <input type="hidden" name="status" value="0">

                                                        @else
                                                        <input type="hidden" name="status" value="1">
                                                        @endif
                                                        <input type="hidden" name="id" value="{{$_GET['index']}}">

                                                      <input onclick="$('#dc-form1').submit()" type="checkbox" @if($index->status_core == 1 )  checked=""  @endif ><span class="lever"></span>{{ trans('coreplanification::ejecuter.sin_plan') }}</label>
                                                </form>
                                              
                                        </div>
                                  <div class="switch">
                                        <form id="dc-form2" action="{{route('indicador_core_update')}}" method="POST">
                                                    {{csrf_field()}}

                                                        @if($index->status_core ==  2)
                                                        <input type="hidden" name="status" value="0">

                                                        @else
                                                        <input type="hidden" name="status" value="2">
                                                        @endif

                                                      <label>
                                                        <input type="hidden" name="id" value="{{$_GET['index']}}">
                                                <input onclick="$('#dc-form2').submit()"  type="checkbox" @if($index->status_core == 2 )  checked=""  @endif ><span class="lever"></span>{{ trans('coreplanification::ejecuter.fase_inicial') }}</label>

                                            </form>
                                        </div>
                                    
                                     <div class="switch">
                                            <label>
                                                 <form id="dc-form3" action="{{route('indicador_core_update')}}" method="POST">
                                                    {{csrf_field()}}
                                                     @if($index->status_core ==  3)
                                                        <input type="hidden" name="status" value="0">

                                                        @else
                                                        <input type="hidden" name="status" value="3">
                                                        @endif
                                                        <input type="hidden" name="id" value="{{$_GET['index']}}">

                                    <input onclick="$('#dc-form3').submit()"  type="checkbox" @if($index->status_core == 3 )  checked=""  @endif ><span class="lever"></span>{{ trans('coreplanification::ejecuter.fase_desarrollo') }}</label>
                                            </form>
                                        </div>
                                    
                                     <div class="switch">
                                            <label>
                                              <form id="dc-form4" action="{{route('indicador_core_update')}}" method="POST">
                                                {{csrf_field()}}

                                                        @if($index->status_core ==  4)
                                                        <input type="hidden" name="status" value="0">

                                                        @else
                                                        <input type="hidden" name="status" value="4">
                                                        @endif
                                                        <input type="hidden" name="id" value="{{$_GET['index']}}">
                                                <input onclick="$('#dc-form4').submit()" type="checkbox" @if($index->status_core == 4)  checked=""  @endif ><span class="lever"></span>{{ trans('coreplanification::ejecuter.completo_con_documentacion') }}</label> </form>
                                        </div>
                                    
                                  
                              
                                </div>
                                </div>
                           
                            </div>
                        </div>
                             <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card blog-widget">
                            <div class="card-body">  
                                <div class="">
                                     <h3>{{ trans('coreplanification::ejecuter.medios_de_verificacion') }}</h3>
                                </div>
                               
                                <div class="col-md-3 offset-md-4">
                                      <button data-toggle="modal" data-target=".modal-verification" type="button" class="btn waves-effect waves-light btn-block btn-success"><i class="fa fa-plus"></i></button>

                                </div>

                                @forelse($index->medios_verificacion as $documento)

                                <form  id="documentodelete{{$documento->id}}" action="{{route('indicador_document.delete')}}" method="POST">
                                  <input type="hidden" name="id" value="{{$documento->id}}">
                                  {{csrf_field()}}

                                </form>
                                <a  target="_blank" href="{{url('../storage/app')}}/{{$documento->path}}"><i class="fas fa-file-alt"></i> {{$documento->description}}</a> <a onclick="$('#documentodelete{{$documento->id}}').submit()" href="#" class=""><i class="fa fa-trash"></i></a>
                                <br>

                                @empty

                                @endforelse
                              
                            
                              
                     
                                </div>
                           
                            </div>
                        </div>
                          <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card blog-widget">
                            <div class="card-body">  
                                <div class="">
                                     <h3>{{ trans('coreplanification::ejecuter.plantillas') }}</h3>
                                </div>
                               
                           

                                @forelse($index->documentos as $documento)

                                <form  id="documentodelete{{$documento->id}}" action="{{route('indicador_document.delete')}}" method="POST">
                                  <input type="hidden" name="id" value="{{$documento->id}}">
                                  {{csrf_field()}}

                                </form>
                                <a  target="_blank" href="{{url('../storage/app')}}/{{$documento->path}}"><i class="fas fa-file-alt"></i> {{$documento->description}}</a> 
                                <br>

                                @empty

                                @endforelse
                              
                            
                              
                     
                                </div>
                           
                            </div>
                        </div>
                            
                          
                            <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card blog-widget">
                            <div class="card-body">


                            
                                <h3>{{ trans('coreplanification::ejecuter.evaluacion_equipo_core') }}</h3>
                          
                           <div class="">
                                   <div class="switch">
                                            <label>
                                              <form id="ev-form1" action="{{route('indicador_core_update')}}" method="POST">
                                                    {{csrf_field()}}
                                                     @if($index->status_evaluation ==  1)
                                                        <input type="hidden" name="status_evaluation" value="0">

                                                        @else
                                                        <input type="hidden" name="status_evaluation" value="1">
                                                        @endif
                                                        <input type="hidden" name="id" value="{{$_GET['index']}}">
                                                <input disabled="" onclick="$('#ev-form1').submit()" type="checkbox"  @if($index->status_evaluation == 1)  checked=""  @endif type="checkbox"><span class="lever"></span>{{ trans('coreplanification::ejecuter.sin_mdv') }}</label>

                                              </form>
                                        </div>
                                  <div class="switch">
                                            <label>
                                              <form id="ev-form2" action="{{route('indicador_core_update')}}" method="POST">
                                                    {{csrf_field()}}
                                                     @if($index->status_evaluation==  2)
                                                        <input type="hidden" name="status_evaluation" value="0">

                                                        @else
                                                        <input type="hidden" name="status_evaluation" value="2">
                                                        @endif
                                                        <input type="hidden" name="id" value="{{$_GET['index']}}">
                                                <input disabled="" onclick="$('#ev-form2').submit()" @if($index->status_evaluation == 2 )  checked=""  @endif type="checkbox" ><span class="lever"></span>{{ trans('coreplanification::ejecuter.insuficiente') }}</label>
                                              </form>
                                        </div>
                                    
                                     <div class="switch">
                                            <label>
                                                    <form id="ev-form3" action="{{route('indicador_core_update')}}" method="POST">
                                                    {{csrf_field()}}
                                                     @if($index->status_evaluation ==  3)
                                                        <input type="hidden" name="status_evaluation" value="0">

                                                        @else
                                                        <input type="hidden" name="status_evaluation" value="3">
                                                        @endif
                                                        <input type="hidden" name="id" value="{{$_GET['index']}}">
                                                <input disabled="" onclick="$('#ev-form3').submit()"  type="checkbox" @if($index->status_evaluation == 3 )  checked=""  @endif ><span class="lever"></span>{{ trans('coreplanification::ejecuter.sastifactorio') }}</label>
                                              </form>
                                        </div>
                                    
                                     <div class="switch">
                                            <label>
                                              <form id="ev-form4" action="{{route('indicador_core_update')}}" method="POST">
                                                    {{csrf_field()}}
                                                     @if($index->status_evaluation ==  4)
                                                        <input type="hidden" name="status_evaluation" value="0">

                                                        @else
                                                        <input type="hidden" name="status_evaluation" value="4">
                                                        @endif
                                                        <input type="hidden" name="id" value="{{$_GET['index']}}">
                                                <input disabled="" type="checkbox" @if($index->status_evaluation == 4 )  checked=""  @endif onclick="$('#ev-form4').submit()" ><span class="lever"></span>{{ trans('coreplanification::ejecuter.excelente') }}</label>
                                              </form>
                                        </div>
                                    
                                  
                              
                                </div>
                                </div>
                           
                            </div>
                        </div>




                                                   <div class="chat-main-box">
                                <!-- .chat-left-panel -->
                                <div class="chat-left-aside">
                                    <div class="open-panel"><i class="ti-angle-right"></i></div>
                  
                                </div>
                                <!-- .chat-left-panel -->
                                <!-- .chat-right-panel -->
                                <div class="chat-right-aside">
                                    <div class="chat-main-header">
                                        <div class="p-20 b-b">
                                            <h3 class="box-title"></h3>
                                        </div>
                                    </div>
                                    <div class="chat-rbox">
                                        <ul class="chat-list p-20">

                                          @forelse($index->mensajes as $mensaje)

                                            @if(Auth::user()->id == $mensaje->autor_id)
                                                <!--chat Row -->
                                            <li class="reverse">
                                                <div class="chat-time">{{$mensaje->created_at->format('d-m-y h:s a')}}</div>
                                                <div class="chat-content">
                                                    <h5>Yo</h5>
                                                    <div class="box bg-light-inverse">{{$mensaje->mensaje}}</div>
                                                </div>
                                                <div class="chat-img"><form id="deletemensaje{{$mensaje->id}}" action="{{route('mensaje.delete')}}" method="POST"> {{csrf_field()}} <input type="hidden" name="id" value="{{$mensaje->id}}"> </form><a href="#" onclick="$('#deletemensaje{{$mensaje->id}}').submit()"><i class="fa fa-trash"></i></a></div>
                                            </li>

                                            @else
                                              <li>
                                                <div class="chat-img"></div>
                                                <div class="chat-content">
                                                    <h5>{{$mensaje->autor->name}}</h5>
                                                    <div class="box bg-light-info">{{$mensaje->mensaje}}</div>
                                                </div>
                                                <div class="chat-time">{{$mensaje->created_at->format('d-m-y h:s a')}}</div>
                                            </li>
                                            @endif

                                          @empty

                                          @endforelse
                                         
                                           
                                        </ul>
                                    </div>
                                    <div class="card-body b-t">
                                        <div class="row">
                                          
                                             <div class="col-8">
                                              <form id="mensaje-form" action="{{route('mensaje_send.store')}}" method="POST" >
                                                {{csrf_field()}}
                                                <input type="hidden" name="indicador_id" value="{{$index->id}}">
                                                <textarea name="mensaje" placeholder="Type your message here" class="form-control b-0"></textarea>     
                                               </form>
                                            </div>
                                            <div class="col-4 text-right">
                                                <button  onclick="$('#mensaje-form').submit()" type="button" class="btn btn-info btn-circle btn-lg"><i class="fas fa-paper-plane"></i> </button>
                                            </div>

                                           
                                        </div>
                                    </div>
                                </div>
                                <!-- .chat-right-panel -->
                            </div>
                    </div>




                         </div>         @endif
                            @include('coreplanification::modals.newverification')
               

@stop
@section('scripts')

    <script src="{{ asset('assets/plugins/nestable/jquery.nestable.js') }}"></script>

        <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="js/chat.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>

        <script src="{{asset('js/chat.js')}}"></script>


    <script type="text/javascript">
        
    var filterByAgency = function ()  {


       var redir =  $("#agency_select").val();


window.location.replace("{{url('admin/planification/ejecuter')}}?agency="+redir)
    }
    </script>

    @stop