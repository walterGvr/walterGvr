                    <?php
                        include("../../../../../../../lib/config/conect.php");
                        $selUsu=mysqli_query($con,"SELECT * FROM co_usuarios WHERE usuarioId='$_REQUEST[usuarioId]' LIMIT 1");
                        $datUsu=mysqli_fetch_assoc($selUsu);
                    ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Editar Usuarios</h3><br>
                            <form class="form-material" name="frmEditUsuario" id="frmEditUsuario">
                                <input type="hidden" name="usuarioId" value="<?php echo $datUsu["usuarioId"]?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombres</label>
                                            <input type="text" class="form-control" value="<?php echo $datUsu["nombres"]?>" name="nombres" id="nombres">
                                        </div>

                                        <div class="form-group">
                                            <label>Apellidos</label>
                                            <input type="text" class="form-control" value="<?php echo $datUsu["apellidos"]?>" name="apellidos" id="apellidos">
                                        </div>

                                        <div class="form-group">
                                            <label>Usuario</label>
                                            <input type="text" class="form-control" value="<?php echo $datUsu["usuario"]?>" name="usuario" id="usuario">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contraseña</label>
                                            <input type="password" class="form-control" value="<?php echo $datUsu["clave"]?>" name="clave" id="clave">
                                        </div>

                                        <div class="form-group">
                                            <label>Estado</label>
                                            <select class="form-control" name="estado" id="estado">
                                                <?php if ($datUsu["estado"]==1){?>
                                                    <option value="1" selected>ACTIVO</option>
                                                    <option value="0">INACTIVO</option>
                                                <?php } else if ($datUsu["estado"]==0) { ?>
                                                    <option value="1">ACTIVO</option>
                                                    <option value="0" selected>INACTIVO</option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Rol</label>
                                            <select class="form-control" name="rolId" id="rolId">
                                                <option value="">-- Seleccione el Rol --</option>
                                                <?php
                                                    $selRol=mysqli_query($con,"SELECT * FROM co_roles");
                                                    while($datRol=mysqli_fetch_assoc($selRol)){

                                                    if ($datRol["rolId"]==$datUsu["rolId"]){
                                                        $selected="selected";
                                                    } else {
                                                        $selected="";
                                                    }
                                                ?>
                                                    <option value="<?php echo $datRol["rolId"] ?>" <?php echo $selected?>><?php echo "» ".$datRol["nombreRol"] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="editarUsuario">
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

