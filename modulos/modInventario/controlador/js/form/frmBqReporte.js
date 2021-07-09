'use strict'
$(document).ready(function(){
    $("#selectProducto").hide();

    $("#reporte").change(function() {
        if($(this).val() == "repBarras") {
            $("#selectProducto").show();
        }
        else {
            $("#selectProducto").hide();
        }
    });

    $("#imprimirReporte").click(function(){
        var selReporte = $("#reporte option:selected").html();

        if (selReporte=="-- Seleccione el reporte --"){
            sweetealerta('Error!','Debe seleccionar EL REPORTE','error');
        } else {
            var reporte = $("#reporte").val();
            var productoId = $("#productoId").val();

            switch(reporte){
                case 'repBarras':
                    window.open('../reportes/repBarras?productoId=+'+productoId+"&reporte="+reporte, '_blank');
                break;

                case 'repInventario':
                    window.open('../reportes/repInventario', '_blank');
                break;

                default:
                    console.log("NO SE GENERO ACCION");

            }



        }

    });
});