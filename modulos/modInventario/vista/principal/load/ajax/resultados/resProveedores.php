<?php
    session_start();
	include ("../../../../../../../lib/config/conect.php");

	#variables de entrada
	$cadena = $_POST['q'];

	$selProveedor=mysqli_query($con,"
        SELECT * FROM inv_proveedores
        WHERE nombre LIKE '%".$cadena."%' OR tipoProveedor  LIKE '%".$cadena."%'");

	if(mysqli_num_rows($selProveedor)==0) {
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
                        while ($datProveedor=mysqli_fetch_assoc($selProveedor)){
                    ?>
                    <tr>
                        <td><?php echo $num+=1; ?></td>
                        <td>
                            <?php
                                echo $datProveedor["nombre"]." | Tipo: ".$datProveedor["tipoProveedor"]
                            ?>

                            <br>

                            <!-- EDITAR -->
                            <a href="#" onclick="editarProveedor(<?php echo $datProveedor["proveedorId"] ?>)">
                                <button class="btn btn-primary" title="Editar">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>

                            <!-- ELIMINAR -->
                            <a href="#" onclick="eliminarProveedor(<?php echo $datProveedor["proveedorId"] ?>);">
                                <button class="btn btn-danger" title="Eliminar">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </a>
                        </td>


                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
	<?php } ?>
