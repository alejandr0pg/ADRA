<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('country::countries.add_country') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <form id="role-form" 
                    action="{{ route('countries.store') }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="country-name" class="control-label required"> {{trans('country::countries.modal.name') }}</label>
                        <input type="text" name="name" class="form-control" id="country-name" required>
                    </div>

                    <div class="form-group">
                        <label for="country-iso" class="control-label required"> {{trans('country::countries.form.iso') }}</label>
                        <input type="text" name="iso" class="form-control" id="country-iso" required>
                    </div>

                    <div class="form-group">
	                    <label class="control-label required">@lang('country::countries.form.currency')</label>  
	                    <select name="currency" class="form-control" required>
	                    	<option value="">@lang('country::countries.form.select_currencies')</option>
	                        @foreach( $currencies as $currency )
	                        <option value="{{ $currency->id }}">
	                            @lang("currencies-list.$currency->slug")
	                        </option>
	                        @endforeach
	                    </select>
                    </div>
                    <div class="form-group">
	                    <label class="control-label required">@lang('country::countries.form.lang')</label>  
	                    <select name="lang" class="form-control" required>
	                    	<option value="">@lang('country::countries.form.select_lang')</option>
	                        @foreach( $languajes as $lang )
	                        <option value="{{ $lang->id }}">
	                            @lang("languaje-list.$lang->slug")
	                        </option>
	                        @endforeach
	                    </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('country::countries.modal.close') }}</button>
                <button onclick="event.preventDefault();document.getElementById('role-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('country::countries.modal.save') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>