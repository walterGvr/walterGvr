<?php
    session_start();
	include ("../../../../../../../lib/config/conect.php");

	#variables de entrada
	$cadena = $_POST['q'];

	$selPrecios=mysqli_query($con,"
        SELECT pre.precioId,pre.productoId,pro.producto,pre.precio
        FROM fac_precios pre
        LEFT JOIN inv_producto pro ON pro.productoId=pre.productoId
        WHERE pro.producto LIKE '%".$cadena."%'");

	if(mysqli_num_rows($selPrecios)==0) {
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
                        while ($datPrecio=mysqli_fetch_assoc($selPrecios)){
                    ?>
                    <tr>
                        <td><?php echo $num+=1; ?></td>
                        <td>
                            <?php echo $datPrecio["producto"]." | "."<b> $ ".number_format($datPrecio["precio"],'2','.',',')."</b>";?>
                            <br>

                            <!-- EDITAR -->
                            <a href="#" onclick="editarPrecio(<?php echo $datPrecio["precioId"] ?>)">
                                <button class="btn btn-primary" title="Editar">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>

                            <!-- ELIMINAR
                            <a href="#" onclick="eliminarPrecio(<?php //echo $datPrecio["precioId"] ?>);">
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
