                    <?php include("../../../../../../../lib/config/conect.php");?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Usuarios</h3><br>
                            <form class="form-material" name="frmUsuario" id="frmUsuario">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombres</label>
                                            <input type="text" class="form-control" name="nombres" id="nombres">
                                        </div>

                                        <div class="form-group">
                                            <label>Apellidos</label>
                                            <input type="text" class="form-control" name="apellidos" id="apellidos">
                                        </div>

                                        <div class="form-group">
                                            <label>Usuario</label>
                                            <input type="text" class="form-control" name="usuario" id="usuario">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contraseña</label>
                                            <input type="password" class="form-control" name="clave" id="clave">
                                        </div>

                                        <div class="form-group">
                                            <label>Rol</label>
                                            <select class="form-control" name="rolId" id="rolId">
                                                <option value="">-- Seleccione el Rol --</option>
                                                <?php
                                                    $selRol=mysqli_query($con,"SELECT * FROM co_roles");
                                                    while($datRol=mysqli_fetch_assoc($selRol)){
                                                ?>
                                                    <option value="<?php echo $datRol["rolId"] ?>"><?php echo "» ".$datRol["nombreRol"] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="guardar">
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
                    <script src="../../controlador/js/form/frmUsuarios.js"></script>

