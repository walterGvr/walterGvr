<?php  
	include('../../../../lib/config/conect.php');

	$lineaId= $_POST['mdl_add_lineaId'];

	$selLinea=mysqli_query($con,"SELECT * FROM inv_lineas WHERE lineaId='$lineaId' LIMIT 1");
	$datLineas=mysqli_fetch_assoc($selLinea);
	$data = array($datLineas['lineaId'],$datLineas['marcaId'],$datLineas['linea'],);
	echo implode('¬',$data);
?>