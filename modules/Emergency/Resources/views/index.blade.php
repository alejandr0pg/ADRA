@extends('layouts.app')

@section('title')
    {{ trans('emergency::emergencies.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-md-7 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('emergency::emergencies.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ trans('breadcrumb.admin') }}</li>
            </ol>
        </div>
        <div class="col-md-5 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <button data-toggle="modal" id="newRole" data-target="#emergencyModal" class=" waves-effect waves-light btn-outline-success btn btn-rounded pull-right m-l-10">
                    	<i class="ti-plus"></i> {{ trans('emergency::emergencies.add-emergencies') }}
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
                    {{ trans('emergency::emergencies.alerts.' . session('action')) }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                    	<div class="float-right">
                    		<i class="fas fa-filter" style="float: left;margin-right: 15px;"></i>
                    		<form class="form-inline">
                    			<select onchange="filterByAgency(event)" class="form-control" style="margin-top: -9px;">
		                            <option value="">{{ trans('emergency::emergencies.modal.form.select-agency') }}</option>
		                            @foreach($agencies as $item)
		                                <optgroup label="{{ $item->name }}">
		                                    @foreach($item->childrens as $data)
		                                    <option value="{{ $data->id }}" @if(isset($agency_selected) && $agency_selected->id == $data->id) selected @endif>{{ $data->name }}</option>
		                                    @endforeach
		                                </optgroup>
		                            @endforeach
		                        </select>
                    		</form>
                    	</div>
                    	{{ trans('emergency::emergencies.table-list') }}
                	</h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="table " data-form="deleteForm">
                            <thead>
                                <tr>
                                    <th width="6%">@lang('emergency::emergencies.table.code')</th>
                                    <th>@lang('emergency::emergencies.table.name')</th>
                                    <th>@lang('emergency::emergencies.table.cordinator')</th>
                                    <th>@lang('emergency::emergencies.table.agency')</th>
                                    <th>@lang('emergency::emergencies.table.contribution')</th>
                                    <th class="bg-danger text-white">@lang('emergency::emergencies.table.date')</th>
                                    <th class="bg-dark text-white">@lang('emergency::emergencies.table.d+20')</th>
                                    <th class="bg-info" width="5%" class="text-nowrap"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($emergencies as $emergency)
                                <tr>
                                    <td style="border:0;border-left: 25px solid;border-color: white;" class="@if($emergency->status == 0) border-danger @elseif($emergency->status == 2) border-warning @elseif($emergency->status == 1) border-success @endif"><a href="{{ route('emergency.dashboard', $emergency->id) }}">{{ $emergency->code }}</a></td>
                                    <td><a href="{{ route('emergency.dashboard', $emergency->id) }}">{{ $emergency->name }}</a>
                                    <td>
                                        @if($emergency->cordinator)
                                            <a href="{{ route('admin.user-details', $emergency->cordinator->id) }}">{{ $emergency->cordinator->name }}</td>
                                        @else
                                            @lang('emergency::emergencies.not-established')
                                        @endif
                                    </td>
                                    <td>{{ data_get($emergency, 'agency.name', trans('emergency::emergencies.not-established')) }}</td>
                                    <td>
                                        @if($emergency->contribution)
                                            @lang("contributions-list." . $emergency->contribution->slug)
                                        @else
                                            @lang('emergency::emergencies.not-established')
                                        @endif
                                    </td>
                                    <td>{{ $format_date($emergency->event_date) }}</td>
                                    <td>{{ $format_date($emergency->start_date, 20) }}</td>
                                    <td class="text-nowrap">
                                        <a class="btn btn-warning" 
                                            href="{{ route('emergency.modify', $emergency->id) }}" 
                                            data-toggle="tooltip" 
                                            data-original-title="@lang('emergency::emergencies.table.edit')">
                                            <i class="fas fa-pencil-alt text-white"></i>
                                        </a>
                                        
                                        <form  class="form-delete" method="POST" 
                                            style="display: inline-block;" 
                                            action="{{ route('emergency.destroy', $emergency->id) }}"> 
                                            @csrf
                                            @method('delete')
                                            <button name="delete-modal" data-toggle="tooltip" data-original-title="@lang('emergency::emergencies.table.delete')" class="btn text-white btn-danger"> <i class="fas fa-trash"></i> 
                                            </button>
                                        </form>  
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-danger">@lang('emergency::emergencies.table.empty')</td>
                                </tr>
                                @endforelse

                                {{ $emergencies->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('emergency::modals.new')
    @include('emergency::modals.delete')
@stop

@section('styles')
    <link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('scripts')
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">  
        $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
            e.preventDefault();
            var $form=$(this);
            $('#confirm').modal({ backdrop: 'static', keyboard: false })
                .on('click', '#delete-btn', function(){
                    $form.submit();
                });
        });

        $(".select2").select2();

        function filterByAgency(event) {
	        if(event.target.value) {
	        	window.location.href = "{{ route('emergency.index') }}?agency=" + event.target.value;
	        }
	    }
    </script>
@stop