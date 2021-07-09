<?php
	$opcion=$_REQUEST["reporte"];
	$productoId=$_REQUEST["productoId"];

	switch ($opcion) {
		case 'repBarras':
			header ("Location: repBarras?productoId=$productoId");
		break;

		default:
			echo "NO SE GENERO NINGUNA OPCION";
		break;
	}

?>