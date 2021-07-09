'use-strict'

$(document).ready(function(){
	$("#guardar").click(function() {
		var tipoBodega = $("#tipoBodega option:selected").html();

		if (tipoBodega=="-- Seleccione el tipo --"){
			sweetealerta('Error!','Debe seleccionar EL TIPO DE LA BODEGA','error');
		} else if ($("#bodega").val()==""){
			sweetealerta('Error!','Debe ingresar el NOMBRE DE LA BODEGA','error');
		} else if ($("#direccion").val()==""){
			sweetealerta('Error!','Debe ingresar la DIRECCION','error');
		}  else if ($("#telefono").val()==""){
			sweetealerta('Error!','Debe ingresar el TELEFONO','error');
		} else {
			var url = "../../modelo/insert?id=INS-BODEGA";
			$.ajax({
				type: "POST",
				url: url,
				data: $("#frmBodegas").serialize(),
				beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
				success: function(data){
					if(data==1){
						sweerAlertProceso();
						cargarBusqueda();
					} else if (data==2){
						sweetealerta('Un momento!','El nombre del Bodega ya existe','warning');
					}
				}
			});
		}
	});

	$("#regresar").click(function(){
		cargarBusqueda();
	});

	$("#editarBodega").click(function(){
		var url = "../../modelo/update?id=UPD-BODEGA";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#frmEditBodega").serialize(),
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
    $("#root").load("load/principales/bqBodegas", function() {
        swal.close();
    });
};
