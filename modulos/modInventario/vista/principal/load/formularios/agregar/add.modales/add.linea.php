<?php include("../../../../../../../../lib/config/conect.php");?>
<div class="modal fade" id="mdlAddLinea" name="mdlAddLinea" tabindex="-1" role="dialog" aria-labelledby="mdlAddLinea" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="frmAddLinea" id="frmAddLinea">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Agregar Proveedor</h4>
                </div>
                <div class="modal-body">                
                    <div class="row">
                        <input type="hidden" name="mdl_add_lineaId" id="mdl_add_lineaId" value=""/>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Seleccione el Proveedor</label>
                                <select class="form-control" name="mdl_add_marcaId" id="mdl_add_marcaId">
                                    <option value="" selected disabled>-- Seleccione la marca --</option>
                                    <?php $selMarca=mysqli_query($con,"SELECT * FROM inv_marcas");
                                        while($datMarca=mysqli_fetch_assoc($selMarca)){?>
                                        <option value="<?php echo $datMarca["marcaId"]?>"><?php echo $datMarca["marca"];?></option>
                                    <?php } mysqli_free_result($selMarca);?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nombre de la Linea</label>
                                <input type="text" class="form-control" name="mdl_add_linea" id="mdl_add_linea">
                            </div>
                        </div>
                    </div>                            
                    
                    <small>*Campos Requisito</small>                  
                </div>                
                
                <div class="modal-footer">
                    <button type="button" id="guardarLinea" class="btn btn-primary">
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
        //Codigo para guardar los datos de la linea que se muestran en la modal
        $("#guardarLinea").click(function() {
            var mdl_add_marcaId = $("#mdl_add_marcaId option:selected").html();

            if (mdl_add_marcaId=="-- Seleccione la marca --"){
                sweetealerta('Error!','Debe seleccionar LA MARCA','error');
            } else if ($("#mdl_add_linea").val()==""){
                sweetealerta('Error!','Debe ingresar la LINEA','error');
            } else {
                var url = "../../modelo/insert?id=INS-LINEA-MDL";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#frmAddLinea").serialize(),
                    success: function(data){
                        if(data=='2'){
                            sweetealerta('¡ALERTA!','Ya existe una linea con los mismos datos.','warning');
                        }else{
                            refrescarSelectLineas(data,$("#mdl_add_linea").val());
                            //limpiarModal();
                            $('#mdlAddLinea').modal('toggle');
                            sweetealerta('¡ÉXITO!','Linea agregada con éxito','success');
                        }
                    }
                });
            }
        });
        
    });
</script>
