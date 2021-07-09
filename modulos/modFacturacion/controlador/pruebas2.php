<?php
	/*$totalCosteo=0;
	$valorDivision=1.4;

	$ancho=15;

	$segmentos=$ancho/$valorDivision;				
	echo $cantidad=(intval($segmentos))+2;*/

	$ancho=15;
	$varlorAproximado=12;

	$tuboHorizontal=$ancho/6;
	$tuboVertical=($varlorAproximado*0.9)/6;
	echo $totTubo=$tuboHorizontal+$tuboVertical;
	echo "<br>";
	echo $totalTubo=(intval($totTubo))+1;

?>