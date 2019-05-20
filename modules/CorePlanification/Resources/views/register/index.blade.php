@extends('layouts.app')

@section('title')
    {{ trans('coreplanification::register.title') }}
@stop

@section('styles')
  <!--  <link href="{{ asset('assets/plugins/nestable/nestable.css') }}" rel="stylesheet"> -->
  <style type="text/css">
      li {
       list-style-type: none;
      }
  </style>

@stop


@section('content')

    <div class="row page-titles">
        <div class="col-md-7 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('coreplanification::register.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('coreplanification::breadcrumb.title') }}</li>
            </ol>
        </div>
        <div class="col-md-5 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
             <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                       <form class="form-inline">
                        <i class="fas fa-filter" style="float: left;margin-right: 15px;"></i>
                                <select onchange="filterByAgency(event)" id="agency_select" class="form-control" style="margin-top: -9px;">

                                    @forelse($agencias as $agencia)
                                    <option>Selecciona una agencia</option>
                                                         <optgroup label="{{$agencia->name}}">
                                                                                @forelse($agencia->childrens as $child)
                                                                         
                                                                                        <option  @if(isset($_GET['agency']))@if($child->id == $_GET['agency'] ) selected  @endif  @endif value="{{$child->id}}">
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
                @if(isset($_GET['agency']))
                    <button data-toggle="modal" data-target=".bs-example-modal-sm" class=" waves-effect waves-light btn-success btn  pull-right m-l-10"><i class="ti-plus text-white"></i> {{ trans('coreplanification::register.agregar_linea_de_accion') }}</button> @endif
                </div>
                
            </div>
        </div>
    </div>

          <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
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
                                            <form  hidden="hidden" method="POST" action="{{route('line_register.delete')}}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$linea->id}}">
                                                <input type="submit" hidden="hidden" id="lineadelete{{$linea->id }}">
                                            </form> 
                                                <a onclick="$('#lineadelete{{$linea->id}}').click() "  href="#" class="link float-right  waves-effect waves-light"><i class="mdi mdi-delete"></i></a> 
                                               
                                                <a href="{{url('/admin/planification/register')}}/{{$linea->id}}/edit?action=line" class="link  float-right waves-effect waves-light "><i class="mdi mdi-pencil"></i></a>

                                                 <a data-toggle="modal" data-target=".modal-objetivo" onclick="new_objetivo({{$linea->id}})" href="#" class="link waves-effect float-right waves-light"><i class="mdi mdi-plus"></i>
                                                 </a>

                                             </div>
                   <div class="collapse" id="linea{{$linea->id}}"  data-id="linea{{$linea->id}}">
                                             @forelse($linea->objetivos as $objetivo)
                                               
                                                    <ol class="dd-list  show">
                                                <li class="dd-item" data-id="3">
                                                    <div class="dd-handle"><a class="btn-minimize" data-toggle="collapse" href="#objetivo{{$objetivo->id}}" aria-expanded="true" aria-controls="objetivo{{$objetivo->id}}"><i class="mdi mdi-arrow-expand"></i>
                                                  </a> {{$objetivo->descripcion}}

                                                <form  hidden="hidden" method="POST" action="{{route('objetivo_register.delete')}}">
                                                
                                                @csrf
                                                <input type="hidden" name="id" value="{{$objetivo->id}}">
                                                <input type="submit" hidden="hidden" id="objetivodelete{{$objetivo->id }}">
                                            </form> 
                                                <a onclick="$('#objetivodelete{{$objetivo->id}}').click() "  href="#" class="link float-right  waves-effect waves-light"><i class="mdi mdi-delete"></i></a> 
                                               
                                                <a href="{{url('/admin/planification/register')}}/{{$objetivo->id}}/edit?action=objetive" class="link  float-right waves-effect waves-light "><i class="mdi mdi-pencil"></i></a>

                                                 <a data-toggle="modal" data-target=".modal-indicador" onclick="new_indicador({{$objetivo->id}})" href="#" class="link waves-effect float-right waves-light"><i class="mdi mdi-plus"></i>
                                                 </a> 
                                                     </div>
 <div class="collapse" id="objetivo{{$objetivo->id}}"  data-id="objetivo{{$objetivo->id}}">
                                                           @forelse($objetivo->indicadores as $indicador)
                                               
                                                    <ol class="dd-list  show">
                                                <li class="dd-item" data-id="3">
                                                    <div class="dd-handle">
                                                    <a class="btn-minimize" data-toggle="collapse" href="#indicador{{$indicador->id}}" aria-expanded="false" aria-controls="indicador{{$indicador->id}}" ><i class="mdi mdi-arrow-expand"></i>
                                                  </a>
                                                     {{$indicador->descripcion}}

                                                <form  hidden="hidden" method="POST" action="{{route('indicador_register.delete')}}">
                                                
                                                @csrf
                                                <input type="hidden" name="id" value="{{$indicador->id}}">
                                                <input type="submit" hidden="hidden" id="indicadordelete{{$indicador->id }}">
                                            </form> 
                                                <a onclick="$('#indicadordelete{{$indicador->id}}').click() "  href="#" class="link float-right  waves-effect waves-light"><i class="mdi mdi-delete"></i></a> 
                                               
                                                <a href="{{url('/admin/planification/register')}}/{{$indicador->id}}/edit?action=indicator" class="link  float-right waves-effect waves-light "><i class="mdi mdi-pencil"></i></a>

                                                 <a data-toggle="modal" data-target=".modal-document" onclick="new_document({{$indicador->id}})" href="#" class="link waves-effect float-right waves-light"><i class="mdi mdi-plus"></i>
                                                 </a> 
                                                     </div>
  <div class="collapse" id="indicador{{$indicador->id}}"  data-id="indicador{{$indicador->id}}">
                                                               @forelse($indicador->documentos as $documento)
                                              
                                                    <ol class="dd-list  show">
                                                <li class="dd-item" data-id="3">
                                                    <div class="dd-handle"><a href="{{url('../storage/app')}}/{{$documento->path}}" target="_blank"><i class="mdi mdi-file-document"></i></a> {{$documento->description}}

                                                <form  hidden="hidden" method="POST" action="{{route('indicador_document.delete')}}">
                                                  
                                                @csrf
                                                <input type="hidden" name="id" value="{{$documento->id}}">
                                                <input type="hidden" name="path" value="{{$documento->path}}">
                                                <input type="submit" hidden="hidden" id="indicador_document{{$documento->id}}">
                                            </form> 
                                                <a onclick="$('#indicador_document{{$documento->id}}').click() "  href="#" class="link float-right  waves-effect waves-light"><i class="mdi mdi-delete"></i></a> 
                                               
                                                <a href="{{url('/admin/planification/register')}}/{{$documento->id}}/edit?action=documento" class="link  float-right waves-effect waves-light "><i class="mdi mdi-pencil"></i></a>

                                               
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
                </div>

      <!-- sample modal content -->
    @include('coreplanification::modals.newlinea')
    @include('coreplanification::modals.newobjective')
    @include('coreplanification::modals.newindicador')
        @include('coreplanification::modals.newdocument')
@stop

@section('scripts')

    <script src="{{ asset('assets/plugins/nestable/jquery.nestable.js') }}"></script>
        <script type="text/javascript">
    $(document).ready(function() {
  






    });



    var new_objetivo = function (id){

            $('#linea_id').val(id);

    }

 var new_indicador = function (id){

            $('#indicador_id').val(id);

    }


 var new_document = function (id){

            $('#indicador_document_id').val(id);

    }

   
    </script>

    <script type="text/javascript">
        
    var filterByAgency = function ()  {


       var redir =  $("#agency_select").val();


window.location.replace("{{url('admin/planification/register')}}?agency="+redir)
    }
    </script>


@stop