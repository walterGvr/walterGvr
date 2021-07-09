$(document).ready(function() {
    //cargar pagina principal al cargar
    $("#root").load("load/principal");

    $("#principal").click(function(e) {
        e.preventDefault();
        cargando('Cargando Contenido...')
        $("#root").load("load/principal", function() {
            swal.close();
        });
    });

    $("#clientes").click(function(e) {
        e.preventDefault();
        cargando('Cargando Contenido...')
        $("#root").load("load/principales/bqClientes", function() {
            swal.close();
        });
    });

    $("#tipoClientes").click(function(e) {
        e.preventDefault();
        cargando('Cargando Contenido...')
        $("#root").load("load/principales/bqTipoCliente", function() {
            swal.close();
        });
    });

    $("#precios").click(function(e) {
        e.preventDefault();
        cargando('Cargando Contenido...')
        $("#root").load("load/principales/bqPrecios", function() {
            swal.close();
        });
    });

    $("#sistemas").click(function(e) {
        e.preventDefault();
        cargando('Cargando Contenido...')
        $("#root").load("load/principales/bqSistemas", function() {
            swal.close();
        });
    });

    $("#cotizacion-sistemas").click(function(e) {
        e.preventDefault();
        cargando('Cargando Contenido...')
        $("#root").load("load/principales/bqCotizacion", function() {
            swal.close();
        });
    });

    $("#cotizacion-manual").click(function(e) {
        e.preventDefault();
        cargando('Cargando Contenido...')
        $("#root").load("load/principales/bqCotizacionManual", function() {
            swal.close();
        });
    });

    $("#prueba1").click(function(e) {
        e.preventDefault();
        cargando('Cargando Contenido...')
        $("#root").load("load/principales/bqPrueba1", function() {
            swal.close();
        });
    });

});