'use-strict'

$(document).ready(function(){
	
	$("#regresar").click(function(){
		cargarBusqueda();
	});

	$("#editarTipoCliente").click(function(){
		var url = "../../modelo/update?id=UPD-TIPOCLIENTE";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#frmEditTipoCliente").serialize(),
			beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
			success: function(data){
				if(data==1){
					sweerAlertProceso();
					cargarBusqueda();
				}
			}
		});
	});
});

function cargarBusqueda(){
	cargando('Cargando Contenido...')
    $("#root").load("load/principales/bqTipoCliente", function() {
        swal.close();
    });
};

