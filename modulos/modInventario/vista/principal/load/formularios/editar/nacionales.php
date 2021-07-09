                    <?php
                        include("../../../../../../../lib/config/conect.php");
                        $selCompra=mysqli_query($con,"SELECT * FROM inv_compra WHERE compraId='$_REQUEST[compraId]' LIMIT 1");
                        $datCompra=mysqli_fetch_assoc($selCompra);
                    ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario para editar Compras Nacionales</h3><br>
                            <form class="form-material" name="frmEditNacionales" id="frmEditNacionales">
                                <input type="hidden" name="compraId" id="compraId" value="<?php echo $datCompra["compraId"] ?>">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <input type="date" class="form-control" value="<?php echo $datCompra["fechaCompra"];?>" name="fechaCompra" id="fechaCompra">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Proveedor</label>
                                            <select class="form-control" name="proveedorId" id="proveedorId">
                                                <option value="">-- Seleccione el Proveedor --</option>
                                                <?php
                                                    $selProveedor=mysqli_query($con,"SELECT * FROM inv_proveedores WHERE tipoProveedor='NACIONAL'");
                                                    while($datProveedor=mysqli_fetch_assoc($selProveedor)){

                                                    if ($datCompra["proveedorId"]==$datProveedor["proveedorId"]){
                                                        $selected="selected";
                                                    } else {
                                                        $selected="";
                                                    }
                                                ?>
                                                    <option value="<?php echo $datProveedor["proveedorId"] ?>" <?php echo $selected;?>>
                                                        <?php
                                                            echo "» ".$datProveedor["nombre"];
                                                        ?>
                                                    </option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Numero</label>
                                            <input type="text" class="form-control" value="<?php echo $datCompra["numeroFactura"] ?>" name="numeroFactura" id="numeroFactura">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bodega</label>
                                            <select class="form-control" name="bodegaId" id="bodegaId">
                                                <option value="">-- Seleccione el producto --</option>
                                                <?php
                                                    $selBodega=mysqli_query($con,"SELECT * FROM inv_bodega");
                                                    while($datBodega=mysqli_fetch_assoc($selBodega)){

                                                    if ($datCompra["bodegaId"]==$datBodega["bodegaId"]){
                                                        $selected="selected";
                                                    } else {
                                                        $selected="";
                                                    }
                                                ?>
                                                    <option value="<?php echo $datBodega["bodegaId"] ?>" <?php echo $selected;?>><?php echo "» ".$datBodega["bodega"] ?></option>
                                                <?php }  mysqli_free_result($selBodega); mysqli_close($con); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Descripción de la compra:</label>
                                            <textarea class="form-control" rows="2" name="descripcion" id="descripcion"><?php echo $datCompra["descripcion"] ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="editarEncabezado">
                                                <i class="fa fa-save"></i> Guardar Datos
                                            </button>
                                            <button type="button" class="btn btn-danger" id="regresar" style="margin-left: 5px;">
                                                <i class="fa fa-arrow-left"></i> Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div id="nacionalesDetalle">

                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function(){
                            var compraId = $("#compraId").val();
                            cargarNacionalesDetalle(compraId);
                        });
                    </script>
                    <script src="../../controlador/js/form/frmNacionales.js"></script>

