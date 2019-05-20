<div class="modal fade" id="treasuryInfoModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('agency::treasury-info.modal.title') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="role-form" 
                action="{{ route('agency.treasury-info.store', $agency->id) }}"
                method="POST">
                @csrf
                <div class="modal-body"> 
                    <div class="form-group">
                        <label for="agency-titular" class="control-label required"> {{trans('agency::treasury-info.modal.form.titular') }}</label>
                        <select name="receiver_id" id="agency-titular" required class="form-control">
                            <option value="">{{ trans('agency::treasury-info.modal.form.select-employee') }}</option>
                            @foreach($employees as $employee)
                                <option @if($input('receiver_id') == $employee->id ) selected @endif value="{{ $employee->id }}">
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="bank-name" class="control-label required"> {{ trans('agency::treasury-info.modal.form.bank-name-label') }}</label>
                        <input type="text" name="bank_name" required value="{{ $input('bank_name') }}" class="form-control" id="bank-name">
                    </div>

                    <div class="form-group">
                        <label for="bank-route" class="control-label required"> @lang('agency::treasury-info.modal.form.bank-route-label')</label>
                        <input type="text" name="bank_route" required value="{{ $input('bank_route') }}" class="form-control" id="bank-route">
                    </div>

                    <div class="form-group">
                        <label for="currency" class="control-label required">@lang('agency::treasury-info.modal.form.currency')</label>  
                        <select id="currency" name="currency_id" class="form-control" required>
                            <option value="">@lang('agency::treasury-info.modal.form.select_currencies')</option>
                            @foreach( $currencies as $currency )
                            <option @if($input('currency_id') == $currency->id ) selected @endif value="{{ $currency->id }}">
                                @lang("currencies-list.$currency->slug")
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="agency-counter" class="control-label required"> {{trans('agency::treasury-info.modal.form.counter') }}</label>
                        <select name="counter_id" id="agency-counter" class="form-control" required>
                            <option value="">{{ trans('agency::treasury-info.modal.form.select-counter') }}</option>
                            @foreach($employees as $employee)
                                <option @if($input('counter_id') == $employee->id) selected @endif value="{{ $employee->id }}">
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group m-b-0 p-b-0">
                        <label for="agency-iva" class="control-label"> @lang('agency::treasury-info.modal.form.ivan')</label>
                        <textarea id="agency-iva" name="ivan" class="form-control">{{ $input('ivan') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                        {{ trans('agency::treasury-info.modal.form.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">
                        {{ trans('agency::treasury-info.modal.form.submit') }}
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>