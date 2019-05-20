<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('donors::modal-new.title') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <form id="role-form" 
                    action="{{ route('donors.store') }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="donors-origin" class="control-label"> {{trans('donors::modal-new.form.origin') }}</label>
                        <select name="origin" id="donors-origin" class="form-control">
                        	<option value="">@lang('donors::modal-new.form.select-origin')</option>
                        	@foreach($origins as $origin)
                        		<option value="{{ $origin->id }}"
                        			@if(old('origin') === $origin->id) selected @endif>{{ trans("donors-origins-list.$origin->slug") }}</option>
                        	@endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="donors-name" class="control-label required"> {{trans('donors::modal-new.form.name') }}</label>
                        <input type="text" name="name" required value="{{ old('name') }}" class="form-control" id="donors-name">
                    </div>
                    <div class="form-group">
                        <label for="donors-contact_name" class="control-label required"> {{trans('donors::modal-new.form.contact_name') }}</label>
                        <input type="text" name="contact_name" required value="{{ old('contact_name') }}" class="form-control" id="donors-contact_name">
                    </div>
                    <div class="form-group">
                        <label for="donors-contact_email" class="control-label required"> {{trans('donors::modal-new.form.contact_email') }}</label>
                        <input type="text" name="contact_email" required value="{{ old('contact_email') }}" class="form-control" id="donors-contact_email">
                    </div>
                    <div class="form-group">
                        <label for="donors-contact_phone" class="control-label required"> {{trans('donors::modal-new.form.contact_phone') }}</label>
                        <input type="text" name="contact_phone" required value="{{ old('contact_phone') }}" class="form-control" id="donors-contact_phone">
                    </div>
                    <div class="form-group m-b-0">
                        <label for="donors-vigency" class="control-label required"> {{trans('donors::modal-new.form.vigency') }}</label>
                        <div class="switch">
                            <label>
                                @lang('donors::modal-new.form.check.off')
                                <input type="checkbox" name="vigency" value="1" checked><span class="lever"></span>
                                @lang('donors::modal-new.form.check.on')
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('donors::modal-new.form.cancel') }}</button>
                <button onclick="event.preventDefault();document.getElementById('role-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('donors::modal-new.form.submit') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>