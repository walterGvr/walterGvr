'use-strict'

$(document).ready(function(){
	$("#guardar").click(function() {
		let selectProveedor = $("#proveedorId option:selected").html();
		let selectMarca = $("#marcaId option:selected").html();
		let selectLinea = $("#lineaId option:selected").html();
		let selectBodega = $("#bodegaId option:selected").html();

		if (selectProveedor=="-- Seleccione el proveedor --"){
			sweetealerta('Error!','Debe seleccionar el PROVEEDOR','error');
		} else if (selectMarca=="-- Seleccione la marca --"){
			sweetealerta('Error!','Debe seleccionar la MARCA','error');
		} else if (selectLinea=="-- Seleccione la linea --"){
			sweetealerta('Error!','Debe seleccionar la LINEA','error');
		} else if ($("#producto").val()==""){
			sweetealerta('Error!','Debe ingresar el NOMBRE del producto','error');
		} else if ($("#exMin").val()==""){
			sweetealerta('Error!','Debe ingresar la EXISTENCIA MINIA del producto','error');
		} else if ($("#exMax").val()==""){
			sweetealerta('Error!','Debe ingresar la EXISTENCIA MAXIMA del producto','error');
		} else if ($("#exActual").val()==""){
			sweetealerta('Error!','Debe ingresar la EXISTENCIA ACTUAL del producto','error');
		} else if (selectBodega=="-- Seleccione la bodega --"){
			sweetealerta('Error!','Debe seleccionar la BODEGA en la que almacenerá el producto','error');
		} else if ($("#precio").val()==""){
			sweetealerta('Error!','Debe seleccionar la BODEGA en la que almacenerá el producto','error');
		} else {
			var url = "../../modelo/insert?id=INS-PRODUCTO";
			$.ajax({
				type: "POST",
				url: url,
				data: $("#frmProductos").serialize(),
				beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
				success: function(data){
					if(data==1){
						sweerAlertProceso();
						cargarBusquedaInsert();
					} else if (data==2){
						sweetealerta('Un momento!','El PRODUCTO ya EXISTE, intente con otro.','warning');
					}
				}
			});
		}
	});

	$("#regresar").click(function(){
		cargarBusqueda();
	});

	$("#editarProductos").click(function(){
		var url = "../../modelo/update?id=UPD-PRODUCTO";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#frmEditProductos").serialize(),
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
    $("#root").load("load/principales/bqProductos", function() {
        swal.close();
    });
};

function cargarBusquedaInsert(){
	cargando('Cargando Contenido...')
    $("#root").load("load/principales/bqProductos", function() {
        swal.close();
    });
};

