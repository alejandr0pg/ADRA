@extends('layouts.app')

@section('title')
	{{ trans('agency::update.title') }}: {{ $agency->name }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('agency::update.title') }}: {{ $agency->name }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ trans('breadcrumb.admin') }}</li>
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
                    <h4 class="card-title"><strong>{{ trans('agency::update.title') }}: {{ $agency->name }}</strong></h4>
                    <hr>
                    <form class="form" id="languaje-form" method="POST"
                        action="{{ route('agency.update', ['id' => $agency->id]) }}">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="agency-name" class="control-label"> {{trans('agency::update.modal.form.name') }}</label>
                                    <input type="text" name="name" value="{{ old('name') ? old('name') : $agency->name }}" class="form-control" id="agency-name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="agency-country" class="control-label"> {{trans('agency::update.modal.form.country') }}</label>
                                    <select name="country" id="agency-country" class="form-control">
                                        <option value="">{{ trans('agency::update.modal.form.select-country') }}</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" 
                                                @if( old('country') && $country->id == old('country') || $country->id == $agency->country_id ) selected @endif>
                                                @lang("countries-list.$country->slug")
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agency-director" class="control-label"> {{trans('agency::update.modal.form.director') }}</label>
                            <select name="director" id="agency-director" class="form-control">
                                <option value="">{{ trans('agency::update.modal.form.select-employee') }}</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        @if( old('director') && $employee->id == old('director') || $employee->id == $agency->director_id ) selected @endif>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agency-mission" class="control-label"> {{ trans('agency::update.modal.form.mission') }}</label>
                            <textarea name="mission" id="agency-mission" class="form-control">{{ $agency->mission }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="agency-vision" class="control-label"> {{ trans('agency::update.modal.form.vision') }}</label>
                            <textarea name="vision" id="agency-vision" class="form-control">{{ $agency->mission }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="agency-belong-to" class="control-label"> {{trans('agency::update.modal.form.belong-to') }}</label>
                            <select disabled name="belong_to" id="agency-belong-to" class="form-control">
                                <option @if($agency->bolong_to === 0) selected @endif value="">{{ trans('agency::update.modal.form.select-agency') }}</option>
                                @foreach($agencies_selects as $agencie)
                                    <option value="{{ $agencie->id }}"
                                        @if( old('belong_to') && $agencie->id == old('belong_to') || $agencie->id == $agency->belong_to ) selected @endif>
                                        {{ $agencie->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agency-vigency" class="control-label"> {{ trans('agency::update.modal.form.vigency') }}</label>
                            <div class="switch">
                                <label>
                                    @lang('agency::update.modal.form.check.off')
                                    <input type="checkbox" name="vigency" value="1" @if($agency->vigency) checked @endif><span class="lever"></span>
                                    @lang('agency::update.modal.form.check.on')
                                </label>
                            </div>
                        </div>

                        <a href="{{ route('agency') }}" type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                            {{ trans('languajes.form.cancel') }}
                        </a>

                        <button type="button" class="btn btn-danger waves-effect waves-light"
                                onclick="event.preventDefault(); document.getElementById('languaje-form').submit();">
                            {{ trans('languajes.form.submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
