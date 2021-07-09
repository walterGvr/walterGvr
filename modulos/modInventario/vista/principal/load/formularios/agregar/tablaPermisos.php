            <?php include("../../../../../../../lib/config/conect.php");?>
            <br><br>
            <h1>Listado de Módulos Autorizados</h1>
            <div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>NO</th>
							<th>DESCRIPCIÓN</th>
						</tr>
					</thead>

					<tbody>
                        <?php
                            $registro=0;
							$selPermisos=mysqli_query($con,"SELECT * FROM co_permisos WHERE usuarioId='$_REQUEST[usuarioId]'");
							while($datPermisos=mysqli_fetch_assoc($selPermisos)){
						?>
						<tr>
							<td><?php echo $registro=$registro+1;?></td>
							<td>
                                <?php
                                    $selModulo=mysqli_query($con,"SELECT nombre FROM co_modulos WHERE moduloId='$datPermisos[moduloId]' LIMIT 1");
                                    $datModulo=mysqli_fetch_assoc($selModulo);
                                    echo "Módulo de ".$datModulo["nombre"];
                                ?><br>

                                <!-- ELIMINAR -->
                                <a href="#" onclick="eliminarPermiso(<?php echo $datPermisos["permisoId"]?>,<?php echo $datPermisos["usuarioId"]?>);">
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