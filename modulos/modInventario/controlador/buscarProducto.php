<?php
	include ("../../../lib/config/conect.php");

    $searchTerm = $_GET['term'];

    $query = mysqli_query($con, "
        SELECT *
        FROM inv_producto
        WHERE codigo LIKE '%".$searchTerm."%'
            OR producto LIKE '%".$searchTerm."%'
            ORDER BY codigo ASC") or die ('ERROR: '.mysqli_error($con));

    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row['productoId']."--".$row['codigo']."--".$row['producto'];
    }

    echo json_encode($data);


?>