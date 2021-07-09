<?php
    session_start();
	include ("../../../../../../../lib/config/conect.php");

	#variables de entrada
	$cadena = $_POST['q'];

	$selInter=mysqli_query($con,"
        SELECT com.*,pro.nombre
        FROM inv_compra com
        LEFT JOIN inv_proveedores pro ON pro.proveedorId=com.proveedorId
        WHERE (com.fechaCompra LIKE '%".$cadena."%' OR com.numeroFactura  LIKE '%".$cadena."%' OR pro.nombre  LIKE '%".$cadena."%') AND com.tipo='I'");

	if(mysqli_num_rows($selInter)==0) {
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
                        while ($datInter=mysqli_fetch_assoc($selInter)){
                    ?>
                    <tr>
                        <td><?php echo $num+=1; ?></td>
                        <td>
                            <?php
                                echo "<b>Fecha:</b> ".$datInter["fechaCompra"]." | <b>Numero:</b> ".$datInter["numeroFactura"]." | <b'>Proveedor: ".$datInter["nombre"]."</b>";
                            ?>

                            <br>

                            <!-- EDITAR -->
                            <a href="#" onclick="editarInternacional(<?php echo $datInter["compraId"] ?>)">
                                <button class="btn btn-primary" title="Editar">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>


                            <!-- ELIMINAR
                            <a href="#" onclick="eliminarNacional(<?php echo $datInter["compraId"] ?>);">
                                <button class="btn btn-danger" title="Eliminar">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </a>-->

                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
	<?php } ?>
