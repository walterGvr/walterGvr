<?php
    session_start();
	include ("../../../../../../../lib/config/conect.php");

	#variables de entrada
	$cadena = $_POST['q'];

	$selLinea=mysqli_query($con,"
        SELECT  * FROM vista_lineas
        WHERE linea LIKE '%".$cadena."%' OR marca  LIKE '%".$cadena."%' OR nombre LIKE '%".$cadena."%'");

	if(mysqli_num_rows($selLinea)==0) {
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
                        while ($datLinea=mysqli_fetch_assoc($selLinea)){
                    ?>
                    <tr>
                        <td><?php echo $num+=1; ?></td>
                        <td>
                            <?php
                                echo "<b>Linea:</b> ".$datLinea["linea"]." | "."<b>Proveedor:</b> ".$datLinea["nombre"]." | <b>Marca:</b> ".$datLinea["marca"]
                            ?>

                            <br>

                            <!-- EDITAR -->
                            <a href="#" onclick="editarLinea(<?php echo $datLinea["lineaId"] ?>)">
                                <button class="btn btn-primary" title="Editar">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>

                            <!-- ELIMINAR -->
                            <a href="#" onclick="eliminarLinea(<?php echo $datLinea["lineaId"] ?>);">
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
