@extends('layouts.app')

@section('title')
    {{ trans('agency::treasury-info.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-md-7 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('agency::treasury-info.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ trans('breadcrumb.admin') }}</li>
            </ol>
        </div>
        <div class="col-md-5 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <button data-toggle="modal" data-target="#treasuryInfoModal" class="waves-effect waves-light btn-outline-success btn btn-rounded pull-right m-l-10 btn-icon"><i class="ti-pencil"></i> {{ trans('agency::treasury-info.update-info') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if( isset($user) )
            <div class="col-4">
                <div class="card">
                    <div class="card-body text-center">   
                        <img src="{{ asset($user->avatar ? $user->avatar . '_160.jpg' : 'assets/images/avatar.jpg') }}" 
                                class="img-circle" width="160" />
                        <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Información de la agencia</h4>
                        <hr>

                        <p class="card-text">
                            <strong>Nombre:</strong> 
                            {{ $agency->name }}
                        </p>

                        <p class="card-text">
                            <strong>País:</strong> 
                            @lang('countries-list.' . $agency->country->slug)
                        </p>

                        <p class="card-text">
                            <strong>Misión:</strong> 
                            {{ $agency->mission }}
                        </p>

                        <p class="card-text">
                            <strong>Visión:</strong> 
                            {{ $agency->vision }}
                        </p>
                    </div>
                </div>  
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Información del titular</h4>
                        <hr>

                        <div class="row">

                            <div class="col-6">
                                <p class="card-text">
                                    <strong>Nombre completo:</strong> <br>
                                    {{ $user->name }}
                                </p>

                                <p class="card-text">
                                    <strong>Provincia:</strong> <br>
                                    {{ $user->profile ? $user->profile->province : 'Sin establecer' }}
                                </p>

                                <p class="card-text">
                                    <strong>Banco:</strong> <br>
                                    {{ $bankInfo ? $bankInfo->bank_name : 'Sin establecer' }}
                                </p>

                                <p class="card-text">
                                    <strong>Número de cuenta:</strong> <br>
                                    {{ $bankInfo ? $bankInfo->account_number : 'Sin establecer' }}
                                </p>
                            </div>

                            <div class="col-6">
                                <p class="card-text">
                                    <strong>Pais:</strong> <br>
                                    {{ $user->profile ? $user->profile->country : 'Sin establecer' }}
                                </p>

                                 <p class="card-text">
                                    <strong>Ciudad:</strong> <br>
                                    {{ $user->profile ? $user->profile->city : 'Sin establecer' }}
                                </p>

                                <p class="card-text">
                                    <strong>Codigo de enrrutamiento:</strong> <br>
                                    {{ $bankInfo ? $bankInfo->account_route : 'Sin establecer' }}
                                </p>
                            </div>
                        </div>

                        <br>
                        <h4 class="card-title">Información del contador</h4>
                        <hr>

                        <p class="card-text">
                            <strong>Nombre completo:</strong> 
                            {{ $treasury->counter->name }}
                        </p>
                        <p class="card-text">
                            <strong>Correo electronico:</strong> 
                            {{ $treasury->counter->email }}
                        </p>
                        <p class="card-text">
                            <strong>Moneda:</strong> 
                            @lang('currencies-list.' . $treasury->currency->slug)
                        </p>

                        <p class="card-text">
                            <strong>IVAN:</strong> 
                            {{ $treasury->ivan }}
                        </p>

                        <br>
                        <h4 class="card-title">Banco Intermediarío</h4>
                        <hr>

                        <p class="card-text">
                            <strong>Nombre del banco:</strong> 
                            {{ $treasury->bank_name }}
                        </p>
                        <p class="card-text">
                            <strong>Codigo de ruta:</strong> 
                            {{ $treasury->bank_route }}
                        </p>
                    </div>
                </div>         
            </div>
        @else
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    @lang('agency::treasury-info.no-data-alert')
                </div>
            </div>
        @endif
    </div>

    @include('agency::modals.update-treasury-info')

@stop
