<div class="modal fade" id="mdlAddProveedor" name="mdlAddProveedor" tabindex="-1" role="dialog" aria-labelledby="mdlAddProveedor" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="frmAddProveedor" id="frmAddProveedor">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Agregar Proveedor</h4>
                </div>
                <div class="modal-body">                
                    <div class="row">
                        <input type="hidden" name="mdl_add_proveedorId" id="mdl_add_proveedorId">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo Proveedor (*)</label>
                                <select class="form-control" name="mdl_add_tipoProveedor" id="mdl_add_tipoProveedor">
                                    <option value="" selected disabled>-- Seleccione el tipo --</option>
                                    <option value="NACIONAL">NACIONAL</option>
                                    <option value="INTERNACIONAL">INTERNACIONAL</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nombres (*)</label>
                                <input type="text" class="form-control" name="mdl_add_nombre" id="mdl_add_nombre">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="mdl_add_email" id="mdl_add_email">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefono</label>
                                <input type="text" class="form-control" name="mdl_add_telefono" id="mdl_add_telefono">
                            </div>

                            <div class="form-group">
                                <label>Sitio Web</label>
                                <input type="text" class="form-control" name="mdl_add_sitioWeb" id="mdl_add_sitioWeb">
                            </div>
                        </div>
                    </div>                            
                    
                    <small>*Campos Requisito</small>                  
                </div>                
                
                <div class="modal-footer">
                    <button type="button" id="guardarProveedor" class="btn btn-primary">
                        <i class="fa fa-save"></i> Guardar Datos
                    </button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-close"></i> Cerrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
