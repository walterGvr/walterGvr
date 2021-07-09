			<?php include("../../../../../../../lib/config/conect.php") ?>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>NO</th>
							<th class="text-right">CANT.</th>
							<th>ADICIONAL</th>
							<th class="text-right">C.UNIT</th>
							<th class="text-right">V.TOTAL</th>
							<th>ELIMINAR</th>
						</tr>
					</thead>

					<tbody>
						<?php
							$num=0;
							$totalAdicional=0;
							$selAdicional=mysqli_query($con,"SELECT * FROM fac_cotadicional WHERE cotizacionId='$_REQUEST[cotizacionId]'");
							while($datAdicional=mysqli_fetch_assoc($selAdicional)){
						?>
						<tr>
							<td><?php echo $num=$num+1;?></td>
							<td class="text-right"><?php echo $datAdicional["cantidad"];?></td>

							<td>
								<?php
									$selAdi=mysqli_query($con,"SELECT adicional FROM fac_adicionales WHERE adicionalId='$datAdicional[adicionalId]' LIMIT 1");
									$datAdi=mysqli_fetch_assoc($selAdi);
									echo $datAdi["adicional"];
								?>
							</td>

							<td class="text-right"><?php echo number_format($datAdicional["unitario"],'2','.',',');?></td>
							<td class="text-right"><?php echo number_format($datAdicional["total"],'2','.',',');?></td>
							<td>
								<!-- ELIMINAR -->
	                            <a href="#" onclick="eliminarAdicional(<?php echo $datAdicional["adicionalId"]?>,<?php echo $datAdicional["cotizacionId"]?>);">
	                                <button class="btn btn-danger" title="Eliminar">
	                                    <i class="fa fa-trash-alt"></i>
	                                </button>
	                            </a>
							</td>
						</tr>
						<?php $totalAdicional = $totalAdicional + $datAdicional["total"]; } ?>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>SUB-TOTAL</strong></td>
							<td class="text-right"><strong><?php echo "$ ".number_format($totalAdicional,'2','.',',');?></strong></td>
							<td></td>
						</tr>
					</tbody>
				</table>

				<!-- TABLA PARA EL RESUMEN DE LA COTIZACIÓN -->
				 <h3>Resumen del costo de la cotización</h3><br>
				<table class="table">
					<thead>
						<tr style="color: white">
							<th>NO</th>
							<th class="text-right">CANT.</th>
							<th>ADICIONAL</th>
							<th class="text-right">C.UNIT</th>
							<th class="text-right">V.TOTAL</th>
							<th>ELIMINAR</th>
						</tr>
					</thead>

					<?php
						$selTotalSistema=mysqli_query($con,"
							SELECT round(SUM(cantidad*precio),2) as totalSistema
							FROM fac_cotizaciondetalle WHERE cotizacionId='$_REQUEST[cotizacionId]'");
						$datTotalSistema=mysqli_fetch_assoc($selTotalSistema);

						$selTotalAdicional=mysqli_query($con,"
							SELECT SUM(total) as totalAdicional
							FROM fac_cotadicional WHERE cotizacionId='$_REQUEST[cotizacionId]'");
						$datTotalAdicional=mysqli_fetch_assoc($selTotalAdicional);

						$totalCotizacion=$datTotalSistema["totalSistema"]+$datTotalAdicional["totalAdicional"];
					?>

					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>SUB-TOTAL</strong></td>
							<td class="text-right"><strong><?php echo "$ ".number_format($totalCotizacion,'2','.',',');?></strong></td>
							<td></td>
						</tr>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>MARGEN</strong></td>
							<?php $totalMargen=$totalCotizacion*0.8; ?>
							<td class="text-right"><strong><?php echo "$ ".number_format($totalMargen,'2','.',',');?></strong></td>
							<td></td>
						</tr>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>SUB-TOTAL + MARGEN</strong></td>
							<td class="text-right"><strong><?php echo "$ ".number_format(($totalMargen+$totalCotizacion),'2','.',',');?></strong></td>
							<td></td>
						</tr>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>I.V.A</strong></td>
							<td class="text-right"><strong><?php echo "$ ".number_format((($totalCotizacion+$totalMargen)*0.13),'2','.',',');?></strong></td>
							<td></td>
						</tr>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><strong>TOTAL + IVA</strong></td>
							<td class="text-right"><strong><?php echo "$ ".number_format((($totalCotizacion+$totalMargen)*1.13),'2','.',',');?></strong></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>