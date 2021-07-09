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
		$this->Image('../../../../lib/assets/images/logoTinsa.jpg', 20,13,60,20,'JPG'); //X,Y,ANCHO,ALTO,
	}

	// Pie de página
	function Footer()
	{
		$this->Image('../../../../lib/assets/images/pieTinsa.jpg', 20,250,175,25,'JPG'); //X,Y,ANCHO,ALTO,

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

$selCot=mysqli_query($con,"SELECT * FROM vista_cotizacion WHERE cotizacionId='$_REQUEST[cotizacionId]' LIMIT 1");
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

$pdf->SetXY(20, 115);
$pdf->Cell(175, 5,utf8_decode("EMITIR CHEQUE A NOMBRE DE: Tinsa El Salvador, SA de CV."),0,1,"L");
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
$pdf->Cell(65, 5,utf8_decode("DESCRIPCIÓN"),1,1,"C");

$pdf->SetXY(115, 125);
$pdf->Cell(10, 5,utf8_decode("AN"),1,1,"C");

$pdf->SetXY(125, 125);
$pdf->Cell(10, 5,utf8_decode("AL"),1,1,"C");

$pdf->SetXY(135, 125);
$pdf->Cell(10, 5,utf8_decode("AR"),1,1,"C");


$pdf->SetXY(145, 125);
$pdf->Cell(20, 5,utf8_decode("UNITARIO"),1,1,"C");
$pdf->SetXY(165, 125);
$pdf->Cell(20, 5,utf8_decode("TOTAL"),1,1,"C");
$pdf->SetXY(185, 125);
$pdf->Cell(10, 5,utf8_decode("MED"),1,1,"C");

$pdf->SetFont('ARIAL','',9);
$num=1;
$dynamicY=130;
$totalProyecto=0;
$selCDetalle=mysqli_query($con,"SELECT * FROM fac_cotizaciondetalle WHERE cotizacionId='$_REQUEST[cotizacionId]'");
while($datCDetalle=mysqli_fetch_assoc($selCDetalle)){

	#Item
	$pdf->SetXY(20, $dynamicY);
	$pdf->Cell(10, 20,$num,1,1,"C");

	#Cantidad
	$pdf->SetXY(30, $dynamicY);
	$pdf->Cell(20, 20,$datCDetalle["ancho"],1,1,"C");

	#Descripción
	$selSistema=mysqli_query($con,"SELECT nombreSistema FROM fac_sistema WHERE sistemaId='$datCDetalle[sistemaId]' LIMIT 1");
	$datSistema=mysqli_fetch_assoc($selSistema);
	$pdf->SetXY(50, $dynamicY);
	$pdf->MultiCell(65, 10,utf8_decode("Suministro e instalación de ".$datSistema["nombreSistema"]),1,"C",false);

	#Ancho
	$pdf->SetXY(115, $dynamicY);
	$pdf->Cell(10, 20,"",1,1,"C");

	#Alto
	$pdf->SetXY(125, $dynamicY);
	$pdf->Cell(10, 20,"",1,1,"C");

	#Área
	$pdf->SetXY(135, $dynamicY);
	$pdf->Cell(10, 20,"",1,1,"C");

	#Unitario = total sin IVA / Ancho
		#1. Obtener el costo del sistema
		$costoSistema=$datCDetalle["precio"];

		#2. Obtener los costos adicionales
		$selAdi=mysqli_query($con,"SELECT SUM(cantidad * unitario) as totalAdicional FROM fac_cotadicional WHERE cotizacionId='$_REQUEST[cotizacionId]'");
		$datAdi=mysqli_fetch_assoc($selAdi);
		$costosAdicionales=$datAdi["totalAdicional"];

		#3. Sumar los costos del sistema y adicionales
		$totalCostos=$costoSistema+$costosAdicionales;

		#4. Obtener el margen de ganancia
		$margenGanancia=$totalCostos*0.8;

		$totalMasMargen=$totalCostos+$margenGanancia;

		$precioUnitario=$totalMasMargen/$datCDetalle["ancho"];


	$pdf->SetXY(145, $dynamicY);
	$pdf->Cell(20, 20,"$",0,1,"L");
	$pdf->SetXY(145, $dynamicY);
	$pdf->Cell(20, 20,number_format($precioUnitario,'2','.',','),1,1,"C");

	#Total
	$pdf->SetXY(165, $dynamicY);
	$pdf->Cell(20, 20,"$",0,1,"L");
	$total=$precioUnitario*$datCDetalle["ancho"];
	$pdf->SetXY(165, $dynamicY);
	$pdf->Cell(20, 20,number_format($total,'2','.',','),1,1,"R");

	#Unidad de Medida
	$pdf->SetXY(185, $dynamicY);
	$pdf->Cell(10, 20,$datCDetalle["unidadMedida"],1,1,"C");

	$dynamicY=$dynamicY+20;
	$num++;
	$totalProyecto=$totalProyecto+$total;

}

$pdf->SetFont('ARIAL','B',9);

#Sub-Total
$pdf->SetXY(165, $dynamicY);
$pdf->Cell(20, 5,"$",0,1,"L");
$pdf->SetXY(145, $dynamicY);
$pdf->Cell(20, 5,"SUB-TOTAL",1,1,"C");
$pdf->SetXY(165, $dynamicY);
$pdf->Cell(20, 5,number_format($totalProyecto,'2','.',','),1,1,"R");

#I.V.A
$iva=$totalProyecto*0.13;
$pdf->SetXY(165, $dynamicY+5);
$pdf->Cell(20, 5,"$",0,1,"L");
$pdf->SetXY(145, $dynamicY+5);
$pdf->Cell(20, 5,"I.V.A",1,1,"C");
$pdf->SetXY(165, $dynamicY+5);
$pdf->Cell(20, 5,number_format($iva,'2','.',','),1,1,"R");

#Total
$pdf->SetXY(165, $dynamicY+10);
$pdf->Cell(20, 5,"$",0,1,"L");
$pdf->SetXY(145, $dynamicY+10);
$pdf->Cell(20, 5,"TOTAL",1,1,"C");
$pdf->SetXY(165, $dynamicY+10);
$pdf->Cell(20, 5,number_format(($totalProyecto+$iva),'2','.',','),1,1,"R");


#Cantidad en Letras
$pdf->SetFont('ARIAL','',9);
$cifra=$totalProyecto+$iva;
$valorLetras=valorEnLetras($cifra);
$pdf->SetXY(20, $dynamicY);
$pdf->Cell(145, 15,"Son: ".$valorLetras.utf8_decode(" dólares"),1,1,"L");


#Firma del usuario que elaboró la cotización
$pdf->SetXY(20, $dynamicY+55);
$pdf->Cell(15, 5,"________________________________",0,1,"L");

$nombre=$_SESSION["nombres"]." ".$_SESSION["apellidos"];
$pdf->SetXY(20, $dynamicY+60);
$pdf->Cell(15, 5,utf8_decode($nombre),0,1,"L");

$pdf->SetXY(20, $dynamicY+65);
$pdf->Cell(15, 5,"Asesor Comercial",0,1,"L");



#Firma de Aceptación
$pdf->SetXY(125, $dynamicY+55);
$pdf->Cell(15, 5,"________________________________",0,1,"L");

$pdf->SetXY(125, $dynamicY+60);
$pdf->Cell(15, 5,"ACEPTADO CLIENTE",0,1,"L");







$pdf->Output('Cotizacion '.$datCot["numCotizacion"].'.pdf','I');
?>