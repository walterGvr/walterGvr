			<?php include("../../../../../../../lib/config/conect.php") ?>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>NO</th>
							<th>TRAMITE</th>
							<th class="text-right">CANT.</th>
							<th class="text-right">C.UNIT</th>
							<th class="text-right">V.TOTAL</th>
							<th>ELIMINAR</th>
						</tr>
					</thead>

					<tbody>
						<?php
							$registro=0;
							$totalTramite=0;
							$selTramite=mysqli_query($con,"SELECT * FROM inv_tramites WHERE compraId='$_REQUEST[compraId]'");
							while($datTramite=mysqli_fetch_assoc($selTramite)){
						?>
						<tr>
							<td><?php echo $registro=$registro+1;?></td>
							<td><?php echo $datTramite["tramite"];?></td>
							<td class="text-right"><?php echo $datTramite["cantidad"];?></td>
							<td class="text-right"><?php echo number_format($datTramite["valorUnitario"],'2','.',',');?></td>
							<td class="text-right"><?php echo number_format($datTramite["total"],'2','.',',');?></td>
							<td>
								<?php if ($datTramite["retaceoEfectuado"]==0){?>
									<!-- ELIMINAR -->
		                            <a href="#" onclick="eliminarTramite(<?php echo $datTramite["tramiteId"]?>,<?php echo $datTramite["compraId"]?>);">
		                                <button class="btn btn-danger" title="Eliminar">
		                                    <i class="fa fa-trash-alt"></i>
		                                </button>
		                            </a>
	                        	<?php } ?>
							</td>
						</tr>
						<?php $totalTramite = $totalTramite + $datTramite["total"]; } ?>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>TOTAL DEL TRAMITE</strong></td>
							<td class="text-right"><strong><?php echo "$ ".number_format($totalTramite,'2','.',',');?></strong></td>
							<td></td>
						</tr>

					</tbody>
				</table>
			</div>