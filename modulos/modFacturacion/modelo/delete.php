<?php
	session_start();
	include("../../../lib/config/conect.php");
	$id=$_REQUEST["id"];

	switch ($id) {

		case 'DEL-CLIENTE':
			$selEncabezado=mysqli_query($con,"SELECT clienteId FROM fac_encabezado WHERE clienteId='$_REQUEST[clienteId]' LIMIT 1");
			$selCotizacion=mysqli_query($con,"SELECT clienteId FROM fac_cotizacion WHERE clienteId='$_REQUEST[clienteId]' LIMIT 1");

			if ($datEncabezado=mysqli_fetch_assoc($selEncabezado)){
				echo "2";
			} else if ($datCotizacion=mysqli_fetch_assoc($selCotizacion)){
				echo "2";
			} else {
				$delCliente=mysqli_query($con,"
					DELETE FROM fac_clientes
					WHERE clienteId='$_REQUEST[clienteId]'") or die ('FALLO DEL-CLIENTE: '.mysqli_error($con));
				echo "1";
			}
		break;

		case 'DEL-SISTEMA':
			$selSDetalle=mysqli_query($con,"SELECT sistemaId FROM fac_sistemadetalle WHERE sistemaId='$_REQUEST[sistemaId]' LIMIT 1");
			if ($datSDetalle=mysqli_fetch_assoc($selSDetalle)){
				echo "2";
			} else {
				$delSistema=mysqli_query($con,"
					DELETE FROM fac_sistema
					WHERE sistemaId='$_REQUEST[sistemaId]'") or die ('FALLO DEL-SISTEMA: '.mysqli_error($con));
				echo "1";
			}
		break;

		case 'DEL-SDETALLE':
			$delSDetalle=mysqli_query($con,"
				DELETE FROM fac_sistemadetalle
				WHERE sistemaDetalleId='$_REQUEST[sistemaDetalleId]'") or die ('FALLO DEL-SDETALLE: '.mysqli_error($con));
			echo "1";
		break;

		case 'DEL-CDETALLE':

			$delCostDet=mysqli_query($con,"
				DELETE FROM fac_costeodetalle
				WHERE cotizacionId='$_REQUEST[cotizacionId]' AND sistemaId='$_REQUEST[sistemaId]'") or die ('FALLO DEL-COSTDET: '.mysqli_error($con));

			$delCDetalle=mysqli_query($con,"
				DELETE FROM fac_cotizaciondetalle
				WHERE cotizacionDetalleId='$_REQUEST[cotizacionDetalleId]'") or die ('FALLO DEL-CDETALLE: '.mysqli_error($con));

			echo "1";
		break;

		

		case 'DEL-ADICIONAL':
			$delAdicional=mysqli_query($con,"
				DELETE FROM fac_cotadicional
				WHERE adicionalId='$_REQUEST[adicionalId]'") or die ('FALLO DEL-ADICIONAL: '.mysqli_error($con));
			echo "1";
		break;


		case 'DEL-COTIZACION-MANUAL':
			$selCotizacionManual=mysqli_query($con,"SELECT cotizacionManualId 
				FROM fac_cotizaciondetalle_manual 
				WHERE cotizacionManualId='$_REQUEST[cotizacionManualId]' LIMIT 1");
			
			if ($datSDetalle=mysqli_fetch_assoc($selCotizacionManual)){
				echo "2";
			} else {
				$delCotizacionManual=mysqli_query($con,"
					DELETE FROM fac_cotizacion_manual
					WHERE cotizacionManualId='$_REQUEST[cotizacionManualId]'") or die ('FALLO DEL-COTIZACION-MANUAL: '.mysqli_error($con));
				echo "1";
			}
		break;
		

		case 'DEL-CDETALLE-MANUAL':

			$delCDetalleManual=mysqli_query($con,"
				DELETE FROM fac_cotizaciondetalle_manual
				WHERE cotizacionDetalleId='$_REQUEST[cotizacionDetalleId]'") or die ('FALLO DEL-CDETALLE-MANUAL: '.mysqli_error($con));

			echo "1";
		break;

		default:
			echo "NO SE GENERO NINGUNA ACCION";
		break;
	}

?>