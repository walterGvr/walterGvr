'use-strict'

$(document).ready(function() {
    $("#agregarDetalleManual").click(function() {
        var selectCliente = $("#clienteId option:selected").html();

        if (selectCliente == "-- Seleccione el cliente --") {
            sweetealerta('Error!', 'Debe seleccionar al CLIENTE', 'error');
        } else if ($("#lugarEntrega").val() == "") {
            sweetealerta('Error!', 'Debe ingresar el LUGAR DE LA ENTREGA', 'error');
        } else if ($("#tiempoEntrega").val() == "") {
            sweetealerta('Error!', 'Debe ingresar el TIEMPO DE ENTREGA', 'error');
        } else if ($("#garantia").val() == "") {
            sweetealerta('Error!', 'Debe ingresar la GARANTIA', 'error');
        } else if ($("#validez").val() == "") {
            sweetealerta('Error!', 'Debe ingresar la VALIDEZ', 'error');
        } else if ($("#atencionA").val() == "") {
            sweetealerta('Error!', 'Debe ingresar con ATENCION A', 'error');
        } else if ($("#email").val() == "") {
            sweetealerta('Error!', 'Debe ingresar el CORREO ELECTRONICO', 'error');
        } else if ($("#telefono").val() == "") {
            sweetealerta('Error!', 'Debe ingresar el TELEFONO', 'error');
        } else if ($("#condicionesPago").val() == "") {
            sweetealerta('Error!', 'Debe ingresar las CONDICIONES DE PAGO', 'error');
        } else if ($("#cantidadMetros").val() == "") {
            sweetealerta('Error!', 'Debe ingresar la CANTIDAD DE METROS cuadrados', 'error');
        } else if ($("#descripcion").val() == "") {
            sweetealerta('Error!', 'Debe ingresar la DESCRIPCIÓN', 'error');
        } else {
            var url = "../../modelo/insert?id=INS-COTIZACION-MANUAL";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#frmCotizacionManual").serialize(),
                beforeSend: function(object) { sweetwait('Por favor espere...', 'Se está procesando la petición', 'info'); },
                success: function(data) {

                    datos = data.split("¬");
                    var res = datos[0];
                    var cotizacionManualId = datos[1];

                    if (res == 1) {
                        sweerAlertProceso();
                        ocultarBoton();
                        cargarCotizacionDetalleManual(cotizacionManualId);
                    } else if (res == 2) {
                        sweetealerta('Un momento!', 'Este sistema YA EXISTE intente con otro', 'warning');
                    }
                }
            });
        }
    });

    $("#regresar").click(function() {
        cargarBusqueda();
    });

    $("#editarCotizacionManual").click(function() {
        var url = "../../modelo/update?id=UPD-COTIZACION-MANUAL";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#frmEditarCotizacionManual").serialize(),
            beforeSend: function(object) { sweetwait('Por favor espere...', 'Se está procesando la petición', 'info'); },
            success: function(data) {

                datos = data.split("¬");
                var res = datos[0];

                if (res == 1) {
                    sweerAlertProceso();
                }

            }
        });
    });


    $('.cotClientes').select2({
        placeholder: '-- Seleccione el cliente --',
        tags: true,
        minimumInputLength: 2,
        ajax: {
            url: '../../controlador/cot.producto/json.selCliente.php',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });//select con busqueda ajax, php, json
});

function cargarCotizacionDetalleManual(cotizacionManualId) {
    var cotizacionManualId = cotizacionManualId;
    cargando('Cargando Contenido...')
    $("#cotizacionDetalleManual").load("load/formularios/agregar/cotizacionDetalleManual?cotizacionManualId=" + cotizacionManualId, function() {
        swal.close();
    });
};


function cargarBusqueda() {
    cargando('Cargando Contenido...')
    $("#root").load("load/principales/bqCotizacionManual", function() {
        swal.close();
    });
};

function ocultarBoton() {
    $("#agregarDetalleManual").hide();
}