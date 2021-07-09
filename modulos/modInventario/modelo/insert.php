<?php
	session_start();
	include("../../../lib/config/conect.php");
	$id=$_REQUEST["id"];
	$fechaHora=date("Y-m-d H:i:s");

	switch ($id) {
		case 'INS-USUARIO':
			$selUsuario=mysqli_query($con,"SELECT usuario FROM co_usuarios WHERE usuario='$_POST[usuario]' LIMIT 1");
			if ($datUsuario=mysqli_fetch_assoc($selUsuario)){
				echo "2";
			} else {
				$md5Clave=strtoupper(md5($_POST["clave"]));
				$insUsuario=mysqli_query($con,"
					INSERT INTO co_usuarios (nombres,apellidos,usuario,clave,estado,rolId)
					VALUES (
						'$_POST[nombres]',
						'$_POST[apellidos]',
						'$_POST[usuario]',
						'$md5Clave',
						'1',
						'$_POST[rolId]')") or die ('ERROR INS-USUARIO:'.mysqli_error($con));

				echo "1";
			}
		break;

		case 'INS-PERMISO':
			$selUsuario=mysqli_query($con,"SELECT usuarioId FROM co_permisos WHERE usuarioId='$_POST[usuarioId]' AND moduloId='$_POST[moduloId]'  LIMIT 1");
			if ($datUsuario=mysqli_fetch_assoc($selUsuario)){
				echo "2";
			} else {
				$insPermiso=mysqli_query($con,"INSERT INTO co_permisos (usuarioId,moduloId) VALUES ('$_POST[usuarioId]','$_POST[moduloId]')") or die ('ERROR INS-PERMISO:'.mysqli_error($con));
				echo "1";
			}
		break;

		case 'INS-BODEGA':
			$selBodega=mysqli_query($con,"SELECT bodega FROM inv_bodega WHERE bodega='$_POST[bodega]' LIMIT 1");
			$datBodega=mysqli_fetch_assoc($selBodega);

			if ($datBodega["bodega"]==$_POST["bodega"]){
				mysqli_free_result($selBodega);
				mysqli_close($con);
				echo "2";
			} else {
				$insBod=mysqli_query($con,"
					INSERT INTO inv_bodega (tipoBodega,bodega,direccion,telefono)
					VALUES ('$_POST[tipoBodega]','$_POST[bodega]','$_POST[direccion]','$_POST[telefono]')") or die ('ERROR INS-BODEGA: '.mysqli_error($con));
				mysqli_free_result($selBodega);
				mysqli_close($con);
				echo "1";
			}
		break;

		case 'INS-PROVEEDOR':
			$selProveedor=mysqli_query($con,"SELECT nombre FROM inv_proveedores WHERE nombre='$_POST[nombre]'");
			$datProveedor=mysqli_fetch_assoc($selProveedor);

			if ($datProveedor["nombre"]==$_POST["nombre"]){
				mysqli_free_result($selProveedor);
				mysqli_close($con);
				echo "2";
			} else {
				$insProv=mysqli_query($con,"
					INSERT INTO inv_proveedores (tipoProveedor,nombre,email,telefono,sitioWeb)
					VALUES ('$_POST[tipoProveedor]','$_POST[nombre]','$_POST[email]','$_POST[telefono]','$_POST[sitioWeb]')") or die ('ERRO INS-BODEGA: '.mysqli_error($con));
				mysqli_free_result($selProveedor);
				mysqli_close($con);
				echo "1";
			}
		break;
		case 'INS-PROVEEDOR-MDL':
			$selProveedor=mysqli_query($con,"SELECT nombre FROM inv_proveedores WHERE nombre='$_POST[mdl_add_nombre]'");
			$datProveedor=mysqli_fetch_assoc($selProveedor);

			if ($datProveedor["nombre"]==$_POST["mdl_add_nombre"]){
				mysqli_free_result($selProveedor);
				mysqli_close($con);
				echo "2";
			} else {
				$insProv=mysqli_query($con,"
					INSERT INTO inv_proveedores (tipoProveedor,nombre,email,telefono,sitioWeb)
					VALUES ('$_POST[mdl_add_tipoProveedor]','$_POST[mdl_add_nombre]','$_POST[mdl_add_email]','$_POST[mdl_add_telefono]','$_POST[mdl_add_sitioWeb]')") or die ('INS-PROVEEDOR-MDL: '.mysqli_error($con));
				
				$selId=mysqli_query($con,"SELECT MAX(proveedorId) as proveedorId FROM inv_proveedores");
				$datId=mysqli_fetch_assoc($selId);
				$proveedorId = $datId['proveedorId'];
				
				/*mysqli_free_result($selProveedor);
				mysqli_free_result($selId);				
				mysqli_close($con);*/
				echo $proveedorId;
			}
		break;

		case 'INS-MARCA':
			$selMarca=mysqli_query($con,"SELECT marca FROM inv_marcas WHERE marca='$_POST[marca]' AND proveedorId='$_POST[proveedorId]' LIMIT 1");
			$datMarca=mysqli_fetch_assoc($selMarca);

			if ($datMarca["marca"]==$_POST["marca"]){
				mysqli_free_result($selMarca);
				mysqli_close($con);
				echo "2";
			} else {
				$insMarca=mysqli_query($con,"
					INSERT INTO inv_marcas (proveedorId,marca)
					VALUES ('$_POST[proveedorId]','$_POST[marca]')") or die ('ERRO INS-MARCA: '.mysqli_error($con));
				mysqli_free_result($selMarca);
				mysqli_close($con);
				echo "1";
			}

		break;
		case 'INS-MARCA-MDL':
			$selMarca=mysqli_query($con,"SELECT marca FROM inv_marcas WHERE marca='$_POST[mdl_add_marca]' AND proveedorId='$_POST[mdl_add_proveedorId]' LIMIT 1");
			$datMarca=mysqli_fetch_assoc($selMarca);

			if ($datMarca["marca"]==$_POST["mdl_add_marca"]){
				mysqli_free_result($selMarca);
				mysqli_close($con);
				echo "2";
			} else {
				$insMarca=mysqli_query($con,"
				INSERT INTO inv_marcas (proveedorId,marca)
				VALUES ('$_POST[mdl_add_proveedorId]','$_POST[mdl_add_marca]')") or die ('ERRO INS-MARCA-MDL: '.mysqli_error($con));
			
				$selId=mysqli_query($con,"SELECT MAX(marcaId) as marcaId FROM inv_marcas");
				$datId=mysqli_fetch_assoc($selId);
				$marcaId = $datId['marcaId'];

				mysqli_free_result($selId);
				mysqli_close($con);
				echo $marcaId;
			}

		break;

		case 'INS-LINEA':
			$selLinea=mysqli_query($con,"SELECT linea FROM inv_lineas WHERE linea='$_POST[linea]' AND marcaId='$_POST[marcaId]'");
			$datLinea=mysqli_fetch_assoc($selLinea);

			if ($datLinea["linea"]==$_POST["linea"]){
				mysqli_free_result($selLinea);
				mysqli_close($con);
				echo "2";
			} else {
				$insLinea=mysqli_query($con,"
					INSERT INTO inv_lineas (marcaId,linea)
					VALUES ('$_POST[marcaId]','$_POST[linea]')") or die ('ERRO INS-LINEA: '.mysqli_error($con));
				mysqli_free_result($selLinea);
				mysqli_close($con);
				echo "1";
			}
		break;
		case 'INS-LINEA-MDL':
			$selLinea=mysqli_query($con,"SELECT linea FROM inv_lineas WHERE linea='$_POST[mdl_add_linea]' AND marcaId='$_POST[mdl_add_marcaId]' LIMIT 1");
			$datLinea=mysqli_fetch_assoc($selLinea);

			if ($datLinea["linea"]==$_POST["mdl_add_linea"]){
				mysqli_free_result($selLinea);
				mysqli_close($con);
				echo "2";
			} else {
				$insLinea=mysqli_query($con,"
				INSERT INTO inv_lineas (marcaId,linea)
				VALUES ('$_POST[mdl_add_marcaId]','$_POST[mdl_add_linea]')") or die ('ERRO INS-LINEA-MDL: '.mysqli_error($con));
				
				$selId=mysqli_query($con,"SELECT MAX(lineaId) as lineaId FROM inv_lineas");
				$datId=mysqli_fetch_assoc($selId);
				$lineaId = $datId['lineaId'];
				
				mysqli_free_result($selLinea);
				mysqli_close($con);
				echo $lineaId;
			}
		break;

		case 'INS-PRODUCTO':
			$selProd=mysqli_query($con,"
				SELECT producto FROM inv_producto
				WHERE producto='$_POST[producto]' AND lineaId='$_POST[lineaId]' AND color='$_POST[color]'");
			$datProd=mysqli_fetch_assoc($selProd);

			if ($datProd["producto"]==$_POST["producto"]){
				mysqli_free_result($selProd);
				mysqli_close($con);
				echo "2";
			} else {
				$insProducto=mysqli_query($con,"
				INSERT INTO inv_producto (lineaId,producto,color,exMin,exMax,exActual,ubicacion,costoPromedio,bodegaId,usuarioAdd,fechaAdd)
				VALUES ('$_POST[lineaId]','$_POST[producto]','$_POST[color]','$_POST[exMin]','$_POST[exMax]','$_POST[exActual]','$_POST[ubicacion]',
				'$_POST[costoPromedio]','$_POST[bodegaId]','$_SESSION[usuario]','$fechaHora')") or die ('ERROR INS-PRODUCTO: '.mysqli_error($con));

				$selMaxId=mysqli_query($con,"SELECT MAX(productoId) as productoId FROM inv_producto");
				$datMaxId=mysqli_fetch_assoc($selMaxId);
				$productoId=$datMaxId["productoId"];

				//SELECCIONAR LOS DATOS DEL PRODUCTO
				$selDatos=mysqli_query($con,"SELECT proveedorId,marcaId,lineaId FROM vista_lineas WHERE lineaId='$_POST[lineaId]'");
				$datDatos=mysqli_fetch_assoc($selDatos);

				//FORMAR CODIGO
				$codigo=$datDatos["proveedorId"].$datDatos["marcaId"].$datDatos["lineaId"].$productoId;

				//ACTUALIZAR EL CODIGO DEL PRODUCTO
				$updProducto=mysqli_query($con,"
					UPDATE inv_producto
					SET codigo='$codigo'
					WHERE productoId='$productoId'") or die('ERROR UPDPRODUCTO: '.mysqli_error($con));
				
				//HACER EL INSERT EN EL PRECIO DEL PRODUCTO
				$insPrecio=mysqli_query($con,"INSERT INTO fac_precios (productoId,precio) VALUES ('$productoId','$_POST[precio]')") or die ('ERRO INS-PRECIO: '.mysqli_error($con));

				mysqli_free_result($selProd);
				mysqli_free_result($selMaxId);
				mysqli_free_result($selDatos);
				mysqli_close($con);
				echo "1";
			}
		break;

		case 'INS-NACIONAL':
			$insCompra=mysqli_query($con,"
				INSERT INTO inv_compra (fechaCompra,proveedorId,numeroFactura,descripcion,bodegaId,tipo)
				VALUES ('$_POST[fechaCompra]','$_POST[proveedorId]','$_POST[numeroFactura]','$_POST[descripcion]','$_POST[bodegaId]','N')")
			or die ('ERRO INS-NACIONAL: '.mysqli_error($con));

			$selMaxIdCompra=mysqli_query($con,"SELECT MAX(compraId) as compraId FROM inv_compra");
			$datMaxIdCompra=mysqli_fetch_assoc($selMaxIdCompra);

			mysqli_free_result($selMaxIdCompra);
			mysqli_close($con);

			echo "1"."¬".$datMaxIdCompra["compraId"];
		break;

		case 'INS-INTERNACIONAL':
			$insCompra=mysqli_query($con,"
				INSERT INTO inv_compra (fechaCompra,proveedorId,numeroFactura,descripcion,bodegaId,tipo)
				VALUES ('$_POST[fechaCompra]','$_POST[proveedorId]','$_POST[numeroFactura]','$_POST[descripcion]','$_POST[bodegaId]','I')")
			or die ('ERRO INS-NACIONAL: '.mysqli_error($con));

			$selMaxIdCompra=mysqli_query($con,"SELECT MAX(compraId) as compraId FROM inv_compra");
			$datMaxIdCompra=mysqli_fetch_assoc($selMaxIdCompra);

			mysqli_free_result($selMaxIdCompra);
			mysqli_close($con);

			echo "1"."¬".$datMaxIdCompra["compraId"];
		break;

		case 'INS-DETALLE':
			$insCompraDet=mysqli_query($con,"
				INSERT INTO inv_compradetalle (compraId,productoId,cantidad,valorUnitario,total,retaceoEfectuado)
				VALUES ('$_POST[compraId]','$_POST[productoId]','$_POST[cantidad]','$_POST[valorUnitario]','$_POST[total]','0')") or die ('ERRO INS-COMPRADET: '.mysqli_error($con));

			echo "1"."¬".$_POST["compraId"];
		break;

		case 'INS-TRAMITE':
			$insTranmite=mysqli_query($con,"INSERT INTO inv_tramites (compraId,tramite,cantidad,valorUnitario,total,retaceoEfectuado)
			VALUES ('$_POST[compraId]','$_POST[tramite]','$_POST[cantidadTramite]','$_POST[valorUnitarioTramite]','$_POST[totalTramite]','0')") or die ('ERRO INS-TRAMITE: '.mysqli_error($con));

			mysqli_close($con);
			echo "1"."¬".$_POST["compraId"];
		break;



		default:
			echo "NO SE GENERO NINGUNA ACCION";
		break;
	}



?>