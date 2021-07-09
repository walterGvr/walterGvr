<?php
	session_start();
	include("../../../lib/config/conect.php");
	$id=$_REQUEST["id"];
	$fechaHora=date("Y-m-d H:i:s");

	switch ($id) {
		case 'UPD-CLIENTE':
			$updCliente=mysqli_query($con,"
			UPDATE fac_clientes
			SET nombres='$_POST[nombres]',apellidos='$_POST[apellidos]',tipoClienteId='$_POST[tipoClienteId]',
				tipoPersona='$_POST[tipoPersona]',tipoContribuyente='$_POST[tipoContribuyente]',NRC='$_POST[NRC]',giro='$_POST[giro]',
				usuarioMod='$_SESSION[usuario]',fechaMod='$fechaHora'
			WHERE clienteId='$_POST[clienteId]'") or die ('ERROR UPD-CLIENTE: '.mysqli_error($con));

			mysqli_close($con);
			echo "1";
		break;

		case 'UPD-PRECIO':
			$updPrecio=mysqli_query($con,"
			UPDATE fac_precios SET productoId='$_POST[productoId]',precio='$_POST[precio]'
			WHERE precioId='$_POST[precioId]'") or die ('ERROR UPD-PRECIOS: '.mysqli_error($con));

			mysqli_close($con);
			echo "1";
		break;

		case 'UPD-SISTEMA':
			$updSistema=mysqli_query($con,"
			UPDATE fac_sistema SET nombreSistema='$_POST[nombreSistema]'
			WHERE sistemaId='$_POST[sistemaId]'") or die ('ERROR UPD-SISTEMA: '.mysqli_error($con));

			mysqli_close($con);
			echo "1";
		break;

		case 'UPD-TIPOCLIENTE':
			$updTipoCliente=mysqli_query($con,"
			UPDATE fac_tipocliente SET descuento='$_POST[descuento]'
			WHERE tipoClienteId='$_POST[tipoClienteId]'") or die ('ERROR UPD-TIPOCLIENTE: '.mysqli_error($con));

			mysqli_close($con);
			echo "1";
		break;

		case 'UPD-COTIZACION':
			$updSistema=mysqli_query($con,"
			UPDATE fac_cotizacion
				SET clienteId='$_POST[clienteId]',
					fecha='$_POST[fecha]',
					lugarEntrega='$_POST[lugarEntrega]',
					tiempoEntrega='$_POST[tiempoEntrega]',
					garantia='$_POST[garantia]',
					validez='$_POST[validez]',
					condicionesPago='$_POST[condicionesPago]',
					atencionA='$_POST[atencionA]',
					email='$_POST[email]',
					telefono='$_POST[telefono]',
					usuarioMod='$_SESSION[usuario]',
					fechaMod='$fechaHora'
			WHERE cotizacionId='$_POST[cotizacionId]'") or die ('ERROR UPD-COTIZACION: '.mysqli_error($con));

			mysqli_close($con);
			echo "1";
		break;

		case 'UPD-COTIZACION-MANUAL':
			$updSistema=mysqli_query($con,"
			UPDATE fac_cotizacion_manual
				SET clienteId='$_POST[clienteId]',
					fecha='$_POST[fecha]',
					lugarEntrega='$_POST[lugarEntrega]',
					tiempoEntrega='$_POST[tiempoEntrega]',
					garantia='$_POST[garantia]',
					validez='$_POST[validez]',
					condicionesPago='$_POST[condicionesPago]',
					atencionA='$_POST[atencionA]',
					email='$_POST[email]',
					telefono='$_POST[telefono]',
					descripcion='$_POST[descripcion]',
					usuarioMod='$_SESSION[usuario]',
					fechaMod='$fechaHora'
			WHERE cotizacionManualId='$_POST[cotizacionManualId]'") or die ('ERROR UPD-COTIZACION-MANUAL: '.mysqli_error($con));

			mysqli_close($con);
			echo "1";
		break;

		default:
			echo "NO SE GENERO NINGUNA ACCION";
		break;
	}

?>