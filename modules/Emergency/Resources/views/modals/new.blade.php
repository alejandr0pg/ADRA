<div class="modal fade" id="emergencyModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('emergency::emergencies.modal.title') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <form id="role-form" 
                    action="{{ route('emergency.store') }}"
                    method="POST">
                    @csrf
                
                    <div class="form-group">
                        <label for="emergency-code" class="control-label required"> {{trans('emergency::emergencies.modal.form.code') }}</label>
                        <input type="text" name="code" value="{{ old('code') }}" class="form-control" id="emergency-code" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="emergency-belong-to" class="control-label required"> {{trans('emergency::emergencies.modal.form.belong-to') }}</label>
                        <select name="belong_to" id="emergency-belong-to" class="form-control" style="width: 100%" required>
                            <option value="">{{ trans('emergency::emergencies.modal.form.select-agency') }}</option>
                            @foreach($agencies as $item)
                                <optgroup label="{{ $item->name }}">
                                    @foreach($item->childrens as $data)
                                    <option value="{{ $data->id }}" @if(old('belong_to') == $data->id) selected @elseif(isset($agency_selected) && $agency_selected->id == $data->id) selected @endif>{{ $data->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="emergency-name" class="control-label required"> {{trans('emergency::emergencies.modal.form.name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="emergency-name" required>
                    </div>
                
                    <div class="form-group">
                        <label for="emergency-description" class="control-label required"> {{trans('emergency::emergencies.modal.form.description') }}</label>
                        <textarea name="description" id="emergency-description" class="form-control" required>{{ old('description') }}</textarea>
                    </div>
                
                    <div class="form-group">
                        <label for="emergency-type" class="control-label required"> {{trans('emergency::emergencies.modal.form.type') }}</label>
                        <select name="type" id="emergency-type" class="form-control" required>
                            <option value="">{{ trans('emergency::emergencies.modal.form.select-type') }}</option>
                            @foreach($types as $type)
                                <option @if(old('type')) selected @endif value="{{ $type->id }}">
                                    @lang("event_types-list." . $type->slug)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="emergency-contribution" class="control-label required"> {{trans('emergency::emergencies.modal.form.contribution') }}</label>
                        <select name="contribution" id="emergency-contribution" class="form-control" required>
                            <option value="">{{ trans('emergency::emergencies.modal.form.select-contribution') }}</option>
                            @foreach($contributions as $contribution)
                                <option value="{{ $contribution->id }}">
                                    @lang("contributions-list." . $contribution->slug)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="emergency-currency" class="control-label required"> {{trans('emergency::emergencies.modal.form.currency') }}</label>
                        <select name="currency" id="emergency-currency" class="form-control" required>
                            <option value="">{{ trans('emergency::emergencies.modal.form.select-currency') }}</option>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}">
                                    @lang("currencies-list." . $currency->slug)
                                </option>
                            @endforeach
                        </select>
                    </div>
               
                    
                    <div class="form-group">
                        <label for="emergency-cordinator" class="control-label required"> {{trans('emergency::emergencies.modal.form.cordinator') }}</label>
                        <select name="cordinator" id="emergency-cordinator" class="form-control" required>
                            <option value="">{{ trans('emergency::emergencies.modal.form.select-cordinator') }}</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6"> 
                            <div class="form-group">
                                <label for="event-date" class="control-label required"> {{ trans('emergency::emergencies.modal.form.event_date') }}</label>
                                <input type="date" name="event_date" value="{{ old('event_date') }}" class="form-control" id="event-date" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="start-date" class="control-label required"> {{ trans('emergency::emergencies.modal.form.start_date') }}</label>
                                <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control" id="start-date" required>
                            </div> 
                        </div>
                    </div>
                    
                    <div class="form-group m-b-0">
                        <label for="emergency-vigency" class="control-label required"> {{trans('emergency::emergencies.modal.form.vigency') }}</label>
                        <div class="switch">
                            <label>
                                @lang('emergency::emergencies.modal.form.check.off')
                                <input type="checkbox" name="vigency" value="1" checked><span class="lever"></span>
                                @lang('emergency::emergencies.modal.form.check.on')
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('emergency::emergencies.modal.form.cancel') }}</button>
                <button onclick="event.preventDefault();document.getElementById('role-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('emergency::emergencies.modal.form.submit') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>