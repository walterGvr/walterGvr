<?php
include ("../../../../lib/config/conect.php");
include ("fpdf/fpdf.php");

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
		$this->Image('fpdf/img/logoSL.jpg', 13,5,23,20,'JPG'); //X,Y,ANCHO,ALTO,

		$this->SetFont('ARIAL','B',19);
		$this->SetFillColor(80, 150, 200);
		$this->SetXY(75, 10);
		$this->Cell(15, 4, 'EMPRESA DEMO', 0 , 1); //Celda


		$this->SetFont('ARIAL','',10);
		$this->SetXY(72, 15);
		$this->Cell(15, 4, utf8_decode('Acá saldrá la dirección de la empresa...'), 0 , 1); //Celda

		//Inicio X,Y, Fin X,Y
		$this->Line(7,27,210,27);
	}

	// Pie de página
	function Footer()
	{
		$this->SetFont('Arial','',8);
		$fechaACtual=date("d-m-Y (h:i:s: A)");
		$this->SetXY(75, -9);
		$this->Cell(15, 4, utf8_decode('Fecha de impresión: '.$fechaACtual), 0 , 1);

		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,utf8_decode('Reporte: Codigo de Barra --  Página: '.$this->PageNo().'/{nb}'),0,0,'C');

		include ("../../../../lib/config/conect.php");
		$selProd=mysqli_query($con,"SELECT * FROM inv_producto WHERE productoId='$_REQUEST[productoId]' LIMIT 1");
		$datProd=mysqli_fetch_assoc($selProd);
		$this->SetY(-17);
		$this->Cell(0, 10, utf8_decode($datProd["producto"]), 0 , 1);
	}

} //Fin de clase PDF

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter');

$selProd=mysqli_query($con,"SELECT * FROM inv_producto WHERE productoId='$_REQUEST[productoId]' LIMIT 1");
$datProd=mysqli_fetch_assoc($selProd);
$codigo=$datProd['codigo'];
$pdf->SetFont('ARIAL','',10);

//PRIMERA LINEA
{
	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(10,40,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(24, 50);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(80,40,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(95, 50);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(150,40,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(166, 50);
	$pdf->Cell(15, 4,$codigo, 0 , 1);
}

//SEGUNDA LINEA
{
	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(10,70,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(24, 80);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(80,70,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(95, 80);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(150,70,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(166, 80);
	$pdf->Cell(15, 4,$codigo, 0 , 1);
}

//TERCERA LINEA
{
	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(10,100,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(24, 110);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(80,100,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(95, 110);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(150,100,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(166, 110);
	$pdf->Cell(15, 4,$codigo, 0 , 1);
}

//CUARTA LINEA
{
	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(10,130,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(24, 140);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(80,130,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(95, 140);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(150,130,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(166, 140);
	$pdf->Cell(15, 4,$codigo, 0 , 1);
}

//QUINTA LINEA
{
	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(10,160,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(24, 170);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(80,160,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(95, 170);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(150,160,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(166, 170);
	$pdf->Cell(15, 4,$codigo, 0 , 1);
}

//SEXTA LINEA
{
	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(10,190,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(24, 200);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(80,190,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(95, 200);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(150,190,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(166, 200);
	$pdf->Cell(15, 4,$codigo, 0 , 1);
}

//SEPTIMA LINEA
{
	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(10,220,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(24, 230);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(80,220,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(95, 230);
	$pdf->Cell(15, 4,$codigo, 0 , 1);

	////////////////////////////////////////////////////////////////////////7777777

	#codigo de barra Posx,Posy,codigo,ancho y alto
	$pdf->Code128(150,220,$codigo,45,10);

	#codigo en numero
	$pdf->SetXY(166, 230);
	$pdf->Cell(15, 4,$codigo, 0 , 1);
}


$pdf->Output('CODIGO DE BARRA DEL PRODUCTO '.$datProd["producto"].'.pdf','I');
?>