@extends('layouts.app')

@section('title')
    {{ trans('coreplanification::indicator-advance.title') }}
@stop
@section('styles')
 <link href="{{ asset('assets/plugins/footable/css/footable.bootstrap.min.css') }}" rel="stylesheet"> 
  <style type="text/css">
      li {
       list-style-type: none;
      }
  </style>

@stop
@section('content')
    <div class="row page-titles">
        <div class="col-md-7 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('coreplanification::indicator-advance.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('coreplanification::breadcrumb.title') }}</li>
            </ol>
        </div>
        <div class="col-md-5 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <!--<div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <button data-toggle="modal" data-target=".bs-example-modal-sm" class=" waves-effect waves-light btn-success btn  pull-right m-l-10"><i class="ti-plus text-white"></i> {{ trans('currency::currencies.add_currency') }}</button>
                </div>-->

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

           <!-- Column -->
                        <div class="card">
                            <div class="card-body">
                               
                                <div class="table-responsive">
                                    <table id="demo-foo-row-toggler" class="table table-bordered" data-toggle-column="first">
                                        <thead>
                                            <tr>
                                               
                                                <th>{{ trans('coreplanification::register.objetivos') }} </th>
                                                <th>{{ trans('coreplanification::ejecuter.declaracion_administrativa') }}</th>
                                                <th data-breakpoints=""> {{ trans('coreplanification::ejecuter.evaluacion_equipo_core') }}</th>
                                              
                                                <th data-breakpoints="all" data-title="Indicador">{{ trans('coreplanification::register.indicadores') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($lineas as $linea)
                                                    @forelse($linea->objetivos as $objetivo)

                                                    @forelse($objetivo->indicadores as $indicador)
                                            <tr data-expanded="true">
                                            
                                                <td>
                                                    <a href="javascript:void(0)">{{$objetivo->descripcion}}</a>
                                                </td>
                                               
                                                <td></td>
                                                <td></td>
                                                <td> {{$indicador->descripcion}}  @if($indicador->status_core == 0) <a href="#" class="btn btn-red offset-md-3"><i class="mdi mdi-close"></i></a> {{ trans('coreplanification::ejecuter.sin_mdv') }}   @endif @if($indicador->status_core == 1) <a href="#" class="btn btn-red offset-md-3"><i class="mdi mdi-close"></i></a>  {{ trans('coreplanification::ejecuter.sin_mdv') }}  @endif @if($indicador->status_core == 2) <a href="#" class="btn btn-warning offset-md-3"><i class="mdi mdi-close"></i></a> {{ trans('coreplanification::ejecuter.fase_inicial') }}  @endif  @if($indicador->status_core == 3 ) <a href="#" class="btn btn-success offset-md-3"><i class="mdi mdi-close"></i></a> {{ trans('coreplanification::ejecuter.fase_desarrollo') }} @endif  @if($indicador->status_core == 4)<a href="#" class="btn btn-success offset-md-3"><i class="mdi mdi-close"></i></a> {{ trans('coreplanification::ejecuter.completo_con_documentacion') }}  @endif 


                                                   @if($indicador->status_core == 0) <a href="#" class="btn btn-red offset-md-3"><i class="mdi mdi-close"></i></a> {{ trans('coreplanification::ejecuter.sin_evaluacion') }}  @endif @if($indicador->status_core == 1) <a href="#" class="btn btn-red offset-md-3"><i class="mdi mdi-close"></i></a> {{ trans('coreplanification::ejecuter.sin_mdv') }} @endif @if($indicador->status_core == 2) <a href="#" class="btn btn-red offset-md-3"><i class="mdi mdi-close"></i></a> {{ trans('coreplanification::ejecuter.insuficiente') }}  @endif  @if($indicador->status_core == 3 ) <a href="#" class="btn btn-success offset-md-3"><i class="mdi mdi-close"></i></a> {{ trans('coreplanification::ejecuter.sastifactorio') }} @endif  @if($indicador->status_core == 4)<a href="#" class="btn btn-success offset-md-3"><i class="mdi mdi-close"></i></a> {{ trans('coreplanification::ejecuter.excelente') }} @endif 

                                               </td>

                                            </tr>
                                            @empty
                                            @endforelse
                                            @empty
                                            @endforelse

                                            @empty

                                            @endforelse
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
          <script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
            <script src="{{asset('assets/plugins/footable/js/footable.min.js')}}"></script>
              <script src="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
            


        <script src="{{asset('js/footable-init.js')}}"></script>


    <script type="text/javascript">
        
    var filterByAgency = function ()  {


       var redir =  $("#agency_select").val();


window.location.replace("{{url('admin/planification/indicator-advance')}}?agency="+redir)
    }
    </script>

    @stop

