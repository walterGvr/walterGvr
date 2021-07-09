<?php
	session_start();
	$rqModulo = $_REQUEST["rqModulo"];

	switch ($rqModulo) {
		case 'modInventario':
			header('Location: ../../modulos/modInventario/vista/principal/app');
		break;

		case 'modFacturacion':
			header('Location: ../../modulos/modFacturacion/vista/principal/app');
		break;

		case 'modContabilidad':
			header('Location: ../../modulos/modContabilidad/index#');
		break;

		default:
			echo "NO SE GENERO NINGUNA ACCION";
		break;
	}


?>