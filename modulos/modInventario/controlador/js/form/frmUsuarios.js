'use-strict'

$(document).ready(function(){
	$("#guardar").click(function() {
		var selectRol = $("#rolId option:selected").html();

		if ($("#nombres").val()==""){
			sweetealerta('Error!','Debe ingresar el NOMBRE','error');
		} else if ($("#apellidos").val()==""){
			sweetealerta('Error!','Debe ingresar el PRIMER APELLIDO','error');
		}  else if ($("#usuario").val()==""){
			sweetealerta('Error!','Debe ingresar el USUARIO','error');
		} else if ($("#clave").val()==""){
			sweetealerta('Error!','Debe ingresar la CLAVE','error');
		} else if (selectRol=="-- Seleccione el Rol --"){
			sweetealerta('Error!','Debe seleccionar EL ROL','error');
		} else {
			var url = "../../modelo/insert?id=INS-USUARIO";
			$.ajax({
				type: "POST",
				url: url,
				data: $("#frmUsuario").serialize(),
				beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
				success: function(data){
					if(data==1){
						sweerAlertProceso();
						cargarBusqueda();
					} else if (data==2){
						sweetealerta('Un momento!','El usuario YA EXISTE, cambie el USUARIO.','warning');
					}
				}
			});
		}
	});

	$("#regresar").click(function(){
		cargarBusqueda();
	});

	$("#editarUsuario").click(function(){
		var url = "../../modelo/update?id=UPD-USUARIO";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#frmEditUsuario").serialize(),
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
    $("#root").load("load/principales/bqUsuario", function() {
        swal.close();
    });
};

