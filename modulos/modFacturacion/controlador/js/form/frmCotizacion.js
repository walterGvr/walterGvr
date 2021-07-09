'use-strict'

$(document).ready(function() {
    $("#agregarDetalle").click(function() {
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
        } else {
            var url = "../../modelo/insert?id=INS-COTIZACION";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#frmCotizacion").serialize(),
                beforeSend: function(object) { sweetwait('Por favor espere...', 'Se está procesando la petición', 'info'); },
                success: function(data) {

                    datos = data.split("¬");
                    var res = datos[0];
                    var cotizacionId = datos[1];

                    if (res == 1) {
                        sweerAlertProceso();
                        ocultarBoton();
                        cargarCotizacionDetalle(cotizacionId);
                        cargarAdicionales(cotizacionId);
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

    $("#editarCotizacion").click(function() {
        var url = "../../modelo/update?id=UPD-COTIZACION";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#frmEditarCotizacion").serialize(),
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
});

function cargarCotizacionDetalle(cotizacionId) {
    var cotizacionId = cotizacionId;
    cargando('Cargando Contenido...')
    $("#cotizacionDetalle").load("load/formularios/agregar/cotizacionDetalle?cotizacionId=" + cotizacionId, function() {
        swal.close();
    });
};


function cargarAdicionales(cotizacionId) {
    var cotizacionId = cotizacionId;
    cargando('Cargando Contenido...')
    $("#adicionales").load("load/formularios/agregar/adicionales?cotizacionId=" + cotizacionId, function() {
        swal.close();
    });
};


function cargarBusqueda() {
    cargando('Cargando Contenido...')
    $("#root").load("load/principales/bqCotizacion", function() {
        swal.close();
    });
};

function ocultarBoton() {
    $("#agregarDetalle").hide();
}