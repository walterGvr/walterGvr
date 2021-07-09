
<?php
    include('../../../../lib/config/conect.php');

    $q=$_GET['q'];

    $selProducto=mysqli_query($con, "SELECT productoId,producto FROM inv_producto WHERE producto LIKE '%".$q."%' LIMIT 15");
    $json = [];

    while($row=mysqli_fetch_assoc($selProducto)){
        $json[] = ['id'=>$row['productoId'], 'text'=>$row['producto']];
    }

    echo json_encode($json);
?>