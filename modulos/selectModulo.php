<?php
	session_start();
	include("../lib/config/conect.php");
	include("../lib/config/seguridadSelect.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Seleccionar</title>
	<link rel="shortcut icon" href="../lib/assets/sysTemplate/assets/images/icon.png">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../lib/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../lib/assets/css/all.min.css" rel="stylesheet">
	<link href="../lib/assets/css/app.css" rel="stylesheet">
</head>
<body>

	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		<a class="navbar-brand" href="#">EINSOFT</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="../lib/config/cerrar"> <i class="fa fa-sign-out-alt"></i> Cerrar Sesión</a>
				</li>
			</ul>

			<span style="color: white;">| Bienvenido/a: <b><?php echo $_SESSION["nombres"] ?></b></span>
		</div>
	</nav>

	<main role="main" class="container" id="root">

		<div class="starter-template">
			<h1>Sistema de Inventario y Facturación</h1>
			<p class="lead">
				Esta herramienta le ayudará a gestionar su inventario<br>
				y le facilitará la gestión de sus ventas y cotizaciones.
			</p>
		</div>

		<div class="row mb-2">
			<?php
				$selPermisos=mysqli_query($con,"SELECT * FROM view_permisos WHERE usuarioId='$_SESSION[usuarioId]'");
				while($datPermisos=mysqli_fetch_assoc($selPermisos)){
			?>
				<div class="col-md-6" id="<?php echo $datPermisos["identificador"]?>">
				<div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
					<div class="col p-4 d-flex flex-column position-static">
						<strong class="d-inline-block mb-2 text-primary">EinSoft</strong>
						<h3 class="mb-0">Módulo <br> <?php echo $datPermisos["nombre"]?></h3>
						<p class="card-text mb-auto"><?php echo $datPermisos["descripcion"]?></p>
						<a href="#" class="stretched-link">Ir al módulo</a>
					</div>
					<div class="col-auto d-none d-lg-block">
						<img src="../lib/assets/images/<?php echo $datPermisos["img"]?>" alt="<?php echo $datPermisos["nombre"]?>">
					</div>
				</div>
				</div>
			<?php } ?>
		</div>

	</main>

	<script src="../lib/assets/js/jquery-3.4.1.min.js"></script>
    <script src="../lib/assets/js/bootstrap.min.js"></script>
    <script>
    	'use strict'
    	$(document).ready(function(){
    		$("#modInventario").click( () => {
    			location.href ="../lib/config/redirect?rqModulo=modInventario";
    		});

    		$("#modFacturacion").click( () => {
    			location.href ="../lib/config/redirect?rqModulo=modFacturacion";
    		});

			$("#modContabilidad").click( () => {
    			location.href ="../lib/config/redirect?rqModulo=modContabilidad";
    		});
    	});
    </script>
</body>
</html>