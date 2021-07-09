<?php
    session_start();
	include ("../../../../../../../lib/config/conect.php");

	#variables de entrada
	$cadena = $_POST['q'];

	$selBodega=mysqli_query($con,"SELECT * FROM inv_bodega WHERE bodega LIKE '%".$cadena."%'");
	if(mysqli_num_rows($selBodega)==0) {
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
                        while ($datBodega=mysqli_fetch_assoc($selBodega)){
                    ?>
                    <tr>
                        <td><?php echo $num+=1; ?></td>
                        <td>
                            <?php
                                if ($datBodega["tipoBodega"]==1){$tipo="GENERAL";} else {$tipo="AVERIAS";}
                                echo $datBodega["bodega"]." | ".$tipo;
                            ?>

                            <br>

                            <!-- EDITAR -->
                            <a href="#" onclick="editarBodega(<?php echo $datBodega["bodegaId"] ?>)">
                                <button class="btn btn-primary" title="Editar">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>

                            <?php if ($_SESSION["rolId"]=="1"){?>
                                <!-- ELIMINAR -->
                                <a href="#" onclick="eliminarBodega(<?php echo $datBodega["bodegaId"] ?>);">
                                    <button class="btn btn-danger" title="Eliminar">
                                        <i class="fa fa-trash-alt"></i>
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
