'use-strict'

$(document).ready(function(){
	$("#guardar").click(function() {
		if ($("#precio").val()==""){
			sweetealerta('Error!','Debe ingresar el PRECIO','error');
		} else {
			var url = "../../modelo/insert?id=INS-PRECIO";
			$.ajax({
				type: "POST",
				url: url,
				data: $("#frmPrecios").serialize(),
				beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
				success: function(data){
					if(data==1){
						sweerAlertProceso();
						cargarBusqueda();
					} else if (data==2){
						sweetealerta('Un momento!','Este producto YA TIENE PRECIO','warning');
					}
				}
			});
		}
	});

	$("#regresar").click(function(){
		cargarBusqueda();
	});

	$("#editarPrecio").click(function(){
		var url = "../../modelo/update?id=UPD-PRECIO";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#frmEditPrecios").serialize(),
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
    $("#root").load("load/principales/bqPrecios", function() {
        swal.close();
    });
};

