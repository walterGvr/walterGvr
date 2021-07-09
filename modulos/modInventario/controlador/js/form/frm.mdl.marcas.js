$(document).ready(function() {
    $("#btnEditarMarca").css({display:'none'});    
});


//Boton para agregar al proveedor si no existe
$('#btnAgregarMarca').click(function(){
    var select = $('#marcaId option:selected').html();
    //$("#respuestaModal").hide(100)
    //limpiarModal();

    if(select!='-- Seleccione la marca --'){
        document.frmAddMarca.mdl_add_marca.value = select;
    }else{}
});

$('#mdlAddMarca').on('shown.bs.modal', function () {
    $('#mdl_add_marca').trigger('focus')
});//Autofocus para modal



$('.marca').select2({
    placeholder: '-- Seleccione el proveedor --',
    tags: true,
    minimumInputLength: 2,
    ajax: {
        url: '../../controlador/prod.marcas/json.selMarca.php',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
});//select con busqueda ajax, php, json


//Función para mostrar/ocultar botones de select proveedor
function mostrarBtnMarcas(){
    let select = document.getElementById("marcaId").value;
    let string=$('#marcaId option:selected').html();

    //alert('Esto es del select: ' + select + ' y esto es del string ' + string);

    if(string==select){
        $('#btnEditarMarca').css({display:'none'});
        $('#btnAgregarMarca').css({display:'block'});
    }else{
        document.frmAddMarca.mdl_add_marcaId.value=select;

        $.ajax({
            type: "POST",
            data: $("#frmAddMarca").serialize(),
            url: "../../controlador/prod.marcas/java.selMarca.php",                                    
            success: function (data){
                var datos = data.split("¬");
                document.frmProductos.marc_marcaId.value=datos[0];
                document.frmProductos.marc_proveedorId.value=datos[1];
                document.frmProductos.marc_marca.value=datos[2];
            }
        });

        $('#btnEditarMarca').css({display:'block'});
        $('#btnAgregarMarca').css({display:'none'});   
    }
}

//funcion para copiar los datos del proveedor en el modal
function copiarMarca(){
    document.frmEditMarca.mdl_edit_marcaId.value = $('#marc_marcaId').val();
    document.frmEditMarca.mdl_edit_proveedorId.value = $('#marc_proveedorId').val();
    document.frmEditMarca.mdl_edit_marca.value = $('#marc_marca').val();                           
}