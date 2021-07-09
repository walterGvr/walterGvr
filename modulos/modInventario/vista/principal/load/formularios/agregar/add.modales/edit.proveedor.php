<div class="modal fade" id="mdlEditProveedor" name="mdlEditProveedor" tabindex="-1" role="dialog" aria-labelledby="mdlEditProveedor" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="frmEditProveedor" id="frmEditProveedor">
                
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Editar Proveedor</h4>
                </div>
                <div class="modal-body">                
                    <div class="row">
                        <input type="hidden" name="mdl_edit_proveedorId" id="mdl_edit_proveedorId">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo Proveedor</label>
                                <select class="form-control" name="mdl_edit_tipoProveedor" id="mdl_edit_tipoProveedor">
                                    <option value="0" selected disabled>-- Seleccione el tipo --</option>
                                    <option value="NACIONAL">NACIONAL</option>
                                    <option value="INTERNACIONAL">INTERNACIONAL</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nombres</label>
                                <input type="text" class="form-control" name="mdl_edit_nombre" id="mdl_edit_nombre">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="mdl_edit_email" id="mdl_edit_email">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefono</label>
                                <input type="text" class="form-control" name="mdl_edit_telefono" id="mdl_edit_telefono">
                            </div>

                            <div class="form-group">
                                <label>Sitio Web</label>
                                <input type="text" class="form-control" name="mdl_edit_sitioWeb" id="mdl_edit_sitioWeb">
                            </div>
                        </div>
                    </div>                            
                    
                    <small>*Campos Requisito</small>                  
                </div>                
                
                <div class="modal-footer">
                    <button type="button" id="editarProveedor" class="btn btn-primary">
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
