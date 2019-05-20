@extends('layouts.app')

@section('title')
	{{ trans('country::update.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('country::update.title') }}: {{ trans("countries-list.$country->slug") }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('breadcrumb.config') }}</li>
            </ol>
        </div>
    </div>
          
    <!-- Countries table -->
    <div class="row">
        <div class="col-12">
            @if($errors->any())
              <div class="alert alert-danger">
                  <ul class="no-margin" style="margin: 0">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              <br>
            @endif

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ trans('country::update.title') }}: <strong>{{ trans("countries-list.$country->slug") }}</strong></h4>
                    <form id="country-form" 
                    action="{{ route('countries.update', ['id' => $country->id]) }}"
                    method="POST">
                    @csrf
                    @method('put')
                    
                    <div class="form-group">
                        <label for="country-name" class="control-label required"> {{trans('country::update.form.name') }}</label>
                        <input type="text" name="name" required value="{{ trans("countries-list.$country->slug") }}" class="form-control" id="country-name">
                    </div>

                    <div class="form-group">
                        <label for="country-iso" class="control-label required"> {{trans('country::update.form.iso') }}</label>
                        <input type="text" name="iso" required value="{{ $country->iso }}" class="form-control" id="country-iso">
                    </div>

                    <div class="form-group">
                        <label class="control-label required">@lang('country::update.form.currency')</label>  
                        <select name="currency" class="form-control" required>
                            <option value="">@lang('country::update.form.select_currencies')</option>
                            @foreach( $currencies as $currency )
                            <option @if($currency->id == $country->currency_id) selected @endif value="{{ $currency->id }}">
                                @lang("currencies-list.$currency->slug")
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label required">@lang('country::update.form.lang')</label>  
                        <select name="lang" class="form-control" required>
                            <option value="">@lang('country::update.form.select_lang')</option>
                            @foreach( $languajes as $lang )
                            <option @if($lang->id == $country->lang_id) selected @endif value="{{ $lang->id }}">
                                @lang("languaje-list.$lang->slug")
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <a href="{{ route('countries.index') }}" type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                        {{ trans('country::update.form.cancel') }}
                    </a>
                    <button onclick="event.preventDefault(); document.getElementById('country-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('country::update.form.submit') }}</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@stop
