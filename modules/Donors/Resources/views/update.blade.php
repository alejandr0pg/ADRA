@extends('layouts.app')

@section('title')
	{{ trans('donors::update.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('donors::update.title') }}: {{ $donor->name }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{ trans('breadcrumb.admin') }}</li>
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
                    <h4 class="card-title">{{ trans('donors::update.title') }}: <strong>{{ $donor->name }}</strong></h4>
                    <hr>
                    <form id="donor-update-form" 
                    action="{{ route('donors.update', $donor->id) }}"
                    method="POST">
                    @csrf
                    @method('put')
                    
                    <div class="form-group">
                        <label for="donors-origin" class="control-label required"> {{trans('donors::modal-new.form.origin') }}</label>
                        <select name="origin" id="donors-origin" required class="form-control">
                          <option value="">@lang('donors::modal-new.form.select-origin')</option>
                          @foreach($origins as $origin)
                            <option @if($donor->origin_id == $origin->id) selected @endif value="{{ $origin->id }}">
                              {{ trans("donors-origins-list.$origin->slug") }}
                            </option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="donors-name" class="control-label required"> {{trans('donors::modal-new.form.name') }}</label>
                        <input type="text" name="name" required value="{{ $donor->name }}" class="form-control" id="donors-name">
                    </div>
                    <div class="form-group">
                        <label for="donors-contact_name" class="control-label required"> {{trans('donors::modal-new.form.contact_name') }}</label>
                        <input type="text" name="contact_name" required value="{{ $donor->contact_name }}" class="form-control" id="donors-contact_name">
                    </div>
                    <div class="form-group">
                        <label for="donors-contact_email" class="control-label required"> {{trans('donors::modal-new.form.contact_email') }}</label>
                        <input type="text" name="contact_email" required value="{{ $donor->contact_email }}" class="form-control" id="donors-contact_email">
                    </div>
                    <div class="form-group">
                        <label for="donors-contact_phone"  class="control-label required"> {{trans('donors::modal-new.form.contact_phone') }}</label>
                        <input type="text" name="contact_phone" required value="{{ $donor->contact_phone }}" class="form-control" id="donors-contact_phone">
                    </div>
                    <div class="form-group m-b-0">
                        <label for="donors-vigency" class="control-label required"> {{trans('donors::modal-new.form.vigency') }}</label>
                        <div class="switch">
                            <label>
                                @lang('donors::modal-new.form.check.off')
                                <input type="checkbox" name="vigency" @if($donor->vigency) checked @endif><span class="lever"></span>
                                @lang('donors::modal-new.form.check.on')
                            </label>
                        </div>
                    </div>

                    <a href="{{ route('donors.index') }}" type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('donors::update.form.cancel') }}</a>
                    <button onclick="event.preventDefault(); document.getElementById('donor-update-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('donors::update.form.submit') }}</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@stop
