<?php
    session_start();
	include ("../../../../../../../lib/config/conect.php");

	#variables de entrada
	$cadena = $_POST['q'];
	$selCotizacionManual=mysqli_query($con,"
        SELECT * FROM vista_cotizacion_manual
        WHERE numCotizacion LIKE '%".$cadena."%' OR nombreCliente  LIKE '%".$cadena."%'");

	if(mysqli_num_rows($selCotizacionManual)==0) {
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
                        while ($datCotizacionManual=mysqli_fetch_assoc($selCotizacionManual)){
                    ?>
                    <tr>
                        <td><?php echo $num+=1; ?></td>
                        <td>
                            <?php echo $datCotizacionManual["numCotizacion"]." | ".$datCotizacionManual["nombreCliente"];?>
                            <br>

                            <!-- EDITAR -->
                            <a href="#" onclick="editarCotizacionManual(<?php echo $datCotizacionManual['cotizacionManualId'] ?>)">
                                <button class="btn btn-primary" title="Editar">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>

                            <!-- ELIMINAR -->
                            <a href="#" onclick="eliminarCotizacionManual(<?php echo $datCotizacionManual['cotizacionManualId'] ?>);">
                                <button class="btn btn-danger" title="Eliminar">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </a>

                            <!-- IMPRIMIR -->
                            <a href="../reportes/repCotizacionManual?cotizacionManualId=<?php echo $datCotizacionManual["cotizacionManualId"] ?>" target="_blank">
                                <button class="btn btn-warning" title="Imprimir">
                                    <i class="fa fa-print"></i>
                                </button>
                            </a>

                            <!-- DUPLICAR -->
                            <a href="#" onclick="duplicarCotizacion(<?php echo $datCotizacionManual['cotizacionManualId'] ?>);">
                                <button class="btn btn-dark" title="Duplicar">
                                    <i class="fa fa-copy"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
	<?php } ?>
