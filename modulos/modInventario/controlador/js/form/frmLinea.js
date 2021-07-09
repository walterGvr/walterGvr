'use-strict'

$(document).ready(function(){
	$("#guardar").click(function() {
		var selMarca = $("#marcaId option:selected").html();

		if (selMarca=="-- Seleccione la Marca --"){
			sweetealerta('Error!','Debe seleccionar LA MARCA de la Linea','error');
		} else if ($("#linea").val()==""){
			sweetealerta('Error!','Debe ingresar la LINEA','error');
		} else {
			var url = "../../modelo/insert?id=INS-LINEA";
			$.ajax({
				type: "POST",
				url: url,
				data: $("#frmLineas").serialize(),
				beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
				success: function(data){
					if(data==1){
						sweerAlertProceso();
						cargarBusquedaInsert();
					} else if (data==2){
						sweetealerta('Un momento!','Esta LINEA ya está ASOCIADA a esta MARCA','warning');
					}
				}
			});
		}
	});

	$("#regresar").click(function(){
		cargarBusqueda();
	});

	$("#editarLinea").click(function(){
		var url = "../../modelo/update?id=UPD-LINEA";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#frmEditLineas").serialize(),
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
    $("#root").load("load/principales/bqLineas", function() {
        swal.close();
    });
};

function cargarBusquedaInsert(){
	cargando('Cargando Contenido...')
    $("#root").load("load/formularios/agregar/lineas", function() {
        swal.close();
    });
};

