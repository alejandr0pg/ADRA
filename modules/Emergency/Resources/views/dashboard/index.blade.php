@extends('layouts.app')

@section('title')
    [{{ $emergency->code }}] {{ $emergency->name }}
@stop

@section('styles')
    <!-- Popup CSS -->
    <link href="{{ asset('modules/emergency/vendor/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
@stop

@section('content')
    <style>
        .todo-list li {
            border: 0px;
            margin-bottom: 0px;
            padding: 0px 15px 30px 0px;
        }
    </style>
    

    <div class="row" style="padding-top: 30px">
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
                    {{ trans('emergency::dashboard.alerts.' . session('action')) }}
                </div>
            @endif
            <div class="card ">
                <div class="card-body">
                    <h3>
                        <strong><i class="flag-icon flag-icon-{{ $emergency->country->iso }}"></i> [{{ $emergency->code }}] {{ $emergency->name }}</strong>
                        <div class="float-right" style="margin-top: -4px;">
                            <a href="{{ route('emergency.index') }}" 
                                class="waves-effect waves-light btn-outline-dark btn btn-rounded pull-right m-l-10">
                                <i class="icon-arrow-left-circle"></i> {{ trans('emergency::dashboard.back-btn') }}
                            </a>
                            <a href="{{ route('emergency.modify', $emergency->id) }}" class=" waves-effect waves-light btn-outline-success btn btn-rounded pull-right m-l-10">
                                <i class="ti-pencil"></i> {{ trans('emergency::dashboard.update-btn') }}
                            </a>
                        </div>
                    </h3>
                    <small>
                        <strong>{{ trans('emergency::dashboard.cordinate') }}: </strong>
                        @if($emergency->cordinator)
                            <a href="{{ route('admin.user-details', $emergency->cordinator->id) }}">
                                {{ $emergency->cordinator->name }} &nbsp;&nbsp;
                            </a>
                        @else
                            @lang('emergency::emergencies.not-established')
                        @endif
                    </small><br>
                    <small>
                        <strong>{{ trans('emergency::dashboard.agency') }}: </strong>
                        {{ $emergency->agency->name }} &nbsp;&nbsp;
                        
                    </small><br>
                    <small>
                        <strong>{{ trans('emergency::dashboard.regional-director') }}: </strong>
                        @if($emergency->regionalDirector)
                            <a href="{{ route('admin.user-details', $emergency->regionalDirector->id) }}">
                                {{ $emergency->regionalDirector->name }} &nbsp;&nbsp; 
                            </a>
                        @else
                            @lang('emergency::emergencies.not-established')
                        @endif
                        <strong>{{ trans('emergency::dashboard.national-director') }}: </strong>

                        @if($emergency->nationalDirector)
                            <a href="{{ route('admin.user-details', $emergency->nationalDirector->id) }}">
                                {{ $emergency->nationalDirector->name }} 
                            </a>
                        @else
                            @lang('emergency::emergencies.not-established')
                        @endif
                    </small><br>
                    <small>
                        <strong>{{ trans('emergency::dashboard.date-event') }}: </strong>
                        {{ $format_date($emergency->event_date) }}
                        <br>
                        <strong>{{ trans('emergency::dashboard.task-date-start') }}: </strong>
                        {{ $format_date($emergency->start_date) }}
                        <br>
                        <strong>{{ trans('emergency::dashboard.currency') }}: </strong>
                        @if($emergency->currency)
                            {{ trans('currencies-list.'.$emergency->currency->slug) }}
                        @else
                            @lang('emergency::emergencies.not-established')
                        @endif
                    </small>
                   
                    <hr>
                    <p><strong>{{ trans('emergency::dashboard.description') }}:</strong> {{ $emergency->description }}</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body" style="max-height: 542px;">
                    <div class="d-flex no-block align-items-center">
                        <h4 class="card-title" style="margin: 0">{{ trans('emergency::dashboard.tasks') }}</h4>
                        <!--<div class="ml-auto">
                            <button class="btn btn-sm btn-rounded btn-success" data-toggle="modal" data-target="#myModal">Añadir</button>
                        </div>-->
                    </div>
                    <!-- ============================================================== -->
                    <!-- To do list widgets -->
                    <!-- ============================================================== -->
                    <div class="to-do-widget">
                        <!-- .modal for add task -->
                        <!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Task</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Your Name">
                                            </div>
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" class="form-control" placeholder="Enter email">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <!-- /.modal -->
                        <ul class="list-task todo-list list-group m-b-0" data-role="tasklist" style="overflow-y: scroll;max-height: 477px;overflow-x: hidden;margin: 15px -20px;">
                            @foreach($tasks($emergency->id) as $task)
                            <li class="list-group-item" data-role="task">
                                <div class="bg-success" style="padding: 15px;margin: -1px -20px 16px 0px;">
                                    <span class="badge badge-{{ $task->class }}" style="font-weight: 400;">{{ trans('tasks-list.' . $task->slug) }}</span> 
                                    <div class="item-date text-white"> {{ $format_date($emergency->start_date, $task->day_plus) }}</div>
                                    
                                    <span style="margin: 4px 0 0 5px" class="label label-light-danger float-right" style="margin-left: 5px">D+({{ $task->day_plus }})</span>
                                    @if($loop->first)
                                        <span style="margin: 4px 0 0 5px" class="label label-light-success float-right">{{ trans('emergency::dashboard.task-date-start') }}</span>
                                    @endif
                                  
                                </div>
                                <ul class="assignedto">
                                    @foreach($task->list as $item)
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" @if($item->checked) checked @endif @if($emergency->status == 0) disabled @endif id="{{ $item->slug }}" name="{{ $item->slug }}" @if($emergency->status) onclick="setToggleTask({{ $item->id }})" @endif>
                                        <label for="{{ $item->slug }}"> <span>{{ trans('tasks-items-list.' . $item->slug) }}</span> </label>
                                    </div>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body" style="max-height: 546px;">
                    <div class="d-flex no-block align-items-center">
                        <h4 class="card-title" style="margin: 0">{{ trans('emergency::dashboard.sitrep') }}</h4>
                        @if($emergency->status == 1)
                            <div class="ml-auto">
                                @if($sitrep)
                                    <a href="{{ route('emergency.dashboard.sitrep', $emergency->id) }}" class="btn btn-sm btn-rounded btn-success">
                                        {{ trans('emergency::dashboard.sitrep-update')}}
                                    </a>

                                    <a href="{{ route('emergency.dashboard.sitrep.pdf', [$emergency->id, $sitrep->id]) }}" class="btn btn-sm btn-rounded btn-success">
                                        {{ trans('emergency::dashboard.sitrep-pdf')}}
                                    </a>
                                @else
                                    <a href="{{ route('emergency.dashboard.sitrep', $emergency->id) }}" class="btn btn-sm btn-rounded btn-success">
                                        {{ trans('emergency::dashboard.sitrep-add') }}
                                    </a>   
                                @endif
                            </div>
                        @endif
                    </div>
                    <hr>
                    @if($sitrep)
                        <div class="social-widget">
                            <div class="soc-content">
                                <div class="row">
                                    @foreach( $sitrep->extra_info as $info)
                                        @if( $loop->count % 2 == 0 )
                                            <div class="@if($loop->iteration % 2 != 0) b-r @endif @if($loop->iteration > 2) b-t @endif col-6">
                                                <h3 class="font-medium">{{ $info->value }}</h3>
                                                <h6 class="text-muted">{{ trans('sitrep-extra-info-' . $emergency->id . '-list.' . $info->slug) }}</h6>
                                            </div>
                                        @elseif($sitrep->extra_info->count() === 1)
                                            <div class="col-12">
                                                <h3 class="font-medium">{{ $info->value }}</h3>
                                                <h6 class="text-muted">{{ trans('sitrep-extra-info-' . $emergency->id . '-list.' . $info->slug) }}</h6>
                                            </div>
                                        @else
                                            @if ($loop->last)
                                                <div class="b-r b-t col-12">
                                                    <h3 class="font-medium">{{ $info->value }}</h3>
                                                    <h6 class="text-muted">{{ trans('sitrep-extra-info-' . $emergency->id . '-list.' . $info->slug) }}</h6>
                                                </div>
                                            @else
                                                <div class="b-r @if($loop->iteration > 2) b-t @endif col-6">
                                                    <h3 class="font-medium">{{ $info->value }}</h3>
                                                    <h6 class="text-muted">{{ trans('sitrep-extra-info-' . $emergency->id . '-list.' . $info->slug) }}</h6>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="border text-center text-danger p-10" style="border-color: #f3f1f1!important;">
                            {{ trans('emergency::dashboard.empty-sitrep') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-body" style="max-height: 546px;">
                    <div class="d-flex no-block align-items-center">
                        <h4 class="card-title" style="margin: 0">{{ trans('emergency::dashboard.documents') }}</h4>
                        @if($emergency->status == 1)
                        <div class="ml-auto">
                            <button class="btn btn-sm btn-rounded btn-success" data-toggle="modal" data-target="#docsModal">@lang('emergency::dashboard.documents-add')</button>
                        </div>
                        <!-- .modal for add docs -->
                        <div class="modal fade" id="docsModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">@lang('emergency::dashboard.modal-docs.title')</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" id="upload-docs-form" enctype="multipart/form-data" action="{{ route('emergency.dashboard.upload.doc') }}">
                                            @csrf
                                            <input type="hidden" name="emergency" value="{{ $emergency->id }}">
                                            <div class="form-group">
                                                <label>{{ trans('emergency::dashboard.modal-docs.form.name') }}</label>
                                                <input name="name" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="docs-type" class="control-label"> 
                                                    {{ trans('emergency::dashboard.modal-docs.form.type') }}
                                                </label>
                                                <select name="type" id="docs-type" class="form-control">
                                                    <option value="">{{ trans('emergency::dashboard.modal-docs.form.select-type') }}</option>
                                                    @foreach($types as $type)
                                                        <option @if(old('type')) selected @endif value="{{ $type->id }}">
                                                            {{ trans('tasks-list.' . $type->slug) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('emergency::dashboard.modal-docs.form.file') }}</label>
                                                <br>
                                                <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                                    <span><i class="ion-upload m-r-5"></i>@lang('emergency::dashboard.modal-docs.form.upload')</span>
                                                    <input type="file" name="doc" class="upload" > 
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            @lang('emergency::dashboard.modal-docs.form.cancel')
                                        </button>
                                        <button type="button" onclick="event.preventDefault();document.getElementById('upload-docs-form').submit();" class="btn btn-success">
                                            @lang('emergency::dashboard.modal-docs.form.submit')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered" data-form="deleteForm">
                            <tbody>
                                @forelse($documents as $doc)
                                <tr>
                                    <td width="80%"><div style="width: 20px;height: 52px;float: left;margin-right:  15px !important;display: block;margin: -15px;" class="bg-{{ $doc->fileType->class }}"></div>{{ $doc->name }}</td>
                                    <td><a class="btn btn-primary btn-sm" download href="{{ asset($doc->path) }}" ><i class="fas fa-download"></i></a></td>
                                    <td>
                                        <form class="form-delete" method="POST" 
                                            style="display: inline-block;" 
                                            action="{{ route('emergency.dashboard.delete.doc', $doc->id) }}"> 
                                            @csrf
                                            @method('delete')
                                            <button name="delete-modal"  class="btn text-white btn-danger btn-sm"> <i class="fas fa-trash"></i> 
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-danger">
                                        @lang('emergency::dashboard.documents-empty')
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div>
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item flex-column active">
                                <h3>{{ trans('emergency::dashboard.response-adra') }}</h3>
                                <h1><span class="font-bold">{{ trans('contributions-list.' . $emergency->contribution->slug) }}</span></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <div>
                        <!-- .modal for add budget -->
                        <div class="modal fade" id="budgetModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">@lang('emergency::dashboard.modal-budget.title')</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" id="budget-form" enctype="multipart/form-data" 
                                            action="{{ route('emergency.dashboard.budget-store') }}">
                                            @csrf
                                            <input type="hidden" name="emergency" value="{{ $emergency->id }}">
                                            <div class="form-group">
                                                <label for="donor" class="control-label"> 
                                                    {{ trans('emergency::dashboard.modal-budget.form.donor') }}
                                                </label>
                                                <select name="donor" id="donor" class="form-control">
                                                    <option value="">{{ trans('emergency::dashboard.modal-budget.form.select-donor') }}</option>
                                                    @foreach($donors as $donor)
                                                        <option @if(old('donor') == $donor->id) selected @endif value="{{ $donor->id }}">
                                                            {{ $donor->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="img-type" class="control-label"> 
                                                    {{ trans('emergency::dashboard.modal-budget.form.type') }}
                                                </label>
                                                <select name="type" id="img-type" class="form-control">
                                                    <option value="">{{ trans('emergency::dashboard.modal-budget.form.select-type') }}</option>
                                                    <option value="cash">{{ trans('emergency::dashboard.modal-budget.type-list.cash') }}</option>
                                                    <option value="in-kind">{{ trans('emergency::dashboard.modal-budget.type-list.in-kind') }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('emergency::dashboard.modal-budget.form.description') }}</label>
                                                <input name="description" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('emergency::dashboard.modal-budget.form.date') }}</label>
                                                <input name="date" type="date" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="currency_origin" class="control-label"> 
                                                    {{ trans('emergency::dashboard.modal-budget.form.currency') }}
                                                </label>
                                                <select name="currency_origin" id="currency_origin" class="form-control">
                                                    <option value="">{{ trans('emergency::dashboard.modal-budget.form.select-currency') }}</option>
                                                    @foreach($currencies as $currency)
                                                        <option @if(old('currency_origin') == $currency->id) selected @endif value="{{ $currency->id }}">
                                                            {{ trans('currencies-list.' . $currency->slug) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('emergency::dashboard.modal-budget.form.tasa') }}</label>
                                                <input name="tasa" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('emergency::dashboard.modal-budget.form.quantity') }}</label>
                                                <input name="quantity" type="text" class="form-control">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            @lang('emergency::dashboard.modal-budget.form.cancel')
                                        </button>
                                        <button type="button" onclick="event.preventDefault();document.getElementById('budget-form').submit();" class="btn btn-success">
                                            @lang('emergency::dashboard.modal-budget.form.submit')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .modal for add budget -->
                        <div class="modal fade" id="budgetListModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">@lang('emergency::dashboard.modal-budget.title')</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" data-form="deleteForm">
                                                <thead>
                                                    <tr>
                                                        <th width="30%">@lang('emergency::dashboard.budget-table.donor')</th>
                                                        <th width="15%">@lang('emergency::dashboard.budget-table.type')</th>
                                                        <th width="15%">@lang('emergency::dashboard.budget-table.currency')</th>
                                                        <th width="17%">@lang('emergency::dashboard.budget-table.amount')</th>
                                                        <th width="6%">@lang('emergency::dashboard.budget-table.tasa')</th>
                                                        <th width="17%">@lang('emergency::dashboard.budget-table.total')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($budgets as $budget)
                                                        <tr>
                                                            <td>{{ $budget->donor->name }}</td>
                                                            <td>{{ trans('emergency::dashboard.modal-budget.type-list.' . $budget->budget_type) }}</td>
                                                            <td>
                                                                @if($budget->originCurrency)
                                                                    {{ trans('currencies-list.' . $budget->originCurrency->slug) }}
                                                                @else
                                                                    @lang('emergency::emergencies.not-established')
                                                                @endif    
                                                            </td>
                                                            <td>
                                                                @if($budget->originCurrency)
                                                                    {{ $budget->originCurrency->symbol }}
                                                                @endif

                                                                {{ $budget->origin_amount }}
                                                            </td>
                                                            <td>{{ $budget->tasa }}</td>
                                                            <td>{{ $emergency->currency ? $emergency->currency->symbol : '' }} {{ $budget->total_amount }}</td>
                                                            <td>
                                                                <form  class="form-delete" method="POST" 
                                                                    style="display: inline-block;" 
                                                                    action="{{ route('emergency.dashboard.budget-delete', [$emergency->id, $budget->id]) }}"> 
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button name="delete-modal" data-toggle="tooltip" data-original-title="@lang('emergency::emergencies.table.delete')" class="btn text-white btn-danger"> <i class="fas fa-trash"></i> 
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center text-danger">
                                                                @lang('emergency::dashboard.budget-table.empty')
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            @lang('emergency::dashboard.modal-budget.form.close')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item flex-column active">
                                <h3>{{ trans('emergency::dashboard.budget') }}</h3>
                                <h1><span class="font-bold">{{ $emergency->currency ? $emergency->currency->symbol : '' }} {{ $emergency->budget }}</span></h1>
                                <div class="m-b-5">
                                    <button class="btn btn-outline-success btn-rounded waves-effect waves-light m-t-15" 
                                            data-toggle="modal" data-target="#budgetListModal">
                                        {{ trans('emergency::dashboard.butget-details') }}
                                    </button>
                                    @if($emergency->status == 1)
                                        <button class="btn btn-outline-success btn-rounded waves-effect waves-light m-t-15" 
                                                data-toggle="modal" data-target="#budgetModal">
                                            {{ trans('emergency::dashboard.register-donation') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div>
                        <!-- .modal for add budget -->
                        <div class="modal fade" id="expenditureModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">@lang('emergency::dashboard.modal-expenditure.title')</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" id="expenditure-form" enctype="multipart/form-data" 
                                            action="{{ route('emergency.dashboard.expenditure-store') }}">
                                            @csrf
                                            <input type="hidden" name="emergency" value="{{ $emergency->id }}">
                                            <div class="form-group">
                                                <label for="concept-expenditure" class="control-label"> 
                                                    {{ trans('emergency::dashboard.modal-expenditure.form.concept-expenditure') }}
                                                </label>
                                                <select name="concept_expenditure" id="concept-expenditure" class="form-control">
                                                    <option value="">{{ trans('emergency::dashboard.modal-expenditure.form.select-concept-expenditure') }}</option>
                                                    @foreach($expenditureConcepts as $concept)
                                                        <option @if(old('concept-expenditure') == $concept->id) selected @endif value="{{ $concept->id }}">
                                                            {{ trans('concepts-list.' . $concept->slug) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('emergency::dashboard.modal-expenditure.form.description') }}</label>
                                                <input name="description" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('emergency::dashboard.modal-expenditure.form.date') }}</label>
                                                <input name="date" type="date" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('emergency::dashboard.modal-expenditure.form.amount') }}</label>
                                                <input name="amount" type="number" min="0" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('emergency::dashboard.modal-expenditure.form.proveedor') }}</label>
                                                <input name="proveedor" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('emergency::dashboard.modal-expenditure.form.support') }}</label>
                                                <br>
                                                <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                                    <span><i class="ion-upload m-r-5"></i>@lang('emergency::dashboard.modal-expenditure.form.upload-support')</span>
                                                    <input type="file" name="support" class="upload"> 
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            @lang('emergency::dashboard.modal-expenditure.form.cancel')
                                        </button>
                                        <button type="button" onclick="event.preventDefault();document.getElementById('expenditure-form').submit();" class="btn btn-success">
                                            @lang('emergency::dashboard.modal-expenditure.form.submit')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .modal for add budget -->
                        <div class="modal fade" id="expenditureListModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">@lang('emergency::dashboard.modal-expenditure.title')</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" data-form="deleteForm">
                                                <thead>
                                                    <tr>
                                                        <th>@lang('emergency::dashboard.expenditure-table.concept')</th>
                                                        <th>@lang('emergency::dashboard.expenditure-table.amount')</th>
                                                        <th width="5%"></th>
                                                        <th width="5%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        if(!isset($total)) $total = 0;
                                                    @endphp
                                                    @forelse($expenditureConcepts as $item)
                                                        @if($item->expenditure->count())
                                                            <tr>
                                                                <td colspan="4" class="text-muted"><strong>{{ trans('concepts-list.' . $item->slug) }}</strong></td>
                                                            </tr>
                                                            @foreach($item->expenditure as $expenditure)
                                                                <tr>
                                                                    <td>{{ $expenditure->description }}</td>
                                                                    <td>{{ $emergency->currency->symbol }} {{ $expenditure->amount }}</td>
                                                                    <td>
                                                                        @if($expenditure->document_path)
                                                                            <a class="btn btn-primary" data-toggle="tooltip" data-original-title="@lang('emergency::dashboard.expenditure-table.support')" href="{{ url($expenditure->document_path) }}" download><i class="ti-download"></i></a>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <form class="form-delete" method="POST" 
                                                                            style="display: inline-block;" 
                                                                            action="{{ route('emergency.dashboard.expenditure-delete', [$emergency->id, $expenditure->id]) }}"> 
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button name="delete-modal" data-toggle="tooltip" data-original-title="@lang('emergency::emergencies.table.delete')" class="btn text-white btn-danger"> <i class="fas fa-trash"></i> 
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $total += $expenditure->amount;
                                                                @endphp
                                                            @endforeach
                                                        @endif


                                                        @if($loop->last)
                                                            <tr>
                                                                <td class="text-right"><strong>Total:</strong></td>
                                                                <td>{{ $emergency->currency->symbol }} {{ $total }}</td>
                                                                <td colspan="2" ></td>
                                                            </tr>
                                                        @endif
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center text-danger">
                                                                @lang('emergency::dashboard.expenditure-table.empty')
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>                                        
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            @lang('emergency::dashboard.modal-expenditure.form.close')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item flex-column active">
                                <h3>{{ trans('emergency::dashboard.expenditure') }}</h3>
                                <h1>
                                    <span class="font-bold">
                                        {{ $emergency->currency->symbol }} {{ $emergency->total_cost }}
                                    </span>
                                </h1>
                                <div class="m-b-5">
                                    <button class="btn btn-outline-success btn-rounded waves-effect waves-light m-t-15" data-toggle="modal" data-target="#expenditureListModal">{{ trans('emergency::dashboard.expenditure-details') }}</button>
                                    @if($emergency->status == 1)
                                    <button class="btn btn-outline-success btn-rounded waves-effect waves-light m-t-15" data-toggle="modal" data-target="#expenditureModal">{{ trans('emergency::dashboard.expenditure-add') }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body" style="max-height: 546px;">
                    <div class="d-flex no-block align-items-center">
                        <h4 class="card-title" style="margin: 0px;">{{ trans('emergency::dashboard.pictures') }}</h4>
                        <div class="ml-auto">
                            @if($emergency->status == 1)
                                <button class="btn btn-sm btn-rounded btn-success" data-toggle="modal" data-target="#imgModal">{{ trans('emergency::dashboard.pictures-add') }}</button>
                                <!-- .modal for add pictures -->
                                <div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('emergency::dashboard.modal-img.title')</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" id="upload-img-form" enctype="multipart/form-data" action="{{ route('emergency.dashboard.upload.pic') }}">
                                                    @csrf
                                                    <input type="hidden" name="emergency" value="{{ $emergency->id }}">
                                                    <div class="form-group">
                                                        <label>{{ trans('emergency::dashboard.modal-img.form.name') }}</label>
                                                        <input name="name" type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="img-type" class="control-label"> 
                                                            {{ trans('emergency::dashboard.modal-img.form.type') }}
                                                        </label>
                                                        <select name="type" id="img-type" class="form-control">
                                                            <option value="">{{ trans('emergency::dashboard.modal-img.form.select-type') }}</option>
                                                            @foreach($types as $type)
                                                                <option @if(old('type')) selected @endif value="{{ $type->id }}">
                                                                    {{ trans('tasks-list.' . $type->slug) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{ trans('emergency::dashboard.modal-img.form.file') }}</label>
                                                        <br>
                                                        <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                                            <span><i class="ion-upload m-r-5"></i>@lang('emergency::dashboard.modal-img.form.upload')</span>
                                                            <input type="file" name="pic" class="upload" > 
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    @lang('emergency::dashboard.modal-img.form.cancel')
                                                </button>
                                                <button type="button" onclick="event.preventDefault();document.getElementById('upload-img-form').submit();" class="btn btn-success">
                                                    @lang('emergency::dashboard.modal-img.form.submit')
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    @forelse($pictures as $img)
                        @if($loop->first)
                            <div class="row el-element-overlay zoom-gallery">
                        @endif
                            <div class="col-4">
                                <div class="card bg-{{ $img->fileType->class }} proptDelete" style="border-radius: 0px;position: relative;">
                                    <a href="{{ asset($img->path) }}" data-source="{{ asset($img->path) }}" title="{{ $img->name }}" >
                                        <div class="el-card-item" style="padding: 0 0 0 6px;">
                                            <div class="el-card-avatar el-overlay-1" style="margin: 0"> 
                                                <img src="{{ asset($img->path) }}" alt="{{ $img->name }}" />
                                                <div class="el-overlay" style="display: table;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <form class="form-delete" method="POST" style="top: 5px;right: 5px;position: absolute;"
                                        action="{{ route('emergency.dashboard.delete.picture', $img->id) }}"> 
                                        @csrf
                                        @method('delete')
                                        <button name="delete-modal"  class="btn text-white btn-danger btn-sm btn-block"> <i class="fas fa-trash"></i> 
                                        </button>
                                    </form>
                                </div>
                                
                            </div>
                        @if($loop->last)
                            </div>
                        @endif
                    @empty
                        <div class="col-12 border text-center text-danger p-10" style="border-color: #f3f1f1!important;">
                            {{ trans('emergency::dashboard.pictures-empty') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @include('emergency::modals.delete')

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

        $('.proptDelete').on('click', '.form-delete', function(e){
            e.preventDefault();
            var $form=$(this);
            $('#confirm').modal({ backdrop: 'static', keyboard: false })
                .on('click', '#delete-btn', function(){
                    $form.submit();
                });
        });

        @if($emergency->status == 1)
            // ============================================================== 
            // To do list
            // ============================================================== 
            $(".list-task li label").click(function () {
                $(this).toggleClass("task-done");
            });
        @endif

        jQuery(document).ready(function(){
            jQuery.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    console.log('beforesend');
                    settings.data += "&_token=<?php echo csrf_token() ?>";
                }
            });
        });

        function setToggleTask(task) {
            jQuery.ajax({
                url: "{{ route('emergency.dashboard.task.toggle') }}",
                method: 'post',
                data: {
                    emergency: {{ $emergency->id }},
                    task: task,
                },
                success: function(result){
                    console.log(result);
                }
            });
        }
    </script>
    <!-- Magnific popup JavaScript -->
    <script src="{{ asset('modules/emergency/vendor/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('modules/emergency/vendor/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script>
@stop