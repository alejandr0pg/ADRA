@extends('layouts.app')


@section('title')
    {{ trans('coreplanification::emergencies.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-md-7 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('emergencies::emergencies.title') }}</h3>
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
                
            </div>
        </div>
    </div>
@stop
