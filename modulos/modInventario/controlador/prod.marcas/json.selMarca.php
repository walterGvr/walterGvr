
<?php
    include('../../../../lib/config/conect.php');

    $q=$_GET['q'];

    $selMarca=mysqli_query($con, "SELECT * FROM inv_marcas WHERE marca LIKE '%".$q."%' LIMIT 15");
    $json = [];

    while($row=mysqli_fetch_array($selMarca)){
        $json[] = ['id'=>$row['marcaId'], 'text'=>$row['marca']];
    }

    echo json_encode($json);
?>