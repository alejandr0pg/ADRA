@extends('layouts.app')

@section('title')
    [{{ $emergency->code }}] {{ $emergency->name }}
@stop

@section('styles')
    <!-- Popup CSS -->
    <link href="{{ asset('modules/emergency/vendor/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('modules/emergency/vendor/wizard/steps.css') }}" rel="stylesheet" type="text/css">
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
            <div class="card ">
                <div class="card-body">
                    <h3>
                        <strong><i class="flag-icon flag-icon-{{ $emergency->country->iso }}"></i> [{{ $emergency->code }}] {{ $emergency->name }}</strong>
                        <div class="float-right" style="margin-top: -4px;">
                            <a href="{{ route('emergency.dashboard', $emergency->id) }}" 
                                class="waves-effect waves-light btn-outline-dark btn btn-rounded pull-right m-l-10">
                                <i class="icon-arrow-left-circle"></i> {{ trans('emergency::sitrep.back-btn') }}
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
        
        <!-- vertical wizard -->
        
        <div class="col-12">
            <div class="card">
                <div class="card-body wizard-content ">
                    <h4 class="card-title">{{ trans('emergency::sitrep.title') }}</h4>
                    <h6 class="card-subtitle">{{ trans('emergency::sitrep.subtitle') }}</h6>
                    <form id="wizard" method="post" action="{{ route('emergency.dashboard.sitrep.store', $emergency->id) }}" class="tab-wizard vertical wizard-circle">
                        @csrf
                        <!-- Step 1 -->
                        <h6>{{ trans('emergency::sitrep.first-step.title') }}</h6>
                        <section>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">{{ trans('emergency::sitrep.first-step.form.title') }} :</label>
                                        <input type="text" name="title" value="{{ $trans('sitrep-'. $emergency->id . '-details.title') }}" class="form-control" id="title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="latitud">{{ trans('emergency::sitrep.first-step.form.latitud') }} :</label>
                                        <input type="text" name="latitud" value="{{ $sitrep->latitud }}" class="form-control" id="latitud"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="longitud">{{ trans('emergency::sitrep.first-step.form.longitud') }} :</label>
                                        <input type="text" name="longitud" value="{{ $sitrep->longitud }}" class="form-control" id="longitud"> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 border m-b-20"></div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="point-destacate">{{ trans('emergency::sitrep.first-step.form.point-destacate') }} :</label>
                                        <input type="text" class="form-control" id="point-destacate"> </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="valor">{{ trans('emergency::sitrep.first-step.form.value-destacate') }} :</label>
                                        <input type="number" min="0" class="form-control" id="valor"> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div style="height: 31px"></div>
                                        <button type="button" onclick="addExtraInfo();" class="btn btn-primary btn-block">{{ trans('emergency::sitrep.first-step.form.submit-destacate') }}</button> </div>
                                </div>
                            </div>

                            <div class="col-12 border m-b-20"></div>
                            
                            <div class="col-12" style="margin-bottom: 20px">
                                <div class="row" id="info-destacate">
                                    @foreach($sitrep->extra_info as $info)
                                        <div class="col-3 border p-t-10 p-b-10" id="extra-info-{{ $info->id }}">
                                            <div class="d-inline float-right">
                                                <button type="button" onclick="deleteExtraInfo({{ $info->id }})" class="btn text-white btn-danger btn-sm"><i class="ti-trash"></i></button>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="text-center p-10">
                                                <h2><strong>{{ $info->value }}</strong></h2> <hr> 
                                                {{ trans('sitrep-extra-info-' . $emergency->id . '-list.' . $info->slug) }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                        </section>
                        <!-- Step 2 -->
                        <h6>{{ trans('emergency::sitrep.second-step.title') }}</h6>
                        <section>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="emergency-info">{{ trans('emergency::sitrep.second-step.form.emergency-info') }} :</label>
                                        <textarea name="emergency_info" id="emergency-info" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.emergency-info') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="people-affected">{{ trans('emergency::sitrep.second-step.form.people-affected') }} :</label>
                                        <textarea name="people_affected" id="people-affected" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.people-affected') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="humanitarian_situation">{{ trans('emergency::sitrep.second-step.form.humanitarian-situation') }} :</label>
                                        <textarea name="humanitarian_situation" id="humanitarian_situation" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.humanitarian_situation') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <h6>{{ trans('emergency::sitrep.three-step.title') }}</h6>
                        <section>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="necessities-analysis">{{ trans('emergency::sitrep.three-step.form.necessities-analysis') }} :</label>
                                        <textarea name="necessities_analysis" id="necessities-analysis" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.necessities_analysis') }}</textarea>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="response-activities">{{ trans('emergency::sitrep.three-step.form.response-activities') }} :</label>
                                        <textarea name="response_activities" id="response-activities" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.response_activities') }}</textarea>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="financing-opportunities">{{ trans('emergency::sitrep.three-step.form.financing-opportunities') }} :</label>
                                        <textarea name="financing_opportunities" id="financing-opportunities" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.financing_opportunities') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 4 -->
                        <h6>{{ trans('emergency::sitrep.four-step.title') }}</h6>
                        <section>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="gaps">{{ trans('emergency::sitrep.four-step.form.gaps') }} :</label>
                                        <textarea name="gaps" id="gaps" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="security_difficulties">{{ trans('emergency::sitrep.four-step.form.security-difficulties') }} :</label>
                                        <textarea name="security_difficulties" id="security_difficulties" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.security_difficulties') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="cluster-meetings">{{ trans('emergency::sitrep.four-step.form.other-difficulties') }} :</label>
                                        <textarea name="other_difficulties" id="other-difficulties" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.other_difficulties') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="cluster-meetings">{{ trans('emergency::sitrep.four-step.form.cluster-meetings') }} :</label>
                                        <textarea name="cluster_meetings" id="cluster-meetings" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.cluster_meetings') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="coordination-organizations">{{ trans('emergency::sitrep.four-step.form.coordination-organizations') }} :</label>
                                        <textarea name="coordination_organizations" id="coordination-organizations" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.coordination_organizations') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                         <!-- Step 5 -->
                        <h6>{{ trans('emergency::sitrep.five-step.title') }}</h6>
                        <section>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="media">{{ trans('emergency::sitrep.five-step.form.media') }} :</label>
                                        <textarea name="media" id="media" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.media') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="quotes">{{ trans('emergency::sitrep.five-step.form.quotes') }} :</label>
                                        <textarea name="quotes" id="quotes" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.quotes') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="circulate-sitrep">{{ trans('emergency::sitrep.five-step.form.circulate-sitrep') }} :</label>
                                        <textarea name="circulate_sitrep" id="circulate-sitrep" class="form-control">{{ $trans('sitrep-'. $emergency->id . '-details.circulate_sitrep') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('emergency::modals.delete')
@stop

@section('scripts')
    <!-- Magnific popup JavaScript -->
    <script src="{{ asset('modules/emergency/vendor/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('modules/emergency/vendor/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script>
    <script src="{{ asset('modules/emergency/vendor/moment/moment.js') }}"></script>
    <script src="{{ asset('modules/emergency/vendor/wizard/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('modules/emergency/vendor/wizard/jquery.validate.min.js') }}"></script>
    <script>
        $(".tab-wizard").steps({
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Submit"
            },
            onFinished: function (event, currentIndex) {
                console.log(event);
                document.getElementById('wizard').submit();
            }
        });

        jQuery(document).ready(function(){
            jQuery.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    console.log('beforesend');
                    settings.data += "&_token=<?php echo csrf_token() ?>";
                }
            });
        });

        function addExtraInfo() {
            jQuery.ajax({
                url: "{{ route('emergency.dashboard.sitrep.add-info', $emergency->id) }}",
                method: 'post',
                data: {
                    description: $('#point-destacate').val(),
                    value: $('#valor').val(),
                },
                success: function(data){
                    console.log(data);

                    if(data.error == false) {
                        $('#info-destacate').append(data.view);
                    }
                }
            });
        }

        function deleteExtraInfo(info) {
        	var response = confirm("@lang('emergency::sitrep.confirm-delete')");

			if (response == true) {
	            jQuery.ajax({
	                url: "{{ route('emergency.dashboard.sitrep.delete-info', [$emergency->id, $sitrep->id]) }}",
	                method: 'delete',
	                data: {
	                	'extra_info': info
	                },
	                success: function(data){
	                    console.log(data);

	                    if(data.error == false) {
	                        $('#extra-info-' + info).remove();
	                    }
	                }
	            });
	        }
        }
    </script>
@stop