<?php
    session_start();
	include ("../../../../../../../lib/config/conect.php");

	#variables de entrada
	$cadena = $_POST['q'];
	$selCotizacion=mysqli_query($con,"
        SELECT * FROM vista_cotizacion
        WHERE numCotizacion LIKE '%".$cadena."%' OR nombreCliente  LIKE '%".$cadena."%'");

	if(mysqli_num_rows($selCotizacion)==0) {
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
                        while ($datCotizacion=mysqli_fetch_assoc($selCotizacion)){
                    ?>
                    <tr>
                        <td><?php echo $num+=1; ?></td>
                        <td>
                            <?php echo $datCotizacion["numCotizacion"]." | ".$datCotizacion["nombreCliente"];?>
                            <br>

                            <!-- EDITAR -->
                            <a href="#" onclick="editarCotizacion(<?php echo $datCotizacion["cotizacionId"] ?>)">
                                <button class="btn btn-primary" title="Editar">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>

                            <!-- ELIMINAR -->
                            <a href="#" onclick="eliminarCotizacion(<?php echo $datCotizacion["cotizacionId"] ?>);">
                                <button class="btn btn-danger" title="Eliminar">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </a>

                            <!-- IMPRIMIR -->
                            <a href="../reportes/repCotizacion?cotizacionId=<?php echo $datCotizacion["cotizacionId"] ?>" target="_blank">
                                <button class="btn btn-warning" title="Imprimir">
                                    <i class="fa fa-print"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
	<?php } ?>
