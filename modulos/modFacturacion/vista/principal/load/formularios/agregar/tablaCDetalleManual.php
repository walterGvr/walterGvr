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
							$totalDescuento=0;
							$selDetalleManual=mysqli_query($con,"SELECT * FROM fac_cotizaciondetalle_manual WHERE cotizacionManualId='$_REQUEST[cotizacionManualId]'");
							while($datDetalle=mysqli_fetch_assoc($selDetalleManual)){

							$totalReg=$datDetalle["precioUnitario"]*$datDetalle["cantidad"];
						?>
						<tr>
							<td><?php echo $num=$num+1;?></td>
							<td class="text-right"><?php echo $datDetalle["cantidad"];?></td>

							<td>
								<?php
									$selProducto=mysqli_query($con,"SELECT producto FROM inv_producto WHERE productoId='$datDetalle[productoId]' LIMIT 1");
									$datProducto=mysqli_fetch_assoc($selProducto);
									echo $datProducto["producto"];
								?>
							</td>

							<td class="text-right"><?php echo number_format($datDetalle["precioUnitario"],'2','.',',');?></td>
							<td class="text-right"><?php echo number_format($totalReg,'2','.',',');?></td>
							<td>
								<!-- ELIMINAR -->
								<a href="#" onclick="eliminarCDetalleManual(<?php echo $datDetalle['cotizacionDetalleId']?>,<?php echo $datDetalle['cotizacionManualId']?>,<?php echo $datDetalle['productoId']?>);">
									<button class="btn btn-danger" title="Eliminar">
										<i class="fa fa-trash-alt"></i>
									</button>
								</a>
							</td>
						</tr>
						<?php 
								$totalCotizacion+= $totalReg;
								
								$sumDescuento=$datDetalle["descuentoCliente"];
								$totalDescuento+=$sumDescuento;
							
							} 
						
						?>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>SUB TOTAL (SIN DESCUENTO)</strong></td>
							<td class="text-right"><strong><?php echo number_format($totalCotizacion+$sumDescuento,'2','.',',');?></strong></td>
							<td></td>
						</tr>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>DESCUENTO CLIENTE (-)</strong></td>
							<td class="text-right"><strong><?php echo number_format($totalDescuento,'2','.',',');?></strong></td>
							<td></td>
						</tr>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>DESCUENTO PROMOCION (-)</strong></td>
							<td class="text-right"><strong><?php echo number_format('0','2','.',',');?></strong></td>
							<td></td>
						</tr>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>SUB-TOTAL</strong></td>
							<td class="text-right"><strong><?php echo number_format($totalCotizacion,'2','.',',');?></strong></td>
							<td></td>
						</tr>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>I.V.A</strong></td>
							<td class="text-right"><strong><?php $iva=$totalCotizacion*0.13; echo number_format($iva,'2','.',',');?></strong></td>
							<td></td>
						</tr>


						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>TOTAL COTIZACION</strong></td>
							<td class="text-right"><strong><?php $totalCotizacion=$totalCotizacion+$iva; echo number_format($totalCotizacion,'2','.',',');?></strong></td>
							<td></td>
						</tr>


					</tbody>
				</table>
			</div>