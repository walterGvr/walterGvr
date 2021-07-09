                    <?php
                        include("../../../../../../../lib/config/conect.php");
                        $selMarca=mysqli_query($con,"SELECT * FROM inv_marcas WHERE marcaId='$_REQUEST[marcaId]' LIMIT 1");
                        $datMarca=mysqli_fetch_assoc($selMarca);
                    ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Marcas</h3><br>
                            <form class="form-material" name="frmEditMarcas" id="frmEditMarcas">
                                <input type="hidden" name="marcaId" id="marcaId" value="<?php echo $datMarca["marcaId"] ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Seleccione el Proveedor</label>
                                            <select class="form-control" name="proveedorId" id="proveedorId">
                                                <option value="" selected disabled>-- Seleccione el Proveedor --</option>
                                                <?php $selProveedor=mysqli_query($con,"SELECT * FROM inv_proveedores");
                                                    while($datProveedor=mysqli_fetch_assoc($selProveedor)){

                                                    if ($datMarca["proveedorId"]==$datProveedor["proveedorId"]){
                                                        $selected="selected";
                                                    } else {
                                                        $selected="";
                                                    }

                                                ?>
                                                    <option value="<?php echo $datProveedor["proveedorId"]?>" <?php echo $selected ?>><?php echo $datProveedor["nombre"]." | ".$datProveedor["tipoProveedor"]?></option>

                                                <?php } mysqli_free_result($selProveedor);?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre de la Marca</label>
                                            <input type="text" class="form-control" value="<?php echo $datMarca["marca"] ?>" name="marca" id="marca">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="editarMarca">
                                                <i class="fa fa-save"></i> Guardar Información
                                            </button>
                                            <button type="button" class="btn btn-warning" id="regresar" style="margin-left: 5px;">
                                                <i class="fa fa-arrow-left"></i> Regresar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script src="../../controlador/js/form/frmMarcas.js"></script>

