@extends('layouts.app')

@section('title')
	[{{ $emergency->code }}] {{ $emergency->name }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">[{{ $emergency->code }}] {{ $emergency->name }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ trans('emergency::emergencies.breadcrumb') }}</a></li>
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
                    <h4 class="card-title"><strong>{{ trans('emergency::update.title') }}: {{ $emergency->name }}</strong></h4>
                    <hr>
                    <form class="form" id="update-emergency-form" method="POST"
                        action="{{ route('emergency.update', ['id' => $emergency->id]) }}">
                        @csrf
                        @method('put')
                        
                        <div class="form-group">
                            <label for="emergency-code" class="control-label required"> {{ trans('emergency::emergencies.modal.form.code') }}</label>
                            <input type="text" name="code" required value="{{ old('code') ? old('code') : $emergency->code }}" class="form-control" id="emergency-code">
                        </div>
                        
                        <div class="form-group">
                            <label for="emergency-belong-to" class="control-label required"> {{ trans('emergency::emergencies.modal.form.belong-to') }}</label>
                            <select @if(!isset($agencies)) disabled @endif required name="belong_to" id="emergency-belong-to" class="form-control">
                                <option value="">{{ trans('emergency::emergencies.modal.form.select-agency') }}</option>
                                @foreach($agencies as $item)
                                    <optgroup label="{{ $item->name }}">
                                        @foreach($item->childrens as $data)
                                        <option value="{{ $data->id }}" @if(old('belong_to') == $data->id) selected @elseif($emergency->agency_id == $data->id) selected @endif>{{ $data->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="emergency-name" class="control-label required"> {{trans('emergency::emergencies.modal.form.name') }}</label>
                            <input type="text" name="name" required value="{{ old('name') ? old('name') : $emergency->name }}" class="form-control" id="emergency-name">
                        </div>
                    
                        <div class="form-group">
                            <label for="emergency-description" class="control-label"> {{trans('emergency::emergencies.modal.form.description') }}</label>
                            <textarea name="description" id="emergency-description" class="form-control">{{ old('description') ? old('description') : $emergency->description }}</textarea>
                        </div>
                    
                        <div class="form-group">
                            <label for="emergency-type" class="control-label required"> {{trans('emergency::emergencies.modal.form.type') }}</label>
                            <select name="type" id="emergency-type" class="form-control" required>
                                <option value="">{{ trans('emergency::emergencies.modal.form.select-type') }}</option>
                                @foreach($types as $type)
                                    <option @if(old('type') == $type->id) 
                                                selected 
                                            @elseif($emergency->event_type_id == $type->id)
                                                selected 
                                            @endif value="{{ $type->id }}">
                                        @lang("event_types-list." . $type->slug)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="emergency-contribution" class="control-label required"> {{trans('emergency::emergencies.modal.form.contribution') }}</label>
                            <select name="contribution" id="emergency-contribution" required class="form-control">
                                <option value="">{{ trans('emergency::emergencies.modal.form.select-contribution') }}</option>
                                @foreach($contributions as $contribution)
                                    <option @if(old('contribution') == $contribution->id) 
                                                selected 
                                            @elseif($emergency->contribution_id == $contribution->id)
                                                selected 
                                            @endif value="{{ $contribution->id }}">
                                        @lang("contributions-list." . $contribution->slug)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="emergency-currency" class="control-label required"> {{trans('emergency::emergencies.modal.form.currency') }}</label>
                            <select name="currency" id="emergency-currency" required class="form-control">
                                <option value="">{{ trans('emergency::emergencies.modal.form.select-currency') }}</option>
                                @foreach($currencies as $currency)
                                    <option @if(old('currency') == $currency->id) 
                                                selected 
                                            @elseif($emergency->currency_id == $currency->id)
                                                selected 
                                            @endif value="{{ $currency->id }}">
                                        @lang("currencies-list." . $currency->slug)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                   
                        
                        <div class="form-group">
                            <label for="emergency-cordinator" class="control-label required"> {{trans('emergency::emergencies.modal.form.cordinator') }}</label>
                            <select name="cordinator" id="emergency-cordinator" required class="form-control">
                                <option value="">{{ trans('emergency::emergencies.modal.form.select-cordinator') }}</option>
                                @foreach($employees as $employee)
                                    <option @if(old('cordinator') == $employee->id) 
                                                selected 
                                            @elseif($emergency->cordinator_id == $employee->id)
                                                selected 
                                            @endif value="{{ $employee->id }}">
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-6"> 
                                <div class="form-group">
                                    <label for="event-date" class="control-label required"> {{ trans('emergency::emergencies.modal.form.event_date') }}</label>
                                    <input type="date" name="event_date" required value="{{ old('event_date') ? old('event_date') : $emergency->event_date }}" class="form-control" id="event-date">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="start-date" class="control-label required"> {{ trans('emergency::emergencies.modal.form.start_date') }}</label>
                                    <input type="date" name="start_date" required value="{{ old('start_date') ? old('start_date') : $emergency->start_date }}" class="form-control" id="start-date">
                                </div> 
                            </div>
                        </div>
                        
                        <div class="form-group m-b-0">
                            <label for="emergency-vigency" class="control-label required"> {{trans('emergency::emergencies.modal.form.vigency') }}</label>
                            <div class="switch">
                                <label>
                                    @lang('emergency::emergencies.modal.form.check.off')
                                    <input type="checkbox" name="vigency" value="1" 
                                        @if(old('vigency')) 
                                            checked 
                                        @elseif($emergency->status == 1) 
                                            checked 
                                        @endif><span class="lever"></span>
                                    @lang('emergency::emergencies.modal.form.check.on')
                                </label>
                            </div>
                        </div>

                        <a href="{{ route('emergency.index') }}" type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                            {{ trans('emergency::update.form.cancel') }}
                        </a>

                        <button type="button" class="btn btn-danger waves-effect waves-light"
                                onclick="event.preventDefault(); document.getElementById('update-emergency-form').submit();">
                            {{ trans('emergency::update.form.submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
