			<?php include("../../../../../../../lib/config/conect.php") ?>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>NO</th>
							<th>PRODUCTO</th>
							<th class="text-right">CANT.</th>
							<th class="text-right">C.UNIT</th>
							<th class="text-right">V.TOTAL</th>
							<th>ELIMINAR</th>
						</tr>
					</thead>

					<tbody>
						<?php
							$num=0;
							$totalCompra=0;
							$selDetalle=mysqli_query($con,"SELECT * FROM vista_compras WHERE compraId='$_REQUEST[compraId]'");
							while($datDetalle=mysqli_fetch_assoc($selDetalle)){
						?>
						<tr>
							<td><?php echo $num=$num+1;?></td>
							<td><?php echo $datDetalle["codigo"]." | ".$datDetalle["producto"];?></td>
							<td class="text-right"><?php echo $datDetalle["cantidad"];?></td>
							<td class="text-right"><?php echo number_format($datDetalle["valorUnitario"],'2','.',',');?></td>
							<td class="text-right"><?php echo number_format($datDetalle["total"],'2','.',',');?></td>
							<td>
								<?php if ($datDetalle["retaceoEfectuado"]==0){?>
									<!-- ELIMINAR -->
		                            <a href="#" onclick="eliminarRegistro(<?php echo $datDetalle["compraDetalleId"]?>,<?php echo $datDetalle["compraId"]?>);">
		                                <button class="btn btn-danger" title="Eliminar">
		                                    <i class="fa fa-trash-alt"></i>
		                                </button>
		                            </a>
	                        	<?php } ?>
							</td>
						</tr>
						<?php $totalCompra = $totalCompra + $datDetalle["total"]; } ?>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>TOTAL DE LA COMPRA</strong></td>
							<td class="text-right"><strong><?php echo "$ ".number_format($totalCompra,'2','.',',');?></strong></td>
							<td></td>
						</tr>

					</tbody>
				</table>
			</div>