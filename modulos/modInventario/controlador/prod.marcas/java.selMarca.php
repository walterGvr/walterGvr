<?php  
	include('../../../../lib/config/conect.php');

	$marcaId= $_POST['mdl_add_marcaId'];

	$selMarca=mysqli_query($con,"SELECT * FROM inv_marcas WHERE marcaId='$marcaId' LIMIT 1");
	$datMarca=mysqli_fetch_assoc($selMarca);
	$data = array($datMarca['marcaId'],$datMarca['proveedorId'],$datMarca['marca'],);
	echo implode('¬',$data);
?>