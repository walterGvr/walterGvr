<?php
	session_start();
	include("../../../lib/config/conect.php");
	$id=$_REQUEST["id"];
	$fechaHora=date("Y-m-d H:i:s");

	switch ($id) {
		case 'INS-CLIENTE':
			$selCliente=mysqli_query($con,"SELECT nombres,apellidos,tipoClienteId FROM fac_clientes WHERE nombres='$_POST[nombres]' AND apellidos='$_POST[apellidos]' AND tipoClienteId='$_POST[tipoClienteId]' LIMIT 1");
			$datCliente=mysqli_fetch_assoc($selCliente);

			if ($datCliente["nombres"]==$_POST["nombres"] and $datCliente["apellidos"]==$_POST["apellidos"] and $datCliente["tipoClienteId"]==$_POST["tipoClienteId"]){
				mysqli_free_result($selCliente);
				mysqli_close($con);
				echo "2";
			} else {
				$insCliente=mysqli_query($con,"
					INSERT INTO fac_clientes (nombres,apellidos,tipoClienteId,tipoPersona,tipoContribuyente,NRC,giro,usuarioAdd,fechaAdd)
					VALUES ('$_POST[nombres]','$_POST[apellidos]','$_POST[tipoClienteId]',
							'$_POST[tipoPersona]','$_POST[tipoContribuyente]','$_POST[NRC]',
							'$_POST[giro]','$_SESSION[usuario]','$fechaHora')") or die ('ERRO INS-CLIENTE: '.mysqli_error($con));
				mysqli_free_result($selCliente);
				mysqli_close($con);
				echo "1";
			}
		break;

		case 'INS-PRECIO':
			$selPrecio=mysqli_query($con,"SELECT precio FROM fac_precios WHERE productoId='$_POST[productoId]' LIMIT 1");
			if ($datPrecio=mysqli_fetch_assoc($selPrecio)){
				mysqli_free_result($selPrecio);
				mysqli_close($con);
				echo "2";
			} else {
				$insPrecio=mysqli_query($con,"
					INSERT INTO fac_precios (productoId,precio)
					VALUES ('$_POST[productoId]','$_POST[precio]')") or die ('ERRO INS-PRECIO: '.mysqli_error($con));
				mysqli_free_result($selPrecio);
				mysqli_close($con);
				echo "1";
			}
		break;

		case 'INS-SISTEMA':
			$selSistema=mysqli_query($con,"SELECT nombreSistema FROM fac_sistema WHERE nombreSistema='$_POST[nombreSistema]' LIMIT 1");
			if ($datSistema=mysqli_fetch_assoc($selSistema)){
				mysqli_free_result($selSistema);
				mysqli_close($con);
				echo "2";
			} else {
				$insSistema=mysqli_query($con,"
					INSERT INTO fac_sistema (nombreSistema,usuarioAdd,fechaAdd)
					VALUES ('$_POST[nombreSistema]','$_SESSION[usuario]','$fechaHora')") or die ('ERRO INS-SISTEMA: '.mysqli_error($con));

				$selMaxIdSistema=mysqli_query($con,"SELECT MAX(sistemaId) as sistemaId FROM fac_sistema");
				$datMaxIdSistema=mysqli_fetch_assoc($selMaxIdSistema);

				mysqli_free_result($selMaxIdSistema);
				mysqli_close($con);

				echo "1"."¬".$datMaxIdSistema["sistemaId"];
			}
		break;

		case 'INS-SDETALLE':
			$selSDetalle=mysqli_query($con,"
				SELECT precioId
				FROM fac_sistemadetalle
				WHERE precioId='$_POST[precioId]' AND sistemaId='$_POST[sistemaId]' LIMIT 1");

			if ($datSDetelle=mysqli_fetch_assoc($selSDetalle)){
				mysqli_free_result($selSDetalle);
				mysqli_close($con);
				echo "2";
			} else {

				$data=explode("¬",$_POST["precioId"]);
				$precioId=$data[0];
				$precio=$data[1];

				$insSDetalle=mysqli_query($con,"
					INSERT INTO fac_sistemadetalle (sistemaId,cantidad,precioId,precio)
					VALUES ('$_POST[sistemaId]','$_POST[cantidad]','$precioId','$precio')") or die ('ERRO INS-SDETALLE: '.mysqli_error($con));


				mysqli_close($con);
				echo "1"."¬".$_POST["sistemaId"];
			}
		break;

		case 'INS-COTIZACION':

			#Seleccionar el correlativo actual
			$selCorr=mysqli_query($con,"SELECT MAX(correlativo) as correlativo FROM fac_cotizacion");
			if ($datCorr=mysqli_fetch_assoc($selCorr)){
				$correlativo=$datCorr["correlativo"]+1;
			} else {
				$correlativo="1";
			}

			#Obtener el año
			$data=explode("-",$_POST["fecha"]);
			$anioOriginal=$data[0];
			$anio=substr($anioOriginal, -2);

			#Formar el codigo
			$valor=str_pad($correlativo, 4, "0", STR_PAD_LEFT);
			$numCotizacion=$valor."_".$anio;

			$insCotizacion=mysqli_query($con,"
				INSERT INTO fac_cotizacion (
					anio,
					correlativo,
					numCotizacion,
					clienteId,
					fecha,
					lugarEntrega,
					tiempoEntrega,
					garantia,
					validez,
					condicionesPago,
					atencionA,
					email,
					telefono,
					estado,
					usuarioAdd,
					fechaAdd
				)
				VALUES (
					'$anio',
					'$correlativo',
					'$numCotizacion',
					'$_POST[clienteId]',
					'$_POST[fecha]',
					'$_POST[lugarEntrega]',
					'$_POST[tiempoEntrega]',
					'$_POST[garantia]',
					'$_POST[validez]',
					'$_POST[condicionesPago]',
					'$_POST[atencionA]',
					'$_POST[email]',
					'$_POST[telefono]',
					'0',
					'$_SESSION[usuario]',
					'$fechaHora'
				)
			") or die ("ERROR INS-COTIZACION ".mysqli_error($con));

			$selMaxIdCotizacion=mysqli_query($con,"SELECT MAX(cotizacionId) as cotizacionId FROM fac_cotizacion");
			$datMaxIdCotizacion=mysqli_fetch_assoc($selMaxIdCotizacion);

			mysqli_free_result($selMaxIdCotizacion);
			mysqli_close($con);

			echo "1"."¬".$datMaxIdCotizacion["cotizacionId"];
		break;

		case 'INS-CDETALLE':
			$unidadMedida="ML";
			$cotizacionId=$_POST["cotizacionId"];
			$sistemaId=$_POST["sistemaId"];

			$selCDetalle=mysqli_query($con,"
				SELECT sistemaId
				FROM fac_cotizaciondetalle
				WHERE sistemaId='$sistemaId' AND cotizacionId='$cotizacionId' LIMIT 1");

			if ($datCDetalle=mysqli_fetch_assoc($selCDetalle)){
				mysqli_free_result($selCDetalle);
				mysqli_close($con);
				echo "2";

			} else {
				
				$totalCosteo=0;
				$valorDivision=1.4;
				$ancho=$_POST["ancho"];

				$segmentos=$ancho/$valorDivision;				
				$varlorAproximado=(intval($segmentos))+2; // Valor aproximado + 1

				#Seleccionar los datos del SistemaDetalle
				$selSDetalle=mysqli_query($con,"SELECT * FROM vista_sistema_detalle WHERE sistemaId='$sistemaId'");
				while($datSDetelle=mysqli_fetch_assoc($selSDetalle)){					
					
					$sistemaId=$datSDetelle["sistemaId"];
					$productoId=$datSDetelle["productoId"];
					
					switch($productoId){
						case '5': // Flanger
							$cantidad=$varlorAproximado;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-5: '.mysqli_error($con));
						break;

						case '7': // Tapon cargador
							$cantidad=$varlorAproximado;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-7: '.mysqli_error($con));
						break;

						case '16': // Conectores
							$cantidad=$varlorAproximado*3;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-16: '.mysqli_error($con));
						break;

						case '28': // Conectores de esquina
							$cantidad=$_POST["esquinas"]*3;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-28: '.mysqli_error($con));
						break;


						case '6': // Tapon
							$cantidad=$_POST["cantidad"]*2;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-6: '.mysqli_error($con));
						break;


						case '20': // Tubo
							$tuboHorizontal=$ancho/6;
							$tuboVertical=($varlorAproximado*0.9)/6;
							$totTubo=$tuboHorizontal+$tuboVertical;
							$totalTubo=(intval($totTubo))+1;

							$cantidad=$totalTubo;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-20: '.mysqli_error($con));
						break;


						case '10': // Pernos
							$cantidad=$varlorAproximado*3;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-10: '.mysqli_error($con));
						break;


						case '9': // Tornillos
							$cantidad=$varlorAproximado*2;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-9: '.mysqli_error($con));
						break;



						case '29': // Soldadura
							$cantidad=$varlorAproximado*5;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-29: '.mysqli_error($con));
						break;


						case '30': // Instalación
							$cantidad=$ancho;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-30: '.mysqli_error($con));
						break;


						case '11': // Sika

							$cantidad=$varlorAproximado;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-11: '.mysqli_error($con));
						break;


						case '15': // Varilla
							
							$tuboHorizontal=$ancho/6;
							$totalVarilla=$tuboHorizontal*3;

							$cantidad=(intval($totalVarilla))+1;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-15: '.mysqli_error($con));
						break;


						case '13': // Codo Articulado
							
							$cantidad=$_POST["descansos"]*2;
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-13: '.mysqli_error($con));
						break;


						case '25': // Codo Articulado
							
							$cantidad=$_POST["esquinas"];
							$unitario=$datSDetelle["precio"];
							$total=$cantidad*$unitario;
							
							$insCostDetalle=mysqli_query($con,"
								INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
								VALUES ('$cotizacionId','$sistemaId','$cantidad','$productoId','$datSDetelle[precio]','$total')
							") or die ('ERRO INS-CASE-25: '.mysqli_error($con));
						break;

					}					
				}

				#Recordar hacer un consulta que me traiga el valor total del costeo
				$selTotalCotizacion=mysqli_query($con,"SELECT SUM(total) as costoTotal FROM fac_costeodetalle WHERE cotizacionId='$_POST[cotizacionId]'");
				$datTotalCotizacion=mysqli_fetch_assoc($selTotalCotizacion);
				$totalCosteo=$datTotalCotizacion["costoTotal"];
				
				
				$insCDetalle=mysqli_query($con,"
					INSERT INTO fac_cotizaciondetalle (cotizacionId,cantidad,sistemaId,precio,unidadMedida,ancho)
					VALUES ('$cotizacionId','$_POST[cantidad]','$sistemaId','$totalCosteo','$_POST[unidadMedida]','$_POST[ancho]')") or die ('ERRO INS-SDETALLE: '.mysqli_error($con));


				mysqli_close($con);
				echo "1"."¬".$cotizacionId;
			}
		break;

		case 'INS-ADICIONAL':

			$selFAdicional=mysqli_query($con,"
				SELECT adicionalId FROM fac_cotadicional
				WHERE adicionalId='$_POST[adicionalId]' AND cotizacionId='$_POST[cotizacionId]' LIMIT 1");

			if ($datFAdicional=mysqli_fetch_assoc($selFAdicional)){

				mysqli_free_result($selFAdicional);
				mysqli_close($con);
				echo "2";

			} else {

				$insAdicional=mysqli_query($con,"
					INSERT INTO fac_cotadicional (cotizacionId,cantidad,adicionalId,unitario,total)
					VALUES ('$_POST[cotizacionId]','$_POST[adiCantidad]','$_POST[adicionalId]','$_POST[unitario]','$_POST[total]')") or die ('ERRO INS-ADICIONAL: '.mysqli_error($con));

				mysqli_free_result($selFAdicional);
				mysqli_close($con);
				echo "1"."¬".$_POST["cotizacionId"];
			}
		break;



		case 'INS-COTIZACION-MANUAL':

			#Seleccionar el correlativo actual
			$selCorr=mysqli_query($con,"SELECT MAX(correlativo) as correlativo FROM fac_cotizacion_manual");
			if ($datCorr=mysqli_fetch_assoc($selCorr)){
				$correlativo=$datCorr["correlativo"]+1;
			} else {
				$correlativo="1";
			}

			#Obtener el año
			$data=explode("-",$_POST["fecha"]);
			$anioOriginal=$data[0];
			$anio=substr($anioOriginal, -2);

			#Formar el codigo
			$valor=str_pad($correlativo, 4, "0", STR_PAD_LEFT);
			$numCotizacion="M-".$valor."-".$anio;

			$insCotizacion=mysqli_query($con,"
				INSERT INTO fac_cotizacion_manual (
					anio,
					correlativo,
					numCotizacion,
					clienteId,
					fecha,
					lugarEntrega,
					tiempoEntrega,
					garantia,
					validez,
					condicionesPago,
					atencionA,
					email,
					telefono,
					descripcion,
					estado,
					usuarioAdd,
					fechaAdd
				)
				VALUES (
					'$anio',
					'$correlativo',
					'$numCotizacion',
					'$_POST[clienteId]',
					'$_POST[fecha]',
					'$_POST[lugarEntrega]',
					'$_POST[tiempoEntrega]',
					'$_POST[garantia]',
					'$_POST[validez]',
					'$_POST[condicionesPago]',
					'$_POST[atencionA]',
					'$_POST[email]',
					'$_POST[telefono]',
					'$_POST[descripcion]',
					'0',
					'$_SESSION[usuario]',
					'$fechaHora'
				)
			") or die ("ERROR INS-COTIZACION-MANUAL".mysqli_error($con));

			$selMaxIdCotizacion=mysqli_query($con,"SELECT MAX(cotizacionManualId) as cotizacionManualId FROM fac_cotizacion_manual");
			$datMaxIdCotizacion=mysqli_fetch_assoc($selMaxIdCotizacion);

			mysqli_free_result($selMaxIdCotizacion);
			mysqli_close($con);

			echo "1"."¬".$datMaxIdCotizacion["cotizacionManualId"];
		break;


		case 'INS-CDETALLE-MANUAL':
			$selCDetalleManual=mysqli_query($con,"
				SELECT productoId
				FROM fac_cotizaciondetalle_manual
				WHERE productoId='$_POST[productoId]' AND cotizacionManualId='$_POST[cotizacionManualId]' LIMIT 1");
			if ($datCDetalle=mysqli_fetch_assoc($selCDetalleManual)){
				mysqli_free_result($selCDetalleManual);
				mysqli_close($con);
				echo "2";
			} else {
				
				//SELECCIONAR EL PRECIO DEL PRODUCTO
				$selPrecio=mysqli_query($con,"SELECT precio FROM fac_precios WHERE productoId='$_POST[productoId]' LIMIT 1");
				$datPrecio=mysqli_fetch_assoc($selPrecio);

				//SELECCIONAR EL CLIENTE DE LA TABLA COTIZACION MANUAL
				$selClienteId=mysqli_query($con,"SELECT clienteId FROM fac_cotizacion_manual WHERE cotizacionManualId='$_POST[cotizacionManualId]' LIMIT 1");
				$datClienteId=mysqli_fetch_assoc($selClienteId);
				$clienteId=$datClienteId["clienteId"];
				
				//SELECCIONAR EL TIPO DE CLIENTE
				$selTipoCliente=mysqli_query($con,"SELECT tipoClienteId FROM fac_clientes WHERE clienteId='$clienteId' LIMIT 1");
				$datTipoCliente=mysqli_fetch_assoc($selTipoCliente);
				$tipoClienteId=$datTipoCliente["tipoClienteId"];

				//SELECCIONAR EL DESCUENTO DEL TIPO DE CLIENTE
				$selDescuento=mysqli_query($con,"SELECT descuento FROM fac_tipocliente WHERE tipoClienteId='$tipoClienteId' LIMIT 1");
				$datDescuento=mysqli_fetch_assoc($selDescuento);
				$porDescuento=$datDescuento["descuento"];

				$desPorProducto=$datPrecio["precio"]*$porDescuento; //2
				$totalDescuento= $desPorProducto * $_POST["cantidad"];
				$precioUnitario=$datPrecio["precio"]-$desPorProducto;

				$insCDetalleManual=mysqli_query($con,"
					INSERT INTO fac_cotizaciondetalle_manual (cotizacionManualId,cantidad,productoId,precioUnitario,descuentoCliente,descuentoPromocion)
					VALUES ('$_POST[cotizacionManualId]','$_POST[cantidad]','$_POST[productoId]','$precioUnitario','$totalDescuento','0')") or die ('ERRO INS-SDETALLE-MANUAL: '.mysqli_error($con));
				mysqli_close($con);
				echo "1"."¬".$_POST["cotizacionManualId"];
			}
		break;

		case 'INS-DUPLICAR':			
			#1. Seleccionar los datos de la cotizacion Seleccionada
			$selUltCotizacion=mysqli_query($con,"SELECT * FROM fac_cotizacion_manual WHERE cotizacionManualId='$_REQUEST[cotizacionManualId]' LIMIT 1");
			$datUltCotizacion=mysqli_fetch_assoc($selUltCotizacion);			

			#3. Hacer el Insert con los datos obtenidos

			#Seleccionar el correlativo actual
			$selCorr=mysqli_query($con,"SELECT MAX(correlativo) as correlativo FROM fac_cotizacion_manual");
			if ($datCorr=mysqli_fetch_assoc($selCorr)){
				$correlativo=$datCorr["correlativo"]+1;
			} else {
				$correlativo="1";
			}

			#Obtener el año
			$data=explode("-",$datUltCotizacion["fecha"]);
			$anioOriginal=$data[0];
			$anio=substr($anioOriginal, -2);

			#Formar el codigo
			$valor=str_pad($correlativo, 4, "0", STR_PAD_LEFT);
			$numCotizacion="M-".$valor."-".$anio;


			$insCotDuplicada=mysqli_query($con,"
				INSERT INTO fac_cotizacion_manual (
					anio,
					correlativo,
					numCotizacion,
					clienteId,
					fecha,
					lugarEntrega,
					tiempoEntrega,
					garantia,
					validez,
					condicionesPago,
					atencionA,
					email,
					telefono,
					descripcion,
					cantidadMetros,
					estado,
					usuarioAdd,
					fechaAdd
				)
				VALUES (
					'$anio',
					'$correlativo',
					'$numCotizacion',
					'$datUltCotizacion[clienteId]',
					'$datUltCotizacion[fecha]',
					'$datUltCotizacion[lugarEntrega]',
					'$datUltCotizacion[tiempoEntrega]',
					'$datUltCotizacion[garantia]',
					'$datUltCotizacion[validez]',
					'$datUltCotizacion[condicionesPago]',
					'$datUltCotizacion[atencionA]',
					'$datUltCotizacion[email]',
					'$datUltCotizacion[telefono]',
					'$datUltCotizacion[descripcion]',
					'$datUltCotizacion[cantidadMetros]',
					'0',
					'$_SESSION[usuario]',
					'$fechaHora'
				)
			") or die ("ERROR INS-COTIZACION-DUPLICADA".mysqli_error($con));

			
			$selMaxIdCotizacion=mysqli_query($con,"SELECT MAX(cotizacionManualId) as cotizacionManualId FROM fac_cotizacion_manual");
			$datMaxIdCotizacion=mysqli_fetch_assoc($selMaxIdCotizacion);

			#4. Hacer el insert del detalle de la cotizacion seleccionada
			$selUltDetalle=mysqli_query($con,"SELECT * FROM fac_cotizaciondetalle_manual WHERE cotizacionManualId='$_REQUEST[cotizacionManualId]'");
			while($datUltDetalle=mysqli_fetch_assoc($selUltDetalle)){
				$insCDetalleManual=mysqli_query($con,"
					INSERT INTO fac_cotizaciondetalle_manual (cotizacionManualId,cantidad,productoId,precioUnitario)
					VALUES ('$datMaxIdCotizacion[cotizacionManualId]','$datUltDetalle[cantidad]','$datUltDetalle[productoId]','$datUltDetalle[precioUnitario]')") or die ('ERROR INS-SDETALLE-DUPLICADO: '.mysqli_error($con));
			}
			mysqli_close($con);	

			echo "1";	
		break;


		default:
			echo "NO SE GENERO NINGUNA ACCION";
		break;
	}



?>