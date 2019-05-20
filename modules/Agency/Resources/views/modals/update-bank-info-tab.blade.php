<div class="modal fade" id="bankInfoTabModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('agency::tab-bank-info.modal.title') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="role-form" 
                action="{{ route('agency.bank-info.tab.store') }}"
                method="POST">
                <div class="modal-body"> 
                    @csrf
                    <div class="form-group">
                        <label for="agency-name" class="control-label required" > {{ trans('agency::tab-bank-info.name-bank-label') }}</label>
                        <input type="text" name="bank_name" required value="{{ $input('bank_name') }}" class="form-control" id="agency-name">
                    </div>

                    <div class="form-group">
                        <label for="agency-name" class="control-label required"> @lang('agency::tab-bank-info.route-bank-label')</label>
                        <input type="text" name="account_route" required value="{{ $input('account_route') }}" class="form-control" id="agency-name">
                    </div>

                    <div class="form-group">
                        <label for="agency-name" class="control-label required"> @lang('agency::tab-bank-info.account-number-label')</label>
                        <input type="text" name="account_number" required value="{{ $input('account_number') }}" class="form-control" id="agency-name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                        {{ trans('agency::tab-bank-info.modal.form.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">
                        {{ trans('agency::tab-bank-info.modal.form.submit') }}
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>