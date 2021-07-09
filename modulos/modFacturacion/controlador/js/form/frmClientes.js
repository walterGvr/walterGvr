'use-strict'

$(document).ready(function(){
	$("#guardar").click(function() {
		var selectRol = $("#rolId option:selected").html();

		if ($("#nombres").val()==""){
			sweetealerta('Error!','Debe ingresar el NOMBRE','error');
		} else if ($("#apellidos").val()==""){
			sweetealerta('Error!','Debe ingresar el PRIMER APELLIDO','error');
		} else {
			var url = "../../modelo/insert?id=INS-CLIENTE";
			$.ajax({
				type: "POST",
				url: url,
				data: $("#frmCliente").serialize(),
				beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
				success: function(data){
					if(data==1){
						sweerAlertProceso();
						cargarBusqueda();
					} else if (data==2){
						sweetealerta('Un momento!','El cliente YA EXISTE','warning');
					}
				}
			});
		}
	});

	$("#regresar").click(function(){
		cargarBusqueda();
	});

	$("#editarCliente").click(function(){
		var url = "../../modelo/update?id=UPD-CLIENTE";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#frmEditCliente").serialize(),
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
    $("#root").load("load/principales/bqClientes", function() {
        swal.close();
    });
};

