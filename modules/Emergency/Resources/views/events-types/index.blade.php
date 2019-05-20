@extends('layouts.app')

@section('title')
    {{ trans('emergency::event-type.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-md-7 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('emergency::event-type.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ trans('breadcrumb.admin') }}</li>
            </ol>
        </div>
        <div class="col-md-5 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <button data-toggle="modal" id="newRole" data-target="#eventModal" class=" waves-effect waves-light btn-outline-success btn btn-rounded pull-right m-l-10">
                    	<i class="ti-plus"></i> {{ trans('emergency::event-type.add-event-type') }}
                    </button>
                </div>
                
            </div>
        </div>
    </div>

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
            @if(session('action'))
                <div class="alert alert-success">
                    {{ trans('emergency::event-type.alerts.' . session('action')) }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{trans('emergency::event-type.table-list')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" data-form="deleteForm">
                            <thead>
                                <tr>
                                    <th width="15%">@lang('emergency::event-type.table.id')</th>
                                    <th width="60%">@lang('emergency::event-type.table.name')</th>
                                    <th width="25%" class="text-nowrap">@lang('emergency::event-type.table.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($event_types as $type)
                                <tr>
                                    <td>{{$type->id}}</td>
                                    <td>@lang("event_types-list.$type->slug")</td>

                                    <td class="text-nowrap">
                                        <a class="btn btn-warning" 
                                            href="{{ route('events-types.modify', $type->id) }}" 
                                            data-toggle="tooltip" 
                                            data-original-title="@lang('emergency::event-type.table.edit')">
                                            <i class="fas fa-pencil-alt text-white"></i>
                                        </a>
                                        
                                        <form  class="form-delete" method="POST" 
                                            style="display: inline-block;" 
                                            action="{{ route('events-types.destroy', $type->id) }}"> 
                                            @csrf
                                            @method('delete')
                                            <button name="delete-modal" data-toggle="tooltip" data-original-title="@lang('emergency::event-type.table.delete')" class="btn text-white btn-danger"> <i class="fas fa-trash"></i> 
                                            </button>
                                        </form>  
                                        
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-danger">@lang('emergency::event-type.table.empty')</td>
                                </tr>
                                @endforelse

                                {{ $event_types->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('emergency::modals.event-type.new')
    @include('emergency::modals.event-type.delete')
@stop

@section('scripts')
    <script type="text/javascript">  
        $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
            e.preventDefault();
            var $form=$(this);
            $('#confirm').modal({ backdrop: 'static', keyboard: false })
                .on('click', '#delete-btn', function(){
                    $form.submit();
                });
        });
    </script>
@stop

