<?php  
	include('../../../../lib/config/conect.php');

	$proveedorId= $_POST['mdl_add_proveedorId'];

	$selProve=mysqli_query($con,"SELECT * FROM inv_proveedores WHERE proveedorId='$proveedorId' LIMIT 1");
	$datProve=mysqli_fetch_assoc($selProve);
	$data = array($datProve['proveedorId'],$datProve['tipoProveedor'],$datProve['nombre'],$datProve['email'],$datProve['telefono'],$datProve['sitioWeb']);
	echo implode('¬',$data);
?>