<?php
    session_start();
	include ("../../../../../../../lib/config/conect.php");

	#variables de entrada
	$cadena = $_POST['q'];

	$selProducto=mysqli_query($con,"
        SELECT * FROM inv_producto
        WHERE producto LIKE '%".$cadena."%' OR codigo  LIKE '%".$cadena."%'");

	if(mysqli_num_rows($selProducto)==0) {
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
                        while ($datProducto=mysqli_fetch_assoc($selProducto)){
                    ?>
                    <tr>
                        <td><?php echo $num+=1; ?></td>
                        <td>
                            <?php
                                echo "<b>Código:</b> ".$datProducto["codigo"]." | <b>Producto:</b> ".$datProducto["producto"]." | <b style='color: blue;'>Existencia: ".$datProducto["exActual"]."</b>";
                            ?>

                            <br>

                            <!-- EDITAR -->
                            <a href="#" onclick="editarProducto(<?php echo $datProducto["productoId"] ?>)">
                                <button class="btn btn-primary" title="Editar">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>

                            <!-- ELIMINAR -->
                            <a href="#" onclick="eliminarProducto(<?php echo $datProducto["productoId"] ?>);">
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
