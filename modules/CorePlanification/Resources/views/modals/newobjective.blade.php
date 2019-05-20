<div class="modal fade modal-objetivo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('coreplanification::register.add_objetivo') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <form id="objetivo-form" 
                    action="{{ route('objetivo_register.store') }}"
                    method="POST">
                    <input id="linea_id" type="hidden" name="linea_id" value="1">
                    @csrf
                    <div class="form-group">
                        <label for="currency-name" class="control-label"> {{trans('coreplanification::register.form.descripcion') }}</label>
                        <textarea  name="description" value="{{ old('description') }}" class="form-control" id="register-description"></textarea>
                       
                    </div>
                    <div class="form-group">
                        <label for="register-created_date" class="control-label"> {{trans('coreplanification::register.form.created_date') }}</label>
                        <input type="date" name="fecha_creacion" value="{{ old('fecha_creacion') }}" class="form-control" id="register-created_date">
                    </div>
                  
                   
                    <div class="form-group">
                  
                      <div class="col-sm-3">
                                        <div class="demo-switch-title">{{trans('coreplanification::register.form.vigencia') }}</div>
                                        <div class="switch">
                                            <label>
                                                <input name="vigencia" type="checkbox" ><span class="lever switch-col-teal"></span></label>
                                        </div>
                                    </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('coreplanification::register.form.cancel') }}</button>
                <button onclick="event.preventDefault();document.getElementById('objetivo-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('coreplanification::register.form.save') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
