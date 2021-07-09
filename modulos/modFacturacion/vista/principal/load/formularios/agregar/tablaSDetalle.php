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
							$totalSistema=0;
							$selDetalle=mysqli_query($con,"SELECT * FROM vista_sistema_detalle WHERE sistemaId='$_REQUEST[sistemaId]'");
							while($datDetalle=mysqli_fetch_assoc($selDetalle)){

							$totalReg=$datDetalle["precio"]*$datDetalle["cantidad"];
						?>
						<tr>
							<td><?php echo $num=$num+1;?></td>
							<td class="text-right"><?php echo $datDetalle["cantidad"];?></td>
							<td><?php echo $datDetalle["producto"];?></td>
							<td class="text-right"><?php echo number_format($datDetalle["precio"],'2','.',',');?></td>
							<td class="text-right"><?php echo number_format($totalReg,'2','.',',');?></td>
							<td>
								<!-- ELIMINAR -->
	                            <a href="#" onclick="eliminarSDetalle(<?php echo $datDetalle["sistemaDetalleId"]?>,<?php echo $datDetalle["sistemaId"]?>);">
	                                <button class="btn btn-danger" title="Eliminar">
	                                    <i class="fa fa-trash-alt"></i>
	                                </button>
	                            </a>
							</td>
						</tr>
						<?php $totalSistema = $totalSistema + $totalReg; } ?>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>SUB-TOTAL</strong></td>
							<td class="text-right"><strong><?php echo "$ ".number_format($totalSistema,'2','.',',');?></strong></td>
							<td></td>
						</tr>

					</tbody>
				</table>
			</div>