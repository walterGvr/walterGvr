<?php
    session_start();
	include ("../../../../../../../lib/config/conect.php");

	#variables de entrada
	$cadena = $_POST['q'];

	$selUsuarios=mysqli_query($con,"
        SELECT * FROM co_usuarios
        WHERE nombres LIKE '%".$cadena."%' OR usuario  LIKE '%".$cadena."%'");

	if(mysqli_num_rows($selUsuarios)==0) {
      	echo '<center><b>No hay sugerencias</b></center>'; }
	else { ?>
        <div class="table-responsive">
            <table class="table table-list-search table-hover">
                <thead>
                    <tr>
                        <th style="font-weight: bold;">NO</th>
                        <th style="font-weight: bold;">DESCRIPCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $num=0;
                        while ($datUsuarios=mysqli_fetch_assoc($selUsuarios)){
                    ?>
                    <tr>
                        <td><?php echo $num+=1; ?></td>
                        <td>
                            <?php echo $datUsuarios["nombres"]." ".$datUsuarios["apellidos"];?> |
                            <?php echo "<b>Usuario:</b> ".$datUsuarios["usuario"] ?> |
                            <?php  if ($datUsuarios["estado"]==1){echo "ACTIVO";} else {echo "INACTIVO";}?>

                            <br>

                            <!-- EDITAR -->
                            <a href="#" onclick="editarUsuario(<?php echo $datUsuarios["usuarioId"] ?>)">
                                <button class="btn btn-primary" title="Editar">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>

                            <?php if ($_SESSION["rolId"]=="1"){?>

                                <!-- ELIMINAR -->
                                <a href="#" onclick="eliminarUsuario(<?php echo $datUsuarios["usuarioId"] ?>);">
                                    <button class="btn btn-danger" title="Eliminar">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </a>

                                <!-- PERMISOS -->
                                <a href="#" onclick="permisosUsuarios(<?php echo $datUsuarios["usuarioId"] ?>);">
                                    <button class="btn btn-success" title="Permisos">
                                        <i class="fa fa-list"></i>
                                    </button>
                                </a>

                            <?php } else {?>

                            <?php } ?>
                        </td>


                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
	<?php } ?>
