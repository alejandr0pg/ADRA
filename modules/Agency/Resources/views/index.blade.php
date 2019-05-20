@extends('layouts.app')

@section('title')
    {{ trans('agency::agency.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-md-7 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('agency::agency.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ trans('breadcrumb.admin') }}</li>

            </ol>
        </div>
        <div class="col-md-5 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <button data-toggle="modal" data-target=".bs-example-modal-sm" class=" waves-effect waves-light btn-outline-success btn btn-rounded  pull-right m-l-10"><i class="ti-plus"></i> {{ trans('agency::agency.add_new') }}</button>
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
                    {{ trans('agency::agency.alerts.' . session('action')) }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ trans('agency::agency.agencies-list') }}</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" data-form="deleteForm">
                            <thead>
                                <tr>
                                    <th width="15%">@lang('agency::agency.table.id')</th>
                                    <th width="30%">@lang('agency::agency.table.name')</th>
                                    <th width="15%">@lang('agency::agency.table.country')</th>
                                    <th width="30%">@lang('agency::agency.table.agency_director')</th>
                                    <th width="30%">@lang('agency::agency.table.vigency')</th>
                                    <th width="25%" class="text-nowrap">@lang('agency::agency.table.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agencies as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            @if($data->country) 
                                                @lang("countries-list." . $data->country->slug)
                                            @else
                                            @lang('agency::agency.not-established')
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->director)
                                                <a href="{{ route('admin.user-details', $data->director->id) }}">{{ $data->director->name }}</a></td>
                                            @else
                                                @lang('agency::agency.not-established')
                                            @endif
                                        <td>
                                            {{ $data->vigency ? trans('agency::agency.vigente') : trans('agency::agency.no-vigente') }}
                                        </td>
                                        <td class="text-nowrap text-right">
                                            @if( $data->belong_to > 0 )
                                                <a class="btn btn-warning" 
                                                    href="{{ url("admin/emergencies/?agency=$data->id") }}" 
                                                    data-toggle="tooltip" 
                                                    data-original-title="{{ trans('agency::agency.table.emergencies') }}">
                                                    <i class="mdi mdi-alert text-white"></i>
                                                </a>
                                            @endif

                                            <a class="btn btn-info" 
                                                href="{{ route('agency.treasury-info.index', $data->id) }}" 
                                                data-toggle="tooltip" 
                                                data-original-title="{{ trans('agency::agency.table.bank_information') }}">
                                                <i class="mdi mdi-bank text-white"></i>
                                            </a>

                                            <a class="btn btn-primary" 
                                                href="{{ route('agency.modify', $data->id) }}" 
                                                data-toggle="tooltip" 
                                                data-original-title="{{ trans('agency::agency.table.update') }}">
                                                <i class="fas fa-pencil-alt text-white"></i>
                                            </a>
                                            
                                            <form class="form-delete" method="POST" 
                                                style="display: inline-block;" 
                                                action="{{ route('agency.destroy', $data->id) }}"> 
                                                @csrf
                                                @method('delete')
                                                <button name="delete-modal" data-toggle="tooltip" data-original-title="@lang('agency::agency.table.delete')" class="btn text-white btn-danger"> <i class="fas fa-trash"></i> 
                                                </button>
                                            </form> 
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">
                                            @lang('agency::agency.table.empty')
                                        </td>
                                    </tr>
                                @endforelse

                                {{ $agencies->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        </div>
    </div>

    <!-- sample modal content -->
    @include('agency::modals.new')
    @include('agency::modals.delete')
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
