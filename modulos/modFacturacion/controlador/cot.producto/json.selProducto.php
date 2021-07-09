<?php
    include('../../../../lib/config/conect.php');

    $q=$_GET['q'];

    $selProductos=mysqli_query($con, "SELECT * FROM view_producto_precio WHERE producto LIKE '%".$q."%' LIMIT 15");
    $json = [];

    while($row=mysqli_fetch_array($selProductos)){
        $json[] = ['id'=>$row['productoId'], 'text'=>$row['producto']];
    }

    echo json_encode($json);
?>