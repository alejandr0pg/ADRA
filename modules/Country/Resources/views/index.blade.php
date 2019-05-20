@extends('layouts.app')

@section('title')
	{{ trans('country::countries.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-md-7 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('country::countries.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('breadcrumb.config') }}</li>
            </ol>
        </div>
        <div class="col-md-5 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <button data-toggle="modal" id="newRole" data-target=".bs-example-modal-sm" class=" waves-effect waves-light btn-success btn  pull-right m-l-10"><i class="ti-plus text-white"></i> {{ trans('country::countries.add_country') }}</button>
                </div>
                
            </div>
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
            @if(session('action'))
                <div class="alert alert-success">
                    {{ trans('currency::currencies.alerts.' . session('action')) }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{trans('country::countries.added_countries')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" data-form="deleteForm">
                            <thead>
                                <tr>
                                    <th width="15%">@lang('country::countries.table.id')</th>
                                    <th width="60%">@lang('country::countries.table.name')</th>
                                    <th width="60%">@lang('country::countries.table.iso')</th>
                                    <th width="60%">@lang('country::countries.table.currency')</th>
                                    <th width="60%">@lang('country::countries.table.lang')</th>
                                    <th width="25%" class="text-nowrap">@lang('country::countries.table.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($countries as $country)
                                    <tr>
                                        <td>{{$country->id}}</td>
                                        <td>@lang("countries-list." . $country->slug)</td>
                                        <td>{{ $country->iso }}</td>
                                        <td>
                                            @if($country->currency)
                                                @lang("currencies-list." . $country->currency->slug)
                                            @else
                                                @lang('country::countries.not-established')
                                            @endif
                                        </td>
                                        <td>
                                            @if($country->lang)
                                                @lang("languaje-list." . $country->lang->slug)
                                            @else
                                                @lang('country::countries.not-established')
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            <a class="btn btn-warning" 
                                                href="{{ route('countries.modify', $country->id) }}" 
                                                data-toggle="tooltip" 
                                                data-original-title="Edit">
                                                <i class="fas fa-pencil-alt text-white"></i>
                                            </a>
                                            
                                            <form  class="form-delete" method="POST" 
                                                style="display: inline-block;" 
                                                action="{{ route('countries.destroy', $country->id) }}"> 
                                                @method('delete')
                                                @csrf
                                                <button name="delete-modal" data-toggle="tooltip" data-original-title="Delete" class="btn text-white btn-danger"> <i class="fas fa-trash"></i> 
                                                </button>
                                            </form>  
                                            
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">
                                            @lang('country::countries.table.empty')
                                        </td>
                                    </tr>
                                @endforelse

                                {{ $countries->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- sample modal content -->
    @include('country::modals.new')
    @include('country::modals.delete')
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