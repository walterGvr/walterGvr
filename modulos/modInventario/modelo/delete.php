<?php
	session_start();
	include("../../../lib/config/conect.php");
	$id=$_REQUEST["id"];

	switch ($id) {
		case 'DEL-USUARIO':
			$delUsu=mysqli_query($con,"DELETE FROM co_usuarios WHERE usuarioId='$_REQUEST[usuarioId]'") or die ('ERROR DEL-USUARIO:'.mysqli_error($con));
			echo "1";
		break;

		case 'DEL-BODEGA':
			$selProducto=mysqli_query($con,"SELECT bodegaId FROM inv_producto WHERE bodegaId='$_REQUEST[bodegaId]' LIMIT 1");
			if ($datProducto=mysqli_fetch_assoc($selProducto)){
				echo "2";
			} else {
				$delBodega = mysqli_query($con,"DELETE FROM inv_bodega WHERE bodegaId='$_REQUEST[bodegaId]'") or die ('FALLO DEL-BODEGA: '.mysqli_error($con));
				echo "1";
			}
		break;

		case 'DEL-PROVEEDOR':
			$selMarca=mysqli_query($con,"SELECT proveedorId FROM inv_marcas WHERE proveedorId='$_REQUEST[proveedorId]' LIMIT 1");
			if ($datMarca=mysqli_fetch_assoc($selMarca)){
				echo "2";
			} else {
				$delProv=mysqli_query($con,"DELETE FROM inv_proveedores WHERE proveedorId='$_REQUEST[proveedorId]'") or die ('FALLO DEL-PROVEEDOR: '.mysqli_error($con));
				echo "1";
			}
		break;

		case 'DEL-MARCA':
			$selLinea=mysqli_query($con,"SELECT marcaId FROM inv_lineas WHERE marcaId='$_REQUEST[marcaId]' LIMIT 1");
			if ($datLinea=mysqli_fetch_assoc($selLinea)){
				echo "2";
			} else {
				$delMarca=mysqli_query($con,"DELETE FROM inv_marcas WHERE marcaId='$_REQUEST[marcaId]'") or die ('FALLO DEL-MARCA: '.mysqli_error($con));
				echo "1";
			}
		break;

		case 'DEL-LINEA':
			$selProd=mysqli_query($con,"SELECT lineaId FROM inv_producto WHERE lineaId='$_REQUEST[lineaId]' LIMIT 1");
			if ($datProd=mysqli_fetch_assoc($selProd)){
				echo "2";
			} else {
				$delLinea=mysqli_query($con,"DELETE FROM inv_lineas WHERE lineaId='$_REQUEST[lineaId]'") or die ('FALLO DEL-LINEA: '.mysqli_error($con));
				echo "1";
			}
		break;

		case 'DEL-PRODUCTO':
			$selProd1=mysqli_query($con,"SELECT productoId FROM inv_compradetalle WHERE productoId='$_REQUEST[productoId]' LIMIT 1");
			$selProd2=mysqli_query($con,"SELECT productoId FROM inv_retaceo WHERE productoId='$_REQUEST[productoId]' LIMIT 1");
			$selProd3=mysqli_query($con,"SELECT productoId FROM fac_detalle WHERE productoId='$_REQUEST[productoId]' LIMIT 1");
			if ($datProd1=mysqli_fetch_assoc($selProd1)){
				echo "2";
			} else if ($datProd2=mysqli_fetch_assoc($selProd2)){
				echo "2";
			} else if ($datProd3=mysqli_fetch_assoc($selProd3)){
				echo "2";
			} else {
				$delProducto=mysqli_query($con,"
					DELETE FROM inv_producto
					WHERE productoId='$_REQUEST[productoId]'") or die ('FALLO DEL-PRODUCTO: '.mysqli_error($con));
				echo "1";
			}
		break;

		case 'DEL-REGISTRO':
			$delRegistro=mysqli_query($con,"
				DELETE FROM inv_compradetalle
				WHERE compraDetalleId='$_REQUEST[compraDetalleId]'") or die ('ERROR DEL-REGISTRO:'.mysqli_error($con));

			echo "1"."¬".$_REQUEST["compraId"];
		break;

		case 'DEL-TRAMITE':
			$delTramite=mysqli_query($con,"
				DELETE FROM inv_tramites
				WHERE tramiteId='$_REQUEST[tramiteId]'") or die ('ERROR DEL-REGISTRO:'.mysqli_error($con));

			echo "1"."¬".$_REQUEST["compraId"];
		break;

		case 'DEL-PERMISO':
			$delPermiso=mysqli_query($con,"
				DELETE FROM co_permisos
				WHERE permisoId='$_REQUEST[permisoId]'") or die ('ERROR DEL-PERMISO:'.mysqli_error($con));

			echo "1"."¬".$_REQUEST["usuarioId"];
		break;



		default:
			echo "NO SE GENERO NINGUNA ACCION";
		break;
	}

?>