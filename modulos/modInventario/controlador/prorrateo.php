<?php
	session_start();
	include ("../../../lib/config/conect.php");
	$fechaHoy=date("Y-m-d H:i:s");

	$compraId=$_REQUEST["compraId"];
	$selCDetalle=mysqli_query($con,"
		SELECT compraId,productoId,cantidad,valorUnitario,retaceoEfectuado
		FROM inv_compradetalle
		WHERE compraId='$compraId'");

	while($datCDetalle=mysqli_fetch_assoc($selCDetalle)){

		if ($datCDetalle["retaceoEfectuado"]==0){

			$selExActual=mysqli_query($con,"
				SELECT exActual,costoPromedio
				FROM inv_producto
				WHERE productoId='$datCDetalle[productoId]' LIMIT 1");
			$datExActual=mysqli_fetch_assoc($selExActual);

			$unidadesAnteriores=$datExActual["exActual"];
			$costoAnterior=($datExActual["costoPromedio"]*$unidadesAnteriores);

			$unidadesNuevas=$datCDetalle["cantidad"];
			$costoNuevo=($datCDetalle["valorUnitario"]*$unidadesNuevas);

			$costoPromedio=($costoAnterior+$costoNuevo)/($unidadesAnteriores+$unidadesNuevas);
			$nuevaExActual=$unidadesAnteriores+$unidadesNuevas;

			$updProducto=mysqli_query($con,"
				UPDATE inv_producto
				SET exActual='$nuevaExActual',
					costoPromedio='$costoPromedio',
					usuarioMod='$_SESSION[usuario]',
					fechaMod='$fechaHoy'
				WHERE productoId='$datCDetalle[productoId]'") or die ('ERRO UPD-PROD: '.mysqli_error($con));

			$compraDetalle=mysqli_query($con,"
				UPDATE inv_compradetalle
				SET retaceoEfectuado='1'
				WHERE compraId='$datCDetalle[compraId]'") or die ('ERRO UPD-RETACEO: '.mysqli_error($con));

			mysqli_free_result($selExActual);
		}
	}

	mysqli_free_result($selCDetalle);
	mysqli_close($con);
	echo "1";
?>