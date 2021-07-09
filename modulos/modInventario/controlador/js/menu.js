$(document).ready(function() {
	//cargar pagina principal al cargar
	$("#root").load("load/principal");

	$("#inicio").click(function(e) {
		e.preventDefault();
		cargando('Cargando Contenido...')
		$("#root").load("load/principal", function() {
			swal.close();
		});
	});

	$("#principal").click(function(e) {
		e.preventDefault();
		cargando('Cargando Contenido...')
		$("#root").load("load/principal", function() {
			swal.close();
		});
	});

	$("#usuarios").click(function(e) {
		e.preventDefault();
		cargando('Cargando Contenido...')
		$("#root").load("load/principales/bqUsuario", function() {
			swal.close();
		});
	});


	$("#bodegas").click(function(e) {
		e.preventDefault();
		cargando('Cargando Contenido...')
		$("#root").load("load/principales/bqBodegas", function() {
			swal.close();
		});
	});

	$("#proveedores").click(function(e) {
		e.preventDefault();
		cargando('Cargando Contenido...')
		$("#root").load("load/principales/bqProveedores", function() {
			swal.close();
		});
	});

	$("#marcas").click(function(e) {
		e.preventDefault();
		cargando('Cargando Contenido...')
		$("#root").load("load/principales/bqMarcas", function() {
			swal.close();
		});
	});

	$("#lineas").click(function(e) {
		e.preventDefault();
		cargando('Cargando Contenido...')
		$("#root").load("load/principales/bqLineas", function() {
			swal.close();
		});
	});

	$("#productos").click(function(e) {
		e.preventDefault();
		cargando('Cargando Contenido...')
		$("#root").load("load/principales/bqProductos", function() {
			swal.close();
		});
	});

	$("#compNacionales").click(function(e) {
		e.preventDefault();
		cargando('Cargando Contenido...')
		$("#root").load("load/principales/bqNacionales", function() {
			swal.close();
		});
	});

	$("#compInternacionales").click(function(e) {
		e.preventDefault();
		cargando('Cargando Contenido...')
		$("#root").load("load/principales/bqInternacionales", function() {
			swal.close();
		});
	});

	$("#impReportes").click(function(e) {
		e.preventDefault();
		cargando('Cargando Contenido...')
		$("#root").load("load/principales/bqReportes", function() {
			swal.close();
		});
	});

	$("#permisos").click(function(e) {
		e.preventDefault();
		cargando('Cargando Contenido...')
		$("#root").load("load/principales/bqPermisos", function() {
			swal.close();
		});
	});
});