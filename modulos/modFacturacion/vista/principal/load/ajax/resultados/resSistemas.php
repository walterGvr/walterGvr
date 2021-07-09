<?php
    session_start();
	include ("../../../../../../../lib/config/conect.php");

	#variables de entrada
	$cadena = $_POST['q'];
	$selSistema=mysqli_query($con,"SELECT * FROM fac_sistema WHERE nombreSistema LIKE '%".$cadena."%'");
	if(mysqli_num_rows($selSistema)==0) {
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
                        while ($datSistema=mysqli_fetch_assoc($selSistema)){
                    ?>
                    <tr>
                        <td><?php echo $num+=1; ?></td>
                        <td>
                            <?php echo $datSistema["nombreSistema"];?>
                            <br>

                            <!-- EDITAR -->
                            <a href="#" onclick="editarSistema(<?php echo $datSistema["sistemaId"] ?>)">
                                <button class="btn btn-primary" title="Editar">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>

                            <!-- ELIMINAR -->
                            <a href="#" onclick="eliminarSistema(<?php echo $datSistema["sistemaId"] ?>);">
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
