@extends('layouts.app')

@section('title')
    {{ trans('coreplanification::register.title') }}
@stop

@section('styles')
    {{ trans('coreplanification::register.title') }}
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
                <h3>{{ trans('coreplanification::register.edit_line')}} {{$linea->id}}</h3>
                </div>
                
            </div>
        </div>
    </div>
   
    
<div>
    <form id="role-form" 
                        @switch($_GET['action'])
                        @case('line')
                             action="{{ route('line_register.store') }}"
                        @case('objetive')
                            action="{{ route('objetivo_register.store') }}"
                        @case('indicator')
                        action="{{ route('indicador_register.store') }}"
                            @break
                    @endswitch
                  
                    method="POST">

                     @switch($_GET['action'])
                        @case('line')
                           <input type="hidden" name="agency_id" value="1">
                        @case('objetive')
                            <input type="hidden" name="line_id" value="1">
                        @case('indicator')
                        
                            @break
                    @endswitch
                 
                    <input type="hidden" name="agency_id" value="1">

                    <input type="hidden" name="id" value="{{$linea->id}}">
                    @csrf
                    <div class="form-group">
                        <label for="currency-name" class="control-label"> {{trans('coreplanification::register.form.descripcion') }}</label>
                        <textarea  name="description"  class="form-control" id="register-description">{{$linea->descripcion}}</textarea>
                       
                    </div>
                    <div class="form-group">
                        <label for="register-created_date" class="control-label"> {{trans('coreplanification::register.form.created_date') }}</label>
                        <input type="date" name="fecha_creacion" value="{{$linea->fecha_creacion }}" class="form-control" id="register-created_date">
                    </div>
                  
                   
                    <div class="form-group">
                  
                      <div class="col-sm-3">
                                        <div class="demo-switch-title">{{trans('coreplanification::register.form.vigencia') }}</div>
                                        <div class="switch">
                                            <label>
                                                <input @if($linea->vigencia == 1) checked  @endif name="vigencia" type="checkbox" ><span class="lever switch-col-teal"></span></label>
                                        </div>
                                    </div>
                    </div>
                      <a href="{{url()->previous()}}" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('currency::currencies.modal.cancel') }}</a>
                <button onclick="event.preventDefault();document.getElementById('role-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('currency::currencies.modal.save') }}</button>
                </form>

    </div>

         


@stop

