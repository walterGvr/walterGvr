'use-strict'

$(document).ready(function(){
	$("#agregarDetalle").click(function() {
		if ($("#nombreSistema").val()==""){
			sweetealerta('Error!','Debe ingresar el NOMBRE DEL SISTEMA','error');
		} else {
			var url = "../../modelo/insert?id=INS-SISTEMA";
			$.ajax({
				type: "POST",
				url: url,
				data: $("#frmSistema").serialize(),
				beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
				success: function(data){

					datos = data.split("¬");
					var res = datos[0];
					var sistemaId = datos[1];

					if(res==1){
						sweerAlertProceso();
						ocultarBoton();
						cargarSistemaDetalle(sistemaId);
					} else if (res==2) {
						sweetealerta('Un momento!','Este sistema YA EXISTE intente con otro','warning');
					}
				}
			});
		}
	});

	$("#regresar").click(function(){
		cargarBusqueda();
	});

	$("#guardarSistema").click(function(){
		var url = "../../modelo/update?id=UPD-SISTEMA";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#frmEditSistema").serialize(),
			beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
			success: function(data){

				datos = data.split("¬");
				var res = datos[0];

				if(res==1){
					sweerAlertProceso();
				}

			}
		});
	});
});

function cargarSistemaDetalle(sistemaId){
	var sistemaId = sistemaId;
	cargando('Cargando Contenido...')
    $("#sistemaDetalle").load("load/formularios/agregar/sistemaDetalle?sistemaId="+sistemaId, function() {
        swal.close();
    });
};

function cargarBusqueda(){
	cargando('Cargando Contenido...')
    $("#root").load("load/principales/bqSistemas", function() {
        swal.close();
    });
};

function ocultarBoton(){
	$("#agregarDetalle").hide();
}

