'use-strict'

$(document).ready(function() {
    var usuarioId = $("#usuarioId").val();
    cargarTablaPermisos(usuarioId);

    $("#guardar").click(function() {
        var usuarioId = $("#usuarioId").val();
        var selectModulo = $("#moduloId option:selected").html();

        if (selectModulo == "-- Seleccione el modulo --") {
            sweetealerta('Error!', 'Debe seleccionar EL MODULO', 'error');
        } else {
            var url = "../../modelo/insert?id=INS-PERMISO";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#frmPermisos").serialize(),
                beforeSend: function(object) { sweetwait('Por favor espere...', 'Se está procesando la petición', 'info'); },
                success: function(data) {
                    if (data == 1) {
                        sweerAlertProceso();
                        cargarTablaPermisos(usuarioId);
                    } else if (data == 2) {
                        sweetealerta('Un momento!', 'Este USUARIO ya tienen PERMISO para este MODULO.', 'warning');
                    }
                }
            });
        }
    });

    $("#regresar").click(function() {
        cargarBusqueda();
    });
});

function cargarBusqueda() {
    cargando('Cargando Contenido...')
    $("#root").load("load/principales/bqUsuario", function() {
        swal.close();
    });
};

function cargarTablaPermisos(usuarioId) {
    cargando('Cargando Contenido...')
    $("#loadTblPermisos").load("load/formularios/agregar/tablaPermisos?usuarioId=" + usuarioId, function() {
        swal.close();
    });
}

function eliminarPermiso(id, usuarioId) {
    swal({
        title: '¿Eliminar?',
        text: "La información eliminada no se podra recuperar!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e53935',
        cancelButtonColor: '#d7d7d7',
        confirmButtonText: 'Si, eliminar!',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then(function() {
        var url = "../../modelo/delete?id=DEL-PERMISO&permisoId=" + id + "&usuarioId=" + usuarioId;
        $.ajax({
            type: "POST",
            url: url,
            beforeSend: function(object) { sweetwait('Por favor espere...', 'Se está procesando la petición', 'info'); },
            data: { x: 'x' },
            success: function(data) {

                datos = data.split("¬");
                var res = datos[0];
                var usuarioId = datos[1];

                if (res == 1) {
                    cargarTablaPermisos(usuarioId);
                    sweerAlertProceso();
                }
            }
        })
    })
}