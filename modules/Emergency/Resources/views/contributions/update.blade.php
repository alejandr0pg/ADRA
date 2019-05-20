@extends('layouts.app')

@section('title')
	{{ trans('emergency::contributions.update.title') }}: {{ trans('contributions-list.' . $contribution->slug) }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('emergency::contributions.update.title') }}: {{ trans('contributions-list.' . $contribution->slug) }}</h3>
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
                    <h4 class="card-title"><strong>{{ trans('emergency::contributions.update.title') }}: {{ trans('contributions-list.' . $contribution->slug) }}</strong></h4>
                    <hr>
                    <form class="form" id="event-type-form" method="POST"
                        action="{{ route('contributions.update', ['id' => $contribution->id]) }}">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="event-type-name" class="control-label required"> {{trans('emergency::contributions.update.form.name') }}</label>
                            <input type="text" required name="name" value="{{ old('name') ? old('name') : trans('contributions-list.' . $contribution->slug) }}" class="form-control" id="event-type-name">
                        </div>
                           
                        <a href="{{ route('contributions.index') }}" type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                            {{ trans('emergency::contributions.update.form.cancel') }}
                        </a>

                        <button type="submit" class="btn btn-danger waves-effect waves-light" >
                            {{ trans('emergency::contributions.update.form.submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
