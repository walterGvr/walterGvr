                    <?php
                        include("../../../../../../../lib/config/conect.php");
                        $selProveedor=mysqli_query($con,"SELECT * FROM inv_proveedores WHERE proveedorId='$_REQUEST[proveedorId]' LIMIT 1");
                        $datProveedor=mysqli_fetch_assoc($selProveedor);
                    ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Usuarios</h3><br>
                            <form class="form-material" name="frmEditProveedor" id="frmEditProveedor">
                                <input type="hidden" name="proveedorId" id="proveedorId" value="<?php echo $datProveedor["proveedorId"] ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tipo Proveedor</label>
                                            <select class="form-control" name="tipoProveedor" id="tipoProveedor">
                                                <?php if ($datProveedor["tipoProveedor"]=="NACIONAL") {?>
                                                    <option value="NACIONAL" selected>NACIONAL</option>
                                                    <option value="INTERNACIONAL">INTERNACIONAL</option>
                                                <?php } else if ($datProveedor["tipoProveedor"]=="INTERNACIONAL"){ ?>
                                                   <option value="NACIONAL">NACIONAL</option>
                                                    <option value="INTERNACIONAL" selected>INTERNACIONAL</option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Nombres</label>
                                            <input type="text" class="form-control" value="<?php echo $datProveedor["nombre"] ?>" name="nombre" id="nombre">
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" value="<?php echo $datProveedor["email"] ?>" name="email" id="email">
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Telefono</label>
                                            <input type="text" class="form-control" value="<?php echo $datProveedor["telefono"] ?>" name="telefono" id="telefono">
                                        </div>

                                        <div class="form-group">
                                            <label>Sitio Web</label>
                                            <input type="text" class="form-control" value="<?php echo $datProveedor["sitioWeb"] ?>" name="sitioWeb" id="sitioWeb">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="editarProveedor">
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
                    <script src="../../controlador/js/form/frmProveedores.js"></script>

