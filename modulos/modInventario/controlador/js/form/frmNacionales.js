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
			var url = "../../modelo/insert?id=INS-NACIONAL";
			$.ajax({
				type: "POST",
				url: url,
				data: $("#frmNacionales").serialize(),
				beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
				success: function(data){

					datos = data.split("¬");
					var res = datos[0];
					var compraId = datos[1];

					if(res==1){
						sweerAlertProceso();
						ocultarBoton();
						cargarNacionalesDetalle(compraId);
					}
				}
			});
		}
	});


	$("#editarEncabezado").click(function() {
		var url = "../../modelo/update?id=UPD-ENCABEZADO";

		$.ajax({
			type: "POST",
			url: url,
			data: $("#frmEditNacionales").serialize(),
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

function cargarNacionalesDetalle(compraId){
	var compraId = compraId;
	cargando('Cargando Contenido...')
    $("#nacionalesDetalle").load("load/formularios/agregar/nacionalesDetalle?compraId="+compraId, function() {
        swal.close();
    });
};


function cargarBusqueda(){
	cargando('Cargando Contenido...')
    $("#root").load("load/principales/bqNacionales", function() {
        swal.close();
    });
};

function ocultarBoton(){
	$("#agregarDetalle").hide();
}

