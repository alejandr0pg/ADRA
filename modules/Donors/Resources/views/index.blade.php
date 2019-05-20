@extends('layouts.app')

@section('title')
    {{ trans('donors::index.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-md-7 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('donors::index.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ trans('breadcrumb.admin') }}</li>
            </ol>
        </div>
        <div class="col-md-5 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <button data-toggle="modal" id="newRole" data-target=".bs-example-modal-sm" class="waves-effect waves-light btn-outline-success btn btn-rounded pull-right m-l-10">
                    	<i class="ti-plus"></i> {{ trans('donors::index.new-donor') }}
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
                    {{ trans('donors::index.alerts.' . session('action')) }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ trans('donors::index.donors-list') }}</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" data-form="deleteForm">
                            <thead>
                                <tr>
                                    <th>@lang('donors::index.table.id')</th>
                                    <th >@lang('donors::index.table.name')</th>
                                    <th >@lang('donors::index.table.origin')</th>
                                    <th >@lang('donors::index.table.contact_name')</th>
                                    <th >@lang('donors::index.table.contact_phone')</th>
                                    <th >@lang('donors::index.table.contact_email')</th>
                                    <th>@lang('donors::index.table.vigency')</th>
                                    <th>@lang('donors::index.table.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donors as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>@lang("donors-origins-list." . $data->origin->slug)</td>
                                    <td>{{ $data->contact_name }}</td>
                                    <td>{{ $data->contact_phone }}</td>
                                    <td>{{ $data->contact_email }}</td>
                                    <td>{{ $data->vigency ? trans('donors::index.vigente') : trans('donors::index.no-vigente') }}</td>
                                    <td class="text-nowrap">
                                        <a class="btn btn-primary" 
                                            href="{{ route('donors.modify', $data->id) }}" 
                                            data-toggle="tooltip" 
                                            data-original-title="@lang('donors::index.btn.update')">
                                            <i class="fas fa-pencil-alt text-white"></i>
                                        </a>
                                        
                                        <form  class="form-delete" method="POST" 
                                            style="display: inline-block;" 
                                            action="{{ route('donors.destroy', $data->id) }}"> 
                                            @csrf
                                            @method('delete')
                                            <button name="delete-modal" data-toggle="tooltip" data-original-title="@lang('donors::index.btn.delete')" class="btn text-white btn-danger"> <i class="fas fa-trash"></i> 
                                            </button>
                                        </form>  

                                        <div class="clearfix"></div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-danger">
                                        @lang('donors::index.table.empty')
                                    </td>
                                </tr>
                                @endforelse

                                {{ $donors->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sample modal content -->
    @include('donors::modals.new')
    @include('donors::modals.delete')
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