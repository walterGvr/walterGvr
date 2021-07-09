<?php
include ("../../../../lib/config/conect.php");
include ("fpdf/fpdf.php");

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
		$this->Image('fpdf/img/logo-dentalmed.png', 13,5,40,20,'PNG'); //X,Y,ANCHO,ALTO,

		$this->SetFont('ARIAL','B',25);
		$this->SetXY(10, 10);
		$this->Cell(260, 10, 'DENTALMED DEPOT', 0 , 0,'C'); //Celda


		$this->SetFont('ARIAL','',10);
		$this->SetXY(10, 20);
		$this->Cell(260, 5,utf8_decode('Diagonal Dr. Arturo Romero, Edificio #444, local #12 Segundo Nivel, Colonia Médica'), 0 , 0, 'C'); //Celda

		//Inicio X,Y, Fin X,Y
		$this->Line(7,27,270,27);

		$this->SetFont('ARIAL','B',9);
		#ENCABEZADOS DE LA TABLA

		$this->SetFillColor(194,194,163);
		$this->SetXY(10, 30);
		$this->Cell(10, 5, 'NO',1,1,'C', True);

		$this->SetXY(20, 30);
		$this->Cell(20, 5, 'CODIGO', 1 , 1,'C', True);

		$this->SetXY(40, 30);
		$this->Cell(150, 5, 'PRODUCTO', 1 , 1,'C', True);

		$this->SetXY(190, 30);
		$this->Cell(37, 5, 'COLOR', 1 , 1,'C', True);

		/*$this->SetXY(177, 30);
		$this->Cell(50, 5, 'MODELO', 1 , 1,'C', True);*/

		$this->SetXY(227, 30);
		$this->Cell(20, 5, 'EX.ACTUAL', 1 , 1,'C', True);

		$this->SetXY(247, 30);
		$this->Cell(20, 5, 'C.P.', 1 , 1,'C', True);


	}

	// Pie de página
	function Footer()
	{
		$this->SetFont('Arial','',8);
		$fechaACtual=date("d-m-Y (h:i:s: A)");
		$this->SetXY(108, -9);
		$this->Cell(15, 4, utf8_decode('Fecha de impresión: '.$fechaACtual), 0 , 1);

		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,utf8_decode('Reporte: Inventario --  Página: '.$this->PageNo().'/{nb}'),0,0,'C');
	}

} //Fin de clase PDF

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','Letter');

	$pdf->SetFont('ARIAL','',9);

	//CONTADOR DE ALGURA DEL REGISTRO.
	$altRegistro=35;
	$numReg=1;

	$selProd=mysqli_query($con,"SELECT * FROM inv_producto");
	while ($datProd=mysqli_fetch_assoc($selProd)){

		//ESTE CODIGO ME HACE EL SALDO A LA SIGUIENTE PÁGINA
		if ($altRegistro>190){
			$pdf->AddPage('L','Letter');
			$altRegistro = 35;
		}

		#NUMERO
		$pdf->SetXY(10, $altRegistro);
		$pdf->Cell(10, 5, $numReg, 1 , 1,'C');

		#CODIGO
		$pdf->SetXY(20, $altRegistro);
		$pdf->Cell(20, 5, $datProd["codigo"], 1 , 1);

		#PRODUCTO
		$pdf->SetXY(40, $altRegistro);
		$pdf->Cell(150, 5, utf8_decode($datProd["producto"]), 1 , 1);

		#COLOR
		$color=$datProd["color"];
		$pdf->SetXY(190, $altRegistro);
		$pdf->Cell(37, 5, utf8_decode($color), 1 , 1);

		#MODELO
		/*$pdf->SetXY(177, $altRegistro);
		$pdf->Cell(50, 5, $datProd["modelo"], 1 , 1);*/

		#EXISTENCIA ACTUAL
		$pdf->SetXY(227, $altRegistro);
		$pdf->Cell(20, 5, $datProd["exActual"], 1 , 1,'C');


		#COSTO PROMEDIO
		$pdf->SetXY(247, $altRegistro);
		$pdf->Cell(20, 5, number_format($datProd["costoPromedio"],'4','.',','), 1 , 1,'R');



		//ACUMULADOR - SUMA 5 DE ALTO EN CADA REGISTRO
		$altRegistro=$altRegistro+5;
		$numReg=$numReg+1;
	}

$pdf->Output('INVENTARIO SERVITEC LAPTOPS.pdf','I');














?>