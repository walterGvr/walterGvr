<?php include("../../../../../../../../lib/config/conect.php");?>
<div class="modal fade" id="mdlAddMarca" name="mdlAddMarca" tabindex="-1" role="dialog" aria-labelledby="mdlAddMarca" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="frmAddMarca" id="frmAddMarca">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Agregar Proveedor</h4>
                </div>
                <div class="modal-body">                
                    <div class="row">
                        <input type="hidden" name="mdl_add_marcaId" id="mdl_add_marcaId" value=""/>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Seleccione el Proveedor</label>
                                <select class="form-control" name="mdl_add_proveedorId" id="mdl_add_proveedorId">
                                    <option value="" selected disabled>-- Seleccione el Proveedor --</option>
                                    <?php $selProveedor=mysqli_query($con,"SELECT * FROM inv_proveedores");
                                        while($datProveedor=mysqli_fetch_assoc($selProveedor)){?>
                                        <option value="<?php echo $datProveedor["proveedorId"]?>"><?php echo $datProveedor["nombre"]." | ".$datProveedor["tipoProveedor"]?></option>
                                    <?php } mysqli_free_result($selProveedor);?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nombre de la Marca</label>
                                <input type="text" class="form-control" name="mdl_add_marca" id="mdl_add_marca">
                            </div>
                        </div>
                    </div>                            
                    
                    <small>*Campos Requisito</small>                  
                </div>                
                
                <div class="modal-footer">
                    <button type="button" id="guardarMarca" class="btn btn-primary">
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
        
        //Codigo para guardar los datos de la marca que se muestran en la modal
        $("#guardarMarca").click(function() {
            var mdl_add_proveedorId = $("#mdl_add_proveedorId option:selected").html();

            if (mdl_add_proveedorId=="-- Seleccione el Proveedor --"){
                sweetealerta('Error!','Debe seleccionar EL PROVEEDOR','error');
            } else if ($("#mdl_add_marca").val()==""){
                sweetealerta('Error!','Debe ingresar la MARCA','error');
            } else {
                var url = "../../modelo/insert?id=INS-MARCA-MDL";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#frmAddMarca").serialize(),
                    success: function(data){
                        if(data=='2'){
                            sweetealerta('¡ALERTA!','Ya existe una marca con los mismos datos.','warning');
                        }else{
                            refrescarSelectMarcas(data,$("#mdl_add_marca").val());
                            //limpiarModal();
                            $("#add-modal-linea").load("load/formularios/agregar/add.modales/add.linea");
                            $('#mdlAddMarca').modal('toggle');
                            sweetealerta('¡ÉXITO!','Marca agregada con éxito','success');
                        }
                    }
                });
            }
        });        
    });

    //refrescar select de patrocinadores
    function refrescarSelectMarcas(id,nombre){       
        document.frmAddMarca.mdl_add_marcaId.value=id;

        let s=document.frmProductos.marc_marcaId; 
        let option=document.createElement("option"); 
        option.value=id; 
        option.text=nombre; 
        s.appendChild(option) // añadir nuevo registro a select

        $('#btnEditarMarca').css({display:'block'});
        $('#btnAgregarMarca').css({display:'none'});

        $("#marcaId option[value="+ id +"]").attr("selected",true);

        
        $.ajax({
            type: "POST",
            data: $("#frmAddMarca").serialize(),
            url: "../../controlador/prod.marcas/java.selMarca.php",    
            success: function (data){
                let datos = data.split("¬");
                document.frmProductos.marc_marcaId.value=datos[0];
                document.frmProductos.marc_proveedorId.value=datos[1];
                document.frmProductos.marc_marca.value=datos[2];
            }
        });
    }
</script>
