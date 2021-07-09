
<?php
    include('../../../../lib/config/conect.php');

    $q=$_GET['q'];

    $selClientes=mysqli_query($con, "SELECT * FROM fac_clientes WHERE nombres LIKE '%".$q."%' OR apellidos LIKE '%".$q."%' LIMIT 15");
    $json = [];

    while($row=mysqli_fetch_array($selClientes)){
        $json[] = ['id'=>$row['clienteId'], 'text'=>$row['nombres']." ".$row['apellidos']];
    }

    echo json_encode($json);
?>