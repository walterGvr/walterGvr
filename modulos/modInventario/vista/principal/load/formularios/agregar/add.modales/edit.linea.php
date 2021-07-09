<?php include("../../../../../../../lib/config/conect.php");?>
<div class="modal fade" id="mdlEditLinea" name="mdlEditLinea" tabindex="-1" role="dialog" aria-labelledby="mdlEditLinea" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="frmEditLinea" id="frmEditLinea">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Agregar Proveedor</h4>
                </div>
                <div class="modal-body">                
                    <div class="row">
                        <input type="hidden" name="mdl_edit_lineaId" id="mdl_edit_lineaId" value=""/>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Seleccione el Proveedor</label>
                                <select class="form-control" name="mdl_edit_marcaId" id="mdl_edit_marcaId">
                                    <option value="" selected disabled>-- Seleccione la marca --</option>
                                    <?php $selMarca=mysqli_query($con,"SELECT * FROM inv_marcas");
                                        while($datMarca=mysqli_fetch_assoc($selMarca)){?>
                                        <option value="<?php echo $datMarca["marcaId"]?>"><?php echo $datMarca["marca"];?></option>
                                    <?php } mysqli_free_result($selMarca);?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nombre de la Linea</label>
                                <input type="text" class="form-control" name="mdl_edit_linea" id="mdl_edit_linea">
                            </div>
                        </div>
                    </div>                            
                    
                    <small>*Campos Requisito</small>                  
                </div>                
                
                <div class="modal-footer">
                    <button type="button" id="editarLinea" class="btn btn-primary">
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
        $("#editarLinea").click(function() {
            let mdl_edit_lineaId = document.getElementById("mdl_edit_lineaId").value;
            
            $.ajax({
                type: "POST",                                    
                data: $("#frmEditLinea").serialize(),
                url: "../../modelo/update?id=UPD-LINEA-MDL",
                success: function(data){
                    $('#lineaId option[value="'+mdl_edit_lineaId+'"]').remove(); 
                    refrescarSelectLineas(data,$("#mdl_edit_linea").val());
                    //limpiarModal();
                    $('#mdlEditLinea').modal('toggle');
                    sweetealerta('¡ÉXITO!','Linea modificada con éxito','success');
                }
            });
        });
    })
</script>
