<?php
	session_start();
	include("../../../lib/config/conect.php");
	$id=$_REQUEST["id"];
	$fechaHora=date("Y-m-d H:i:s");

	switch ($id) {
		case 'UPD-USUARIO':
			$selUsuario=mysqli_query($con,"SELECT clave FROM co_usuarios WHERE usuario='$_POST[usuario]' LIMIT 1");
			$datUsuario=mysqli_fetch_assoc($selUsuario);

			if ($datUsuario["clave"]==$_POST["clave"]){
				$updUsuario=mysqli_query($con,"
				UPDATE co_usuarios
				SET	nombres='$_POST[nombres]',
					apellidos='$_POST[apellidos]',
					usuario='$_POST[usuario]',
					estado='$_POST[estado]',
					rolId='$_POST[rolId]'
				WHERE usuarioId='$_POST[usuarioId]'") or die ('ERROR UPD-USUARIO1: '.mysqli_error($con));
				echo "1";
			} else {
				$md5Clave=strtoupper(md5($_POST["clave"]));
				$updUsuario=mysqli_query($con,"
				UPDATE co_usuarios
				SET	nombres='$_POST[nombres]',
					apellidos='$_POST[apellidos]',
					usuario='$_POST[usuario]',
					clave='$md5Clave',
					estado='$_POST[estado]',
					rolId='$_POST[rolId]'
				WHERE usuarioId='$_POST[usuarioId]'") or die ('ERROR UPD-USUARIO2: '.mysqli_error($con));
				echo "1";
			}
		break;

		case 'UPD-BODEGA':
			$updBodega=mysqli_query($con,"
			UPDATE inv_bodega
			SET tipoBodega='$_POST[tipoBodega]',
				bodega='$_POST[bodega]',
				direccion='$_POST[direccion]',
				telefono='$_POST[telefono]'
			WHERE bodegaId='$_POST[bodegaId]'") or die ('ERROR UPD-BODEGA: '.mysqli_error($con));

			mysqli_close($con);
			echo "1";
		break;

		case 'UPD-PROVEEDOR':
			$updProveedor=mysqli_query($con,"
				UPDATE inv_proveedores
				SET tipoProveedor='$_POST[tipoProveedor]',
					nombre='$_POST[nombre]',
					email='$_POST[email]',
					telefono='$_POST[telefono]',
					sitioWeb='$_POST[sitioWeb]'
				WHERE proveedorId='$_POST[proveedorId]'") or die ('ERROR UPD-PROVEEDOR: '.mysqli_error($con));
			mysqli_close($con);
			echo "1";
		break;
		case 'UPD-PROVEEDOR-MDL':
			$updProveedor=mysqli_query($con,"
				UPDATE inv_proveedores
				SET tipoProveedor='$_POST[mdl_edit_tipoProveedor]',
					nombre='$_POST[mdl_edit_nombre]',
					email='$_POST[mdl_edit_email]',
					telefono='$_POST[mdl_edit_telefono]',
					sitioWeb='$_POST[mdl_edit_sitioWeb]'
				WHERE proveedorId='$_POST[mdl_edit_proveedorId]'") or die ('ERROR UPD-PROVEEDOR-MDL: '.mysqli_error($con));
			mysqli_close($con);
			echo $_POST["mdl_edit_proveedorId"];
		break;

		case 'UPD-MARCA':
			$updMarca=mysqli_query($con,"
				UPDATE inv_marcas
				SET proveedorId='$_POST[proveedorId]',
					marca='$_POST[marca]'
				WHERE marcaId='$_POST[marcaId]'") or die ('ERROR UPD-MARCA: '.mysqli_error($con));
			mysqli_close($con);
			echo "1";
		break;
		case 'UPD-MARCA-MDL':
			$updMarca=mysqli_query($con,"
				UPDATE inv_marcas
				SET proveedorId='$_POST[mdl_edit_proveedorId]',
					marca='$_POST[mdl_edit_marca]'
				WHERE marcaId='$_POST[mdl_edit_marcaId]'") or die ('ERROR UPD-MARCA-MDL: '.mysqli_error($con));
			mysqli_close($con);
			echo $_POST["mdl_edit_marcaId"];
		break;


		case 'UPD-LINEA':
			$updLinea=mysqli_query($con,"
				UPDATE inv_lineas
				SET marcaId='$_POST[marcaId]',
					linea='$_POST[linea]'
				WHERE lineaId='$_POST[lineaId]'") or die ('ERROR UPD-LINEA: '.mysqli_error($con));
			mysqli_close($con);
			echo "1";
		break;
		case 'UPD-LINEA-MDL':
			$updLinea=mysqli_query($con,"
				UPDATE inv_lineas
				SET marcaId='$_POST[mdl_edit_marcaId]',
					linea='$_POST[mdl_edit_linea]'
				WHERE lineaId='$_POST[mdl_edit_lineaId]'") or die ('ERROR UPD-LINEA-MDL: '.mysqli_error($con));
			mysqli_close($con);
			echo $_POST["mdl_edit_lineaId"];
		break;

		case 'UPD-PRODUCTO':
			$updProd=mysqli_query($con,"
			UPDATE inv_producto
			SET lineaId='$_POST[lineaId]',producto='$_POST[producto]',color='$_POST[color]',exMin='$_POST[exMin]',
				exMax='$_POST[exMax]',exActual='$_POST[exActual]',ubicacion='$_POST[ubicacion]',costoPromedio='$_POST[costoPromedio]',
				usuarioMod='$_SESSION[usuario]',fechaMod='$fechaHora'
			WHERE productoId='$_POST[productoId]'") or die ('ERROR UPD-PRODUCTO: '.mysqli_error($con));

			$selPrecio=mysqli_query($con,"SELECT * FROM fac_precios WHERE productoId='$_POST[productoId]' LIMIT 1");
			if ($datPrecio=mysqli_fetch_assoc($selPrecio)){
				$updPrecio=mysqli_query($con,"UPDATE fac_precios SET precio='$_POST[precio]' WHERE productoId='$_POST[productoId]'");
			} else {
				$insPrecio=mysqli_query($con,"INSERT INTO fac_precios (productoId,precio) VALUES ('$_POST[productoId]','$_POST[precio]')") or die ('ERROR INS-PRECIO '.mysqli_error($con));
			}	
			
			mysqli_close($con);
			echo "1";
		break;

		case 'UPD-ENCABEZADO':
			$updCompra=mysqli_query($con,"
				UPDATE inv_compra
				SET fechaCompra='$_POST[fechaCompra]',
					proveedorId='$_POST[proveedorId]',
					numeroFactura='$_POST[numeroFactura]',
					bodegaId='$_POST[bodegaId]',
					descripcion='$_POST[descripcion]'
				WHERE compraId='$_POST[compraId]'
			") or die ('ERROR UPD-ENCABEZADO: '.mysqli_error($con));

			echo "1"."¬".$_POST["compraId"];
		break;

		case 'UPD-ENCABEZADOINTER':
			$updCompra=mysqli_query($con,"
				UPDATE inv_compra
				SET fechaCompra='$_POST[fechaCompra]',
					proveedorId='$_POST[proveedorId]',
					numeroFactura='$_POST[numeroFactura]',
					bodegaId='$_POST[bodegaId]',
					descripcion='$_POST[descripcion]'
				WHERE compraId='$_POST[compraId]'
			") or die ('ERROR UPD-ENCABEZADO: '.mysqli_error($con));

			echo "1"."¬".$_POST["compraId"];
		break;

		default:
			echo "NO SE GENERO NINGUNA ACCION";
		break;
	}

?>