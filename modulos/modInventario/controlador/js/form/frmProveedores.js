'use-strict'

$(document).ready(function(){
	$("#guardar").click(function() {
		var tipoProveedor = $("#tipoProveedor option:selected").html();

		if (tipoProveedor=="-- Seleccione el tipo --"){
			sweetealerta('Error!','Debe seleccionar EL TIPO de Proveedor','error');
		} else if ($("#nombre").val()==""){
			sweetealerta('Error!','Debe ingresar el NOMBRE del Proveedor','error');
		} else if ($("#email").val()==""){
			sweetealerta('Error!','Debe ingresar el EMAIL del Proveedor','error');
		} else if ($("#direccion").val()==""){
			sweetealerta('Error!','Debe ingresar la DIRECCION del Proveedor','error');
		}  else if ($("#telefono").val()==""){
			sweetealerta('Error!','Debe ingresar el TELEFONO del Proveedor','error');
		} else {
			var url = "../../modelo/insert?id=INS-PROVEEDOR";
			$.ajax({
				type: "POST",
				url: url,
				data: $("#frmProveedor").serialize(),
				beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
				success: function(data){
					if(data==1){
						sweerAlertProceso();
						cargarBusqueda();
					} else if (data==2){
						sweetealerta('Un momento!','El nombre del Proveedor ya existe','warning');
					}
				}
			});
		}
	});

	$("#regresar").click(function(){
		cargarBusqueda();
	});

	$("#editarProveedor").click(function(){
		var url = "../../modelo/update?id=UPD-PROVEEDOR";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#frmEditProveedor").serialize(),
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
    $("#root").load("load/principales/bqProveedores", function() {
        swal.close();
    });
};

