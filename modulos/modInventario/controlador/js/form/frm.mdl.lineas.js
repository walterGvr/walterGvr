$(document).ready(function() {
    $("#btnEditarLinea").css({display:'none'});    
});

//refrescar select de patrocinadores
function refrescarSelectLineas(id,nombre){       
    document.frmAddLinea.mdl_add_lineaId.value=id;

    let s=document.frmProductos.line_lineaId; 
    let option=document.createElement("option"); 
    option.value=id; 
    option.text=nombre; 
    s.appendChild(option) // añadir nuevo registro a select

    $('#btnEditarLinea').css({display:'block'});
    $('#btnAgregarLinea').css({display:'none'});

    $("#lineaId option[value="+ id +"]").attr("selected",true);

    
    $.ajax({
        type: "POST",
        data: $("#frmAddLinea").serialize(),
        url: "../../controlador/prod.lineas/java.selLineas.php",    
        success: function (data){
            let datos = data.split("¬");
            document.frmProductos.line_lineaId.value=datos[0];
            document.frmProductos.line_marcaId.value=datos[1];
            document.frmProductos.line_linea.value=datos[2];
        }
    });
}




//Boton para agregar al proveedor si no existe
$('#btnAgregarLinea').click(function(){
    var select = $('#lineaId option:selected').html();

    if(select!='-- Seleccione la linea --'){
        document.frmAddLinea.mdl_add_linea.value = select;
    }else{}
});

$('#mdlAddLinea').on('shown.bs.modal', function () {
    $('#mdl_add_linea').trigger('focus');
});//Autofocus para modal



$('.linea').select2({
    placeholder: '-- Seleccione la linea --',
    tags: true,
    minimumInputLength: 2,
    ajax: {
        url: '../../controlador/prod.lineas/json.selLinas.php',
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
function mostrarBtnLineas(){
    let select = document.getElementById("lineaId").value;
    let string=$('#lineaId option:selected').html();

    //alert('Esto es del select: ' + select + ' y esto es del string ' + string);

    if(string==select){
        $('#btnEditarLinea').css({display:'none'});
        $('#btnAgregarLinea').css({display:'block'});
    }else{
        document.frmAddLinea.mdl_add_lineaId.value=select;

        $.ajax({
            type: "POST",
            data: $("#frmAddLinea").serialize(),
            url: "../../controlador/prod.lineas/java.selLineas.php",                                    
            success: function (data){
                var datos = data.split("¬");
                document.frmProductos.line_lineaId.value=datos[0];
                document.frmProductos.line_marcaId.value=datos[1];
                document.frmProductos.line_linea.value=datos[2];
            }
        });

        $('#btnEditarLinea').css({display:'block'});
        $('#btnAgregarLinea').css({display:'none'});   
    }
}

//funcion para copiar los datos del proveedor en el modal
function copiarLinea(){
    document.frmEditLinea.mdl_edit_lineaId.value = $('#line_lineaId').val();
    document.frmEditLinea.mdl_edit_marcaId.value = $('#line_marcaId').val();
    document.frmEditLinea.mdl_edit_linea.value = $('#line_linea').val();                           
}