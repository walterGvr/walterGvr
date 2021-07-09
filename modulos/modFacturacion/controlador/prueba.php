<?php
	include("../../../lib/config/conect.php");
	/*$valor=2019;
	//echo str_pad($valor, 4, "0", STR_PAD_LEFT);
	//echo substr($valor, -2);

	echo "valor de Medida:".$valorMedida=5;
	echo "<br>";
	echo "Division:".$metrosL=36.4/$valorMedida;
	echo "<br>";
	echo "Division:".$cantDecimal=$metrosL*2;
	echo "<br>";
	echo "Valor entero:". $multiplicador=(intval($cantDecimal))+1;*/
			
			$sistemaId=6;
			$cotizacionId=5;
			$unidadMedida="ML";
			$valorMedida=10;
			
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
				echo $divisiones=$valorMedida/$valorDivision;
				echo "<br>";
				echo $valorEntero=number_format($divisiones,'0','.',',');
				echo "<br>";
				echo $valorEntero+1;

				#Seleccionar los datos del SistemaDetalle
				$selSDetalle=mysqli_query($con,"SELECT * FROM fac_sistemadetalle WHERE sistemaId='$sistemaId'");
				while($datSDetelle=mysqli_fetch_assoc($selSDetalle)){

					if ($unidadMedida=="ML"){
						#1. Obtenemos los metros lineales

						$cantDecimal=$divisiones*$datSDetelle["cantidad"];
						
						$cantidad=(intval($cantDecimal))+1;

						//$cantidad=$datSDetelle["cantidad"]*$multiplicador;

						#Buscar el productoId en la tabla fac_precios con su precioId
						$selProdId=mysqli_query($con,"SELECT productoId FROM fac_precios WHERE precioId='$datSDetelle[precioId]' LIMIT 1");
						$selProdId=mysqli_fetch_assoc($selProdId);
						$productoId=$selProdId["productoId"];

						$total=$datSDetelle["precio"]*$cantidad;


						#Insertar cada dato en la tabla fac_costeodetalle
						/*$insCostDetalle=mysqli_query($con,"
							INSERT INTO fac_costeodetalle (cotizacionId,sistemaId,cantidad,productoId,unitario,total)
							VALUES ('$_POST[cotizacionId]','$_POST[sistemaId]','$cantidad','$productoId','$datSDetelle[precio]','$total')
						") or die ('ERRO INS-COSTDETALLE : '.mysqli_error($con));*/

						$totalCosteo=$totalCosteo+$total;


					} else {
						#Pendiente....
					}
				}

				/*$insCDetalle=mysqli_query($con,"
					INSERT INTO fac_cotizaciondetalle (cotizacionId,cantidad,sistemaId,precio,unidadMedida,valorMedida)
					VALUES ('$_POST[cotizacionId]','$_POST[cantidad]','$_POST[sistemaId]','$totalCosteo','$_POST[unidadMedida]','$_POST[valorMedida]')") or die ('ERRO INS-SDETALLE: '.mysqli_error($con));
				*/

				mysqli_close($con);
				//echo "1"."¬".$_POST["cotizacionId"];
			}


?>