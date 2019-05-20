<div class="modal fade modal-document" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('coreplanification::register.add_document') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <form id="document-form" enctype="multipart/form-data"
                    action="{{ route('indicador_document.store') }}"
                    method="POST" >
                    <input id="indicador_document_id" type="hidden" name="indicador_id" value="1">
                    @csrf
                    <div class="form-group">
                        <label for="currency-name" class="control-label"> {{trans('coreplanification::register.form.descripcion') }}</label>
                        <textarea  name="description" value="{{ old('description') }}" class="form-control" id="register-description"></textarea>
                       
                    </div>
                    <div class="form-group">
                        <label for="register-created_date" class="control-label"> {{trans('coreplanification::register.form.document') }}</label>
                        <input type="file" name="document" value="{{ old('document') }}" class="form-control" id="register-document">
                    </div>
                  
                   
                    
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('coreplanification::register.form.cancel') }}</button>
                <button onclick="event.preventDefault();document.getElementById('document-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('coreplanification::register.form.save') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
