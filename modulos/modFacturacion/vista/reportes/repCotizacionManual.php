<?php
session_start();
include ("../../../../lib/config/conect.php");
include ("fpdf/fpdf.php");
include ("cifrasLetras.php");

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
		$this->Image('fpdf/img/logo-dentalmed.png', 13,5,80,42,'PNG'); //X,Y,ANCHO,ALTO,
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
		$this->Cell(0,10,utf8_decode('Reporte: Cotización --  Página: '.$this->PageNo().'/{nb}'),0,0,'C');
	}

} //Fin de clase PDF

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter');

$selCot=mysqli_query($con,"
	SELECT fcm.*,CONCAT(cl.nombres,' ',cl.apellidos) as nombreCliente
	FROM fac_cotizacion_manual fcm
	LEFT JOIN fac_clientes cl on cl.clienteId = fcm.clienteId
	WHERE cotizacionManualId='$_REQUEST[cotizacionManualId]'
	LIMIT 1");
$datCot=mysqli_fetch_assoc($selCot);

#Titulo COTIZACION
$pdf->SetFont('ARIAL','B',15);
$pdf->SetXY(20, 50);
$pdf->Cell(175, 5,utf8_decode("COTIZACIÓN ".$datCot["numCotizacion"]),0,1,"C");

$pdf->SetFont('ARIAL','',10);

#Columna 1 ========================================================================================>
$pdf->SetXY(20, 65);
$pdf->Cell(87.5, 5,utf8_decode("Cliente: ".$datCot["nombreCliente"]),0,1,"L");

$pdf->SetXY(20, 70);
$pdf->Cell(87.5, 5,utf8_decode("Proyecto:"),0,1,"L");

$pdf->SetXY(20, 75);
$pdf->Cell(87.5, 5,utf8_decode("Lugar de Entrega: ".$datCot["lugarEntrega"]),0,1,"L");

$pdf->SetXY(20, 80);
$pdf->Cell(87.5, 5,utf8_decode("Tiempo de Entrega: ".$datCot["tiempoEntrega"]),0,1,"L");

$pdf->SetXY(20, 85);
$pdf->Cell(87.5, 5,utf8_decode("Tiempo de Instalación: "),0,1,"L");

$pdf->SetXY(20, 90);
$pdf->Cell(87.5, 5,utf8_decode("Garantía: ".$datCot["garantia"]),0,1,"L");

$pdf->SetXY(20, 95);
$pdf->Cell(87.5, 5,utf8_decode("Validez de Cotización: ".$datCot["validez"]),0,1,"L");

$pdf->SetXY(20, 100);
$pdf->MultiCell(175, 5,utf8_decode("Condiciones de Pago y Observaciones: ".$datCot["condicionesPago"]),0,"L",false);

/*$pdf->SetXY(20, 115);
$pdf->Cell(175, 5,utf8_decode("EMITIR CHEQUE A NOMBRE DE: Tinsa El Salvador, SA de CV."),0,1,"L");*/
#===================================================================================================>

#Columna 2 =========================================================================================>
$pdf->SetXY(107.5, 65);
$pdf->Cell(87.5, 5,utf8_decode("Número de Cotización: ".$datCot["numCotizacion"]),0,1,"L");

$pdf->SetXY(107.5, 70);
$pdf->Cell(87.5, 5,utf8_decode("Atención a: ".$datCot["atencionA"]),0,1,"L");

$pdf->SetXY(107.5, 75);
$pdf->Cell(87.5, 5,utf8_decode("Correo Electrónico: ".$datCot["email"]),0,1,"L");

$pdf->SetXY(107.5, 80);
$pdf->Cell(87.5, 5,utf8_decode("Teléfono: ".$datCot["telefono"]),0,1,"L");

$pdf->SetXY(107.5, 85);
$pdf->Cell(87.5, 5,utf8_decode("Fecha: ".$datCot["fecha"]),0,1,"L");
#===================================================================================================>

$pdf->SetFont('ARIAL','B',9);
$pdf->SetXY(20, 125);
$pdf->Cell(10, 5,utf8_decode("ITEM"),1,1,"C");
$pdf->SetXY(30, 125);
$pdf->Cell(20, 5,utf8_decode("CANTIDAD"),1,1,"C");
$pdf->SetXY(50, 125);
$pdf->Cell(95, 5,utf8_decode("DESCRIPCIÓN"),1,1,"C");
$pdf->SetXY(145, 125);
$pdf->Cell(20, 5,utf8_decode("UNITARIO"),1,1,"C");
$pdf->SetXY(165, 125);
$pdf->Cell(20, 5,utf8_decode("TOTAL"),1,1,"C");


$pdf->SetFont('ARIAL','',9);
$num=1;
$alto=130;
$total=0;
$totalDescuento=0;
$selDetalle=mysqli_query($con,"SELECT det.*,pro.producto FROM fac_cotizaciondetalle_manual det LEFT JOIN inv_producto pro ON pro.productoId = det.productoId WHERE cotizacionManualId='$datCot[cotizacionManualId]'");
while($datDetalle=mysqli_fetch_assoc($selDetalle)){
	#Item
	$pdf->SetXY(20, $alto);
	$pdf->Cell(10, 5,$num,1,1,"C");

	#Cantidad
	$pdf->SetXY(30, $alto);
	$pdf->Cell(20, 5,$datDetalle['cantidad'],1,1,"C");

	#Descripción	
	$pdf->SetXY(50, $alto);
	$pdf->Cell(95, 5,utf8_decode($datDetalle['producto']),1,1,"L");

	#Unitario
	$pdf->SetXY(145, $alto);
	$pdf->Cell(20, 5,"$",0,1,"L");
	$pdf->SetXY(145, $alto);
	$pdf->Cell(20, 5,number_format($datDetalle['precioUnitario'],'2','.',','),1,1,"R");

	#Total
	$totalReg=$datDetalle['cantidad']*$datDetalle['precioUnitario'];
	$pdf->SetXY(165, $alto);
	$pdf->Cell(20, 5,"$",0,1,"L");
	$pdf->SetXY(165, $alto);
	$pdf->Cell(20, 5,number_format($totalReg,'2','.',','),1,1,"R");

	$num+=1;
	$alto+=5;
	$total=$total+$totalReg;

	$sumDescuento=$datDetalle["descuentoCliente"];
	$totalDescuento+=$sumDescuento;
}

$pdf->SetFont('ARIAL','B',9);

#Sub-Total (Sin descuento)
$pdf->SetXY(165, $alto);
$pdf->Cell(20, 5,"$",0,1,"L");
$pdf->SetXY(115, $alto);
$pdf->Cell(50, 5,"SUB TOTAL (SIN DESCUENTO)",1,1,"R");
$pdf->SetXY(165, $alto);
$pdf->Cell(20, 5,number_format($total+$sumDescuento,'2','.',','),1,1,"R");

#Descuento de cliente
$pdf->SetXY(165, $alto+5);
$pdf->Cell(20, 5,"$",0,1,"L");
$pdf->SetXY(115, $alto+5);
$pdf->Cell(50, 5,"DESCUENTO CLIENTE (-)",1,1,"R");
$pdf->SetXY(165, $alto+5);
$pdf->Cell(20, 5,number_format($totalDescuento,'2','.',','),1,1,"R");

#Descuento de promoción
$pdf->SetXY(165, $alto+10);
$pdf->Cell(20, 5,"$",0,1,"L");
$pdf->SetXY(115, $alto+10);
$pdf->Cell(50, 5,"DESCUENTO PROMOCION (-)",1,1,"R");
$pdf->SetXY(165, $alto+10);
$pdf->Cell(20, 5,number_format('0','2','.',','),1,1,"R");

#Sub total
$pdf->SetXY(165, $alto+15);
$pdf->Cell(20, 5,"$",0,1,"L");
$pdf->SetXY(115, $alto+15);
$pdf->Cell(50, 5,"SUB-TOTAL",1,1,"R");
$pdf->SetXY(165, $alto+15);
$pdf->Cell(20, 5,number_format($total,'2','.',','),1,1,"R");

#I.V.A
$iva=$total*0.13;
$pdf->SetXY(165, $alto+20);
$pdf->Cell(20, 5,"$",0,1,"L");
$pdf->SetXY(115, $alto+20);
$pdf->Cell(50, 5,"I.V.A",1,1,"R");
$pdf->SetXY(165, $alto+20);
$pdf->Cell(20, 5,number_format($iva,'2','.',','),1,1,"R");

#Total
$pdf->SetXY(165, $alto+25);
$pdf->Cell(20, 5,"$",0,1,"L");
$pdf->SetXY(115, $alto+25);
$pdf->Cell(50, 5,"TOTAL",1,1,"R");
$pdf->SetXY(165, $alto+25);
$pdf->Cell(20, 5,number_format(($total+$iva),'2','.',','),1,1,"R");


#Cantidad en Letras
$pdf->SetFont('ARIAL','',9);
$cifra=$total+$iva;
$valorLetras=valorEnLetras($cifra);
$pdf->SetXY(20, $alto);
$pdf->Cell(95, 30,"Son: ".$valorLetras.utf8_decode(" dólares"),1,1,"L");


#Firma del usuario que elaboró la cotización
$pdf->SetXY(20, 150+55);
$pdf->Cell(15, 5,"________________________________",0,1,"L");

$nombre=$_SESSION["nombres"]." ".$_SESSION["apellidos"];
$pdf->SetXY(20, 150+60);
$pdf->Cell(15, 5,utf8_decode($nombre),0,1,"L");

$pdf->SetXY(20, 150+65);
$pdf->Cell(15, 5,"Asesor Comercial",0,1,"L");



#Firma de Aceptación
$pdf->SetXY(125, 150+55);
$pdf->Cell(15, 5,"________________________________",0,1,"L");

$pdf->SetXY(125, 150+60);
$pdf->Cell(15, 5,"ACEPTADO CLIENTE",0,1,"L");







$pdf->Output('Cotizacion '.$datCot["numCotizacion"].'.pdf','I');
?>