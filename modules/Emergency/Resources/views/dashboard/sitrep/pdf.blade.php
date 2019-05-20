<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
    <title>[{{ $emergency->code }}] {{ $emergency->name }}</title>

    <style>
		.page-break {
		    page-break-after: always;
		}
	</style>
  </head>
  <body>
    <div class="container-fluid">
    	<div class="row">
			<div class="col-sm-4 float-right">
				<img class="img-fluid" src="{{ asset('modules/emergency/logo_adra.png') }}" alt="">
			</div>
			<div class="col-sm-8">
				<h2>[{{ $emergency->code }}] {{ $emergency->name }}</h2>
				<p>
					<strong>{{ trans('emergency::dashboard.date-event') }}:</strong> {{ $format_date($emergency->event_date) }} <br>
					<strong>{{ trans('emergency::dashboard.task-date-start') }}:</strong> {{ $format_date($emergency->start_date) }}
				</p>
				<p><strong>{{ trans('emergency::dashboard.description') }}:</strong> {{ $emergency->description }}</p>
			</div>

			<div class="clearfix"></div>
    	</div>

    	<div class="row">
			<div class="col-sm-12">
				<h2>{{ trans('emergency::sitrep.first-step.title') }}</h2>
				<p>{{ $trans('sitrep-'. $emergency->id . '-details.title') }}</p>
				<img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $sitrep->latitud }},{{ $sitrep->longitud }}&autoscale=2&size=600x300&maptype=roadmap&key=AIzaSyDmGvH1jWo4aaO0CUYWPQT_2qx834hcSgg&format=png&visual_refresh=true&zoom=8"/>
			</div>
		</div>
		<br><br>
		<div class="col-12 border m-b-20 m-t-20"></div>          
		<br>
		
		<div class="col-12" style="margin-bottom: 20px">
            <div class="row" id="info-destacate">
                @foreach($sitrep->extra_info as $info)
                    <div class="col-3 border float-left">
                    	<br>
                        <div class="text-center p-10 m-t-20 m-b-20">
                            <h4><strong>{{ $info->value }}</strong></h4> <hr> 
                            {{ trans('sitrep-extra-info-' . $emergency->id . '-list.' . $info->slug) }}
                        </div>
                        <br>
                    </div>
                @endforeach
            </div>
			<div class="clearfix"></div>
        </div>
		
		<div class="clearfix"></div>
        <div class="page-break"></div>

        <div class="row">
        	<div class="col-sm-12">
        		<h2>{{ trans('emergency::sitrep.second-step.title') }}</h2><br>
        		<p>
        			<strong>{{ trans('emergency::sitrep.second-step.form.emergency-info') }}</strong><br>
        			{{ $trans('sitrep-'. $emergency->id . '-details.emergency-info') }}
        		</p>
        		<p>
        			<strong>{{ trans('emergency::sitrep.second-step.form.people-affected') }}</strong><br>
        			{{ $trans('sitrep-'. $emergency->id . '-details.people-affected') }}
        		</p>
        		<p>
        			<strong>{{ trans('emergency::sitrep.second-step.form.humanitarian-situation') }}</strong><br>
        			{{ $trans('sitrep-'. $emergency->id . '-details.humanitarian_situation') }}
        		</p>
        	</div>
        </div>

        <div class="page-break"></div>

        <div class="row">
        	<div class="col-sm-12">
        		<h2>{{ trans('emergency::sitrep.three-step.title') }}</h2><br>
        		<p>
        			<strong>{{ trans('emergency::sitrep.three-step.form.necessities-analysis') }}</strong><br>
        			{{ $trans('sitrep-'. $emergency->id . '-details.necessities_analysis') }}
        		</p>
        		<p>
        			<strong>{{ trans('emergency::sitrep.three-step.form.response-activities') }}</strong><br>
        			{{ $trans('sitrep-'. $emergency->id . '-details.response_activities') }}
        		</p>
        		<p>
        			<strong>{{ trans('emergency::sitrep.three-step.form.financing-opportunities') }}</strong><br>
        			{{ $trans('sitrep-'. $emergency->id . '-details.financing_opportunities') }}
        		</p>
        	</div>
        </div>

        <div class="page-break"></div>

        <div class="row">
        	<div class="col-sm-12">
        		<h2>{{ trans('emergency::sitrep.four-step.title') }}</h2><br>
        		<p>
        			<strong>{{ trans('emergency::sitrep.three-step.form.necessities-analysis') }}</strong><br>
        			{{ $trans('sitrep-'. $emergency->id . '-details.necessities_analysis') }}
        		</p>
        		<p>
        			<strong>{{ trans('emergency::sitrep.three-step.form.response-activities') }}</strong><br>
        			{{ $trans('sitrep-'. $emergency->id . '-details.response_activities') }}
        		</p>
        		<p>
        			<strong>{{ trans('emergency::sitrep.three-step.form.financing-opportunities') }}</strong><br>
        			{{ $trans('sitrep-'. $emergency->id . '-details.financing_opportunities') }}
        		</p>
        	</div>
        </div>

        <div class="page-break"></div>

        <div class="row">
        	<div class="col-sm-12">
        		<h2>{{ trans('emergency::sitrep.five-step.title') }}</h2><br>
        		<p>
        			<strong>{{ trans('emergency::sitrep.five-step.form.media') }}</strong><br>
        			{{ $trans('sitrep-'. $emergency->id . '-details.media') }}
        		</p>

        		<hr>

        		<div style="width: 94%;position: relative;margin-left:-15px">
        			@foreach($pictures as $img)
        			<div class="col-sm-6 float-left">
        				<img src="{{ asset($img->path) }}" alt="{{ $img->name }}" class="img-fluid img-thumbnail">
        			</div>
        			@if( $loop->iteration % 2 === 0)
        			<div class="clearfix"></div><br>
        			@endif
        			@endforeach
        			<div class="clearfix"></div>
        		</div>

        		<hr>

        		<p>
        			<strong>{{ trans('emergency::sitrep.five-step.form.quotes') }}</strong><br>
        			{{ $trans('sitrep-'. $emergency->id . '-details.quotes') }}
        		</p>
        		<p>
        			<strong>{{ trans('emergency::sitrep.five-step.form.circulate-sitrep') }}</strong><br>
        			{{ $trans('sitrep-'. $emergency->id . '-details.circulate_sitrep') }}
        		</p>
        	</div>
        </div>
		
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>