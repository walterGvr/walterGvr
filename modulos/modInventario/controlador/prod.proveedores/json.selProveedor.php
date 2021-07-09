
<?php
    include('../../../../lib/config/conect.php');

    $q=$_GET['q'];

    $selProve=mysqli_query($con, "SELECT * FROM inv_proveedores WHERE nombre LIKE '%".$q."%' LIMIT 15");
    $json = [];

    while($row=mysqli_fetch_assoc($selProve)){
        $json[] = ['id'=>$row['proveedorId'], 'text'=>$row['nombre']];
    }

    echo json_encode($json);
?>