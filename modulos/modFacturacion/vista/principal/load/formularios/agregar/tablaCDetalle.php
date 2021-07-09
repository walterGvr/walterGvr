			<?php include("../../../../../../../lib/config/conect.php") ?>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>NO</th>
							<th class="text-right">CANT.</th>
							<th>PRODUCTO</th>
							<th class="text-right">C.UNIT</th>
							<th class="text-right">V.TOTAL</th>
							<th>ELIMINAR</th>
						</tr>
					</thead>

					<tbody>
						<?php
							$num=0;
							$totalCotizacion=0;
							$selDetalle=mysqli_query($con,"SELECT * FROM fac_cotizaciondetalle WHERE cotizacionId='$_REQUEST[cotizacionId]'");
							while($datDetalle=mysqli_fetch_assoc($selDetalle)){

							$totalReg=$datDetalle["precio"]*$datDetalle["cantidad"];
						?>
						<tr>
							<td><?php echo $num=$num+1;?></td>
							<td class="text-right"><?php echo $datDetalle["cantidad"];?></td>

							<td>
								<?php
									$selSistema=mysqli_query($con,"SELECT nombreSistema FROM fac_sistema WHERE sistemaId='$datDetalle[sistemaId]' LIMIT 1");
									$datSistema=mysqli_fetch_assoc($selSistema);
									echo $datSistema["nombreSistema"];
								?>
							</td>

							<td class="text-right"><?php echo number_format($datDetalle["precio"],'2','.',',');?></td>
							<td class="text-right"><?php echo number_format($totalReg,'2','.',',');?></td>
							<td>
								<!-- ELIMINAR -->
	                            <a href="#" onclick="eliminarCDetalle(<?php echo $datDetalle["cotizacionDetalleId"]?>,<?php echo $datDetalle["cotizacionId"]?>,<?php echo $datDetalle["sistemaId"]?>);">

	                                <button class="btn btn-danger" title="Eliminar">
	                                    <i class="fa fa-trash-alt"></i>
	                                </button>
	                            </a>
							</td>
						</tr>
						<?php $totalCotizacion = $totalCotizacion + $totalReg; } ?>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>SUB-TOTAL</strong></td>
							<td class="text-right"><strong><?php echo "$ ".number_format($totalCotizacion,'2','.',',');?></strong></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>