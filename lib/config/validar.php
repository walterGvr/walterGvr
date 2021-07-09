<?php
session_start();
include("conect.php");

//VALORES QUE TRAEN LAS VARIABLES CON EL METODO POST DEL FORMULARIO LOGIN
$usuario=$_POST["usuario"];
$contrasena=$_POST['clave'];
$md5Clave=strtoupper(md5($contrasena)); //ENCRIPTA LA CLAVE EN MAYUSCULAS.

//SELECCIOANAR LOS DATOS DEL USUARIO
$selUsuario=mysqli_query($con,"SELECT * FROM co_usuarios WHERE usuario='$usuario' AND estado='1' LIMIT 1");
$datUsuario=mysqli_fetch_assoc($selUsuario);

//SELECCIOANAR EL ROL
$selRol=mysqli_query($con,"SELECT rolId FROM co_roles WHERE rolId='$datUsuario[rolId]' LIMIT 1");
$datRol=mysqli_fetch_assoc($selRol);

if($md5Clave==$datUsuario['clave']){
	$clave=$datUsuario['clave'];}
else{
	$clave="XYZ123";
}

/*-------------------------------------------------------------------------------------------------------------*/

if ($usuario==$datUsuario["usuario"] and $clave==$datUsuario["clave"]){
	$_SESSION["seguridad"]="1";
	$_SESSION["rolId"]=$datRol["rolId"];
	$_SESSION["usuarioId"]=$datUsuario["usuarioId"];
	$_SESSION["usuario"]=$datUsuario["usuario"];
	$_SESSION["nombres"]=$datUsuario["nombres"];
	$_SESSION["apellidos"]=$datUsuario["apellidos"];

	mysqli_free_result($selUsuario);
	mysqli_free_result($selRol);
	mysqli_close($con);
	echo "1";
} else {
	mysqli_free_result($selUsuario);
	mysqli_free_result($selRol);
	mysqli_close($con);
	echo "2";
}

?>