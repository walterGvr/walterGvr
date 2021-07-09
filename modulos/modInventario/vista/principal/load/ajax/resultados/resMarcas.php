<?php
    session_start();
	include ("../../../../../../../lib/config/conect.php");

	#variables de entrada
	$cadena = $_POST['q'];

	$selMarca=mysqli_query($con,"
        SELECT * FROM vista_marcas
        WHERE nombre LIKE '%".$cadena."%' OR marca  LIKE '%".$cadena."%'");

	if(mysqli_num_rows($selMarca)==0) {
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
                        while ($datMarca=mysqli_fetch_assoc($selMarca)){
                    ?>
                    <tr>
                        <td><?php echo $num+=1; ?></td>
                        <td>
                            <?php
                                echo "<b>Proveedor:</b> ".$datMarca["nombre"]." | <b>Marca:</b> ".$datMarca["marca"]
                            ?>

                            <br>

                            <!-- EDITAR -->
                            <a href="#" onclick="editarMarca(<?php echo $datMarca["marcaId"] ?>)">
                                <button class="btn btn-primary" title="Editar">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>

                            <!-- ELIMINAR -->
                            <a href="#" onclick="eliminarMarca(<?php echo $datMarca["marcaId"] ?>);">
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
