<?php
include ("../../../../lib/config/conect.php");
include ("fpdf/fpdf.php");

$desde=$_REQUEST["desde"];
$hasta=$_REQUEST["hasta"];

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
		$this->Cell(260, 5,utf8_decode('REPORTE DE COMPRAS'), 0 , 0, 'C'); //Celda

		//Inicio X,Y, Fin X,Y
		$this->Line(7,27,270,27);
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

	$selCompra=mysqli_query($con,"SELECT * FROM inv_compra WHERE fechaCompra BETWEEN '$desde' AND '$hasta'");
	while ($datCompra=mysqli_fetch_assoc($selCompra)){

		//ESTE CODIGO ME HACE EL SALDO A LA SIGUIENTE PÁGINA
		if ($altRegistro>150){
			$pdf->AddPage('L','Letter');
			$altRegistro = 35;
        }
        
        $pdf->Rect(10, $altRegistro, 260, 50);

		#Datos del encabezado
		$pdf->SetXY(10, $altRegistro);
        $pdf->Cell(260, 5,'Fecha: '.$datCompra["fechaCompra"], 0 , 1,'L');
        
        #Documento
        $pdf->SetXY(100, $altRegistro);
        $pdf->Cell(25, 5,'# de documento: '.$datCompra["numeroFactura"], 0 , 1,'L');
        
        #Proveedor
        $selProveedor=mysqli_query($con,"SELECT nombre FROM inv_proveedores WHERE proveedorId='$datCompra[proveedorId]' LIMIT 1");
        $datProveedor=mysqli_fetch_assoc($selProveedor);
        $pdf->SetXY(10, $altRegistro+5);
        $pdf->Cell(25, 5,'Proveedor: '.$datProveedor["nombre"], 0 , 1,'L');
        
        #Descripcion
        $pdf->SetXY(10, $altRegistro+10);
        $pdf->Cell(25, 5,'Descripcion: '.utf8_decode($datCompra["descripcion"]), 0 , 1,'L');

        #Productos
        $pdf->SetXY(10, $altRegistro+20);
        $pdf->Cell(25, 5,'PRODUCTOS COMPRADOS: ', 0 , 1,'L');

        $altoProd=$altRegistro+25;
        $numProd=1;
        $totalProd=0;
        $selCDetalle=mysqli_query($con,"SELECT * FROM inv_compradetalle WHERE compraId='$datCompra[compraId]'");
        while($datCDetalle=mysqli_fetch_assoc($selCDetalle)){
            
            #Num
            $pdf->SetXY(10, $altoProd);
            $pdf->Cell(25, 5,$numProd, 0 , 1,'L');

            #Producto
            $selProducto=mysqli_query($con,"SELECT producto FROM inv_producto WHERE productoId='$datCDetalle[productoId]' LIMIT 1");
            $datProducto=mysqli_fetch_assoc($selProducto);
            $pdf->SetXY(35, $altoProd);
            $pdf->Cell(75, 5,utf8_decode($datProducto["producto"]), 0 , 1,'L');

            #Cantidad
            $pdf->SetXY(110, $altoProd);
            $pdf->Cell(25, 5,$datCDetalle["cantidad"], 0 , 1,'R');


            #Unitario
            $pdf->SetXY(135, $altoProd);
            $pdf->Cell(25, 5,number_format($datCDetalle["valorUnitario"],'2','.',','), 0 , 1,'R');


            #Total
            $pdf->SetXY(160, $altoProd);
            $pdf->Cell(25, 5,number_format($datCDetalle["total"],'2','.',','), 0 , 1,'R');


            $altoProd=$altoProd+5;
            $numProd=$numProd+1;
            $totalProd=$totalProd+$datCDetalle["total"];
        }

        #Total de los productos
        $pdf->SetXY(120, $altoProd+5);
        $pdf->Cell(25, 5,"TOTAL DE LA COMPRA ", 0 , 1,'R');
        $pdf->SetXY(160, $altoProd+5);
        $pdf->Cell(25, 5,number_format($totalProd,'2','.',','), 0 , 1,'R');



		//ACUMULADOR - SUMA 5 DE ALTO EN CADA REGISTRO
		$altRegistro=$altRegistro+50;
		$numReg=$numReg+1;
	}

$pdf->Output('Compras - DENTALMED DEPOT.pdf','I');
?>