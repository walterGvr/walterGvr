<?php
    session_start();
	include ("../../../../../../../lib/config/conect.php");

	#variables de entrada
	$cadena = $_POST['q'];

	$selTipoCliente=mysqli_query($con,"SELECT * FROM fac_tipocliente WHERE tipoCliente LIKE '%".$cadena."%'");

	if(mysqli_num_rows($selTipoCliente)==0) {
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
                        while ($datTipoCliente=mysqli_fetch_assoc($selTipoCliente)){
                    ?>
                    <tr>
                        <td><?php echo $num+=1; ?></td>
                        <td>
                            <?php echo $datTipoCliente["tipoCliente"]." | ".(($datTipoCliente["descuento"])*100)."%";?>
                            <br>

                            <!-- EDITAR -->
                            <a href="#" onclick="editarTipoCliente(<?php echo $datTipoCliente['tipoClienteId'] ?>)">
                                <button class="btn btn-primary" title="Editar">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
	<?php } ?>
