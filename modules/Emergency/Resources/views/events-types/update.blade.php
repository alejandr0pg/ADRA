@extends('layouts.app')

@section('title')
	{{ trans('emergency::event-type.update.title') }}: {{ trans('event_types-list.' . $event_type->slug) }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('emergency::event-type.update.title') }}: {{ trans('event_types-list.' . $event_type->slug) }}</h3>
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
                    <h4 class="card-title"><strong>{{ trans('emergency::event-type.update.title') }}: {{ trans('event_types-list.' . $event_type->slug) }}</strong></h4>
                    <hr>
                    <form class="form" id="event-type-form" method="POST"
                        action="{{ route('events-types.update', ['id' => $event_type->id]) }}">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="event-type-name" class="control-label required"> {{trans('emergency::event-type.update.form.name') }}</label>
                            <input type="text" name="name" required value="{{ old('name') ? old('name') : trans('event_types-list.' . $event_type->slug) }}" class="form-control" id="event-type-name">
                        </div>
                           
                        <a href="{{ route('events-types.index') }}" type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                            {{ trans('emergency::event-type.update.form.cancel') }}
                        </a>

                        <button type="submit" class="btn btn-danger waves-effect waves-light" >
                            {{ trans('emergency::event-type.update.form.submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
