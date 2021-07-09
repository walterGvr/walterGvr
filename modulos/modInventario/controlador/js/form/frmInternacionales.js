'use-strict'

$(document).ready(function(){
	$("#agregarDetalle").click(function() {
		var selectProveedor = $("#proveedorId option:selected").html();

		if ($("#fechaCompra").val()==""){
			sweetealerta('Error!','Debe ingresar la FECHA de la compra','error');
		} else if (selectProveedor=="-- Seleccione el Proveedor --"){
			sweetealerta('Error!','Debe seleccionar el PROVEEDOR de la compra','error');
		} else if ($("#numeroFactura").val()==""){
			sweetealerta('Error!','Debe ingresar el NUMERO DE FACTURA de la compra','error');
		} else if ($("#descripcion").val()==""){
			sweetealerta('Error!','Debe ingresar la DESCRIPCION de la compra','error');
		} else {
			var url = "../../modelo/insert?id=INS-INTERNACIONAL";
			$.ajax({
				type: "POST",
				url: url,
				data: $("#frmInternacionales").serialize(),
				beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
				success: function(data){

					datos = data.split("¬");
					var res = datos[0];
					var compraId = datos[1];

					if(res==1){
						sweerAlertProceso();
						ocultarBoton();
						cargarInternacionalesDetalle(compraId);
						cargarTramites(compraId);
					}
				}
			});
		}
	});


	$("#editarEncabezado").click(function() {
		var url = "../../modelo/update?id=UPD-ENCABEZADOINTER";

		$.ajax({
			type: "POST",
			url: url,
			data: $("#frmEditInternacionales").serialize(),
			beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
			success: function(data){

				datos = data.split("¬");
				var res = datos[0];
				var compraId = datos[1];

				if(res==1){
					sweerAlertProceso();
				}
			}
		});
	});

	$("#regresar").click(function(){
		cargarBusqueda();
	});

});

function cargarInternacionalesDetalle(compraId){
	var compraId = compraId;
	cargando('Cargando Contenido...')
    $("#internacionalesDetalle").load("load/formularios/agregar/internacionalesDetalle?compraId="+compraId, function() {
        swal.close();
    });
};

function cargarTramites(compraId){
	var compraId = compraId;
	cargando('Cargando Contenido...')
    $("#loadTramites").load("load/formularios/agregar/tramites?compraId="+compraId, function() {
        swal.close();
    });
};


function cargarBusqueda(){
	cargando('Cargando Contenido...')
    $("#root").load("load/principales/bqInternacionales", function() {
        swal.close();
    });
};

function ocultarBoton(){
	$("#agregarDetalle").hide();
}

