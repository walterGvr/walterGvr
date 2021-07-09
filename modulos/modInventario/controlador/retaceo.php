<?php
session_start();
include ("../../../lib/config/conect.php");
$fechaHoy=date("Y-m-d H:i:s");

$compraId=$_REQUEST["compraId"];
$selCDetalle=mysqli_query($con,"SELECT compraId,productoId,cantidad,valorUnitario FROM inv_compradetalle WHERE compraId='$compraId'");

//SUMA DE TODAS LAS COMPRAS
$selSCompras=mysqli_query($con,"SELECT SUM(total) as totalCompras FROM inv_compradetalle WHERE compraId='$compraId'");
$datSCompras=mysqli_fetch_assoc($selSCompras);
$totalCompras=$datSCompras["totalCompras"];

//SUMA DE TODOS LOS TRAMITES
$selSTramites=mysqli_query($con,"SELECT SUM(total) as totalTramites FROM inv_tramites WHERE compraId='$compraId'");
$datSTramites=mysqli_fetch_assoc($selSTramites);
$totalTramites=$datSTramites["totalTramites"];

while($datCDetalle=mysqli_fetch_assoc($selCDetalle)){

	$selExActual=mysqli_query($con,"SELECT exActual,costoPromedio FROM inv_producto WHERE productoId='$datCDetalle[productoId]' LIMIT 1");
	$datExActual=mysqli_fetch_assoc($selExActual);

	$unidadesAnteriores=$datExActual["exActual"];
	$costoAnterior=($datExActual["costoPromedio"]*$unidadesAnteriores);

	$unidadesNuevas=$datCDetalle["cantidad"];
	$costoNuevo=($datCDetalle["valorUnitario"]*$unidadesNuevas);

	#OBTENER EL FACTOR = PRECIO TOTAL DEL PRODUCTO / TOTAL DE LA COMPRA
	$factor=($costoNuevo/$totalCompras);

	#IBTENER EL VALOR MUTILICADOR = FACTOR * TOTAL DEL TRAMITE : ESTO ES EL PORCENTAJE DEL COSTO DEL TRAMITE QUE CORRESPONDE AL PRODUCTO
	$multi=$factor*$totalTramites;

	#OBTENER EL NUEVO COSTO DEL PRODUCTO = EL MULTIPLICADOR + COSTO DEL PRODUCTO / LAS CANTIDADES : ES DECIR SUMO AMBOS COSTOS Y LOS DIVIDO ENTRE EL NUMERO DE PRODUCTOS
	$costoProd=($multi+$costoNuevo)/$unidadesNuevas;
	$totalCostoProd=$costoProd*$unidadesNuevas;

	$costoPromedio=($costoAnterior+$totalCostoProd)/($unidadesAnteriores+$unidadesNuevas);
	$nuevaExActual=$unidadesAnteriores+$unidadesNuevas;

	$updProd=mysqli_query($con,"UPDATE inv_producto SET exActual='$nuevaExActual',costoPromedio='$costoPromedio' WHERE productoId='$datCDetalle[productoId]'") or die ('ERRO UPD-PROD: '.mysqli_error($con));
	$updRetaceo=mysqli_query($con,"UPDATE inv_compradetalle SET retaceoEfectuado='1' WHERE compraId='$datCDetalle[compraId]'") or die ('ERRO UPD-RETACEO: '.mysqli_error($con));
	$updTramites=mysqli_query($con,"UPDATE inv_tramites SET retaceoEfectuado='1' WHERE compraId='$datCDetalle[compraId]'") or die ('ERRO UPD-TRAMITE: '.mysqli_error($con));

	$insRetaceo=mysqli_query($con,"INSERT INTO inv_retaceo (compraId,totalCompra,totalTramite,factor,multi,costoProd,productoId)
	VALUES ('$compraId','$totalCompras','$totalTramites','$factor','$multi','$costoProd','$datCDetalle[productoId]')") or die ('ERROR TBL_RETACEO: '.mysqli_error($con));

	mysqli_free_result($selExActual);
}

mysqli_free_result($selCDetalle);
mysqli_free_result($selSCompras);
mysqli_free_result($selSTramites);
mysqli_close($con);

echo "1";


?>