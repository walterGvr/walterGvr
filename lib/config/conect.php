<?php
	/*$server="localhost:3306";
	$user="dentalme_31ns0ft";
	$pass="eXrav6rY0+L5";
	$bd="dentalme_eDentalmed";*/

	$server="localhost";
	$user="root";
	$pass="";
	$bd="dentalmed";

	$con=mysqli_connect("$server","$user","$pass")or die ("Error al conectar con el Servidor");
	mysqli_select_db($con,"$bd");

	mysqli_query ($con,"SET NAMES 'utf8'");
	date_default_timezone_set('America/El_Salvador');
?>