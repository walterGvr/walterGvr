                    <?php 
                        include("../../../../../../../lib/config/conect.php");
                        $usuarioId=$_REQUEST["usuarioId"];
                        $selUsuario=mysqli_query($con,"SELECT nombres,apellidos FROM co_usuarios WHERE usuarioId='$usuarioId' LIMIT 1");
                        $datUsuario=mysqli_fetch_assoc($selUsuario);
                    ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Permisos a los usuarios</h3><br>
                            <form class="form-material" name="frmPermisos" id="frmPermisos">
                                <input type="hidden" name="usuarioId" id="usuarioId" value="<?php echo $usuarioId;?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Usuario</label>
                                            <input readonly type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $datUsuario["nombres"]." ".$datUsuario["apellidos"];?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Acceso a Módulos</label>
                                            <select class="form-control" name="moduloId" id="moduloId">
                                                <option value="" selected>-- Seleccione el modulo --</option>
                                                <?php 
                                                    $selModulo=mysqli_query($con,"SELECT * FROM co_modulos");
                                                    while($datModulo=mysqli_fetch_assoc($selModulo)){
                                                ?>
                                                    <option value="<?php echo $datModulo["moduloId"]?>"><?php echo "Módulo de ".$datModulo["nombre"]?></option>
                                                <?php }?>
                                            </select>
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
                        <div id="loadTblPermisos"></div>
                    </div>
                    <script src="../../controlador/js/form/frmPermisos.js"></script>

                    

