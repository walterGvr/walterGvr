<?php include("../../../../../../../lib/config/conect.php");?>
<div class="modal fade" id="mdlEditMarca" name="mdlEditMarca" tabindex="-1" role="dialog" aria-labelledby="mdlEditMarca" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="frmEditMarca" id="frmEditMarca">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Agregar Proveedor</h4>
                </div>
                <div class="modal-body">                
                    <div class="row">
                        <input type="hidden" name="mdl_edit_marcaId" id="mdl_edit_marcaId" value=""/>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Seleccione el Proveedor</label>
                                <select class="form-control" name="mdl_edit_proveedorId" id="mdl_edit_proveedorId">
                                    <option value="" selected disabled>-- Seleccione el Proveedor --</option>
                                    <?php $selProveedor=mysqli_query($con,"SELECT * FROM inv_proveedores");
                                        while($datProveedor=mysqli_fetch_assoc($selProveedor)){?>
                                        <option value="<?php echo $datProveedor["proveedorId"]?>"><?php echo $datProveedor["nombre"]." | ".$datProveedor["tipoProveedor"]?></option>
                                    <?php } mysqli_free_result($selProveedor);?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nombre de la Marca</label>
                                <input type="text" class="form-control" name="mdl_edit_marca" id="mdl_edit_marca">
                            </div>
                        </div>
                    </div>                            
                    
                    <small>*Campos Requisito</small>                  
                </div>                
                
                <div class="modal-footer">
                    <button type="button" id="editarMarca" class="btn btn-primary">
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
<script>
    $(document).ready(function(){
        //Codigo para editar los datos del proveedor que se muestran en la modal
        $("#editarMarca").click(function() {
            let mdl_edit_marcaId = document.getElementById("mdl_edit_marcaId").value;
            
            $.ajax({
                type: "POST",                                    
                data: $("#frmEditMarca").serialize(),
                url: "../../modelo/update?id=UPD-MARCA-MDL",
                success: function(data){
                    $('#marcaId option[value="'+mdl_edit_marcaId+'"]').remove(); 
                    refrescarSelectMarcas(data,$("#mdl_edit_marca").val());
                    //limpiarModal();
                    $('#mdlEditMarca').modal('toggle');
                    sweetealerta('¡ÉXITO!','Marca modificada con éxito','success');
                }
            });
        });
    })
</script>
