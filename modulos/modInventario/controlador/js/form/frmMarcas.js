'use-strict'

$(document).ready(function(){
	$("#guardar").click(function() {
		var selProveedor = $("#proveedorId option:selected").html();

		if (selProveedor=="-- Seleccione el Proveedor --"){
			sweetealerta('Error!','Debe seleccionar EL PROVEEDOR de la Marca','error');
		} else if ($("#marca").val()==""){
			sweetealerta('Error!','Debe ingresar la MARCA','error');
		} else {
			var url = "../../modelo/insert?id=INS-MARCA";
			$.ajax({
				type: "POST",
				url: url,
				data: $("#frmMarcas").serialize(),
				beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
				success: function(data){
					if(data==1){
						sweerAlertProceso();
						cargarBusquedaInsert();
					} else if (data==2){
						sweetealerta('Un momento!','Esta MARCA ya está ASOCIADA a este PROVEEDOR','warning');
					}
				}
			});
		}
	});

	$("#regresar").click(function(){
		cargarBusqueda();
	});

	$("#editarMarca").click(function(){
		var url = "../../modelo/update?id=UPD-MARCA";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#frmEditMarcas").serialize(),
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
    $("#root").load("load/principales/bqMarcas", function() {
        swal.close();
    });
};

function cargarBusquedaInsert(){
	cargando('Cargando Contenido...')
    $("#root").load("load/formularios/agregar/marcas", function() {
        swal.close();
    });
};

