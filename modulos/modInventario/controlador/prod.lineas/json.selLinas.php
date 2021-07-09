
<?php
    include('../../../../lib/config/conect.php');

    $q=$_GET['q'];

    $selLineas=mysqli_query($con, "SELECT * FROM inv_lineas WHERE linea LIKE '%".$q."%' LIMIT 15");
    $json = [];

    while($row=mysqli_fetch_array($selLineas)){
        $json[] = ['id'=>$row['lineaId'], 'text'=>$row['linea']];
    }

    echo json_encode($json);
?>