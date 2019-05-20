<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('emergency::event-type.modal.title') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <form id="event-type-new" 
                    action="{{ route('events-types.store') }}"
                    method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="emergency-event-name" class="control-label required"> {{trans('emergency::event-type.modal.form.name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="form-control" id="emergency-event-name">
                    </div>
                
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('emergency::event-type.modal.form.cancel') }}</button>
                <button onclick="event.preventDefault();document.getElementById('event-type-new').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('emergency::event-type.modal.form.submit') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>