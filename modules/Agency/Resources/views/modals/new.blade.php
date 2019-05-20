<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('agency::agency.modal.title') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <form id="role-form" 
                    action="{{ route('agency.store') }}"
                    method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group ">
                                <label for="agency-name" class="control-label required"> {{trans('agency::agency.modal.form.name') }}</label>
                                <input type="text" name="name" required value="{{ old('name') }}" class="form-control" id="agency-name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="agency-country" class="control-label required"> {{trans('agency::agency.modal.form.country') }}</label>
                                <select name="country" id="agency-country" class="form-control" required>
                                    <option value="">{{ trans('agency::agency.modal.form.select-country') }}</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">
                                            @lang("countries-list.$country->slug")
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="agency-director" class="control-label required" > {{trans('agency::agency.modal.form.director') }}</label>
                        <select name="director" id="agency-director" class="form-control" required>
                            <option value="">{{ trans('agency::agency.modal.form.select-employee') }}</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="agency-mission" class="control-label required"> {{trans('agency::agency.modal.form.mission') }}</label>
                        <textarea name="mission" id="agency-mission" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="agency-vision" class="control-label required"> {{trans('agency::agency.modal.form.vision') }}</label>
                        <textarea name="vision" id="agency-vision" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="agency-belong-to" class="control-label"> {{trans('agency::agency.modal.form.belong-to') }}</label>
                        <select name="belong_to" id="agency-belong-to" class="form-control">
                            <option value="">{{ trans('agency::agency.modal.form.select-agency') }}</option>
                            @foreach($agencies_selects as $agency)
                                <option value="{{ $agency->id }}">
                                    {{ $agency->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group m-b-0">
                        <label for="agency-vigency" class="control-label required"> {{trans('agency::agency.modal.form.vigency') }}</label>
                        <div class="switch">
                            <label>
                                @lang('agency::agency.modal.form.check.off')
                                <input type="checkbox" name="vigency" value="1" checked><span class="lever"></span>
                                @lang('agency::agency.modal.form.check.on')
                            </label>
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('agency::agency.modal.form.cancel') }}</button>
                <button onclick="event.preventDefault();document.getElementById('role-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('agency::agency.modal.form.submit') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>