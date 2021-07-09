$(document).ready(function() {
    $("#btnEditar").css({display:'none'});

    //Cuando cargue el documento que me cargue tambien las modales, aunque las vuelva a cargar despues.
    $("#add-modal-marca").load("load/formularios/agregar/add.modales/add.marca");
    $("#add-modal-linea").load("load/formularios/agregar/add.modales/add.linea");

    //Codigo para guardar los datos del proveedor que se muestran en la modal
    $("#guardarProveedor").click(function() {
        var tipoProveedor = $("#mdl_add_tipoProveedor option:selected").html();

        if (tipoProveedor=="-- Seleccione el tipo --"){
            sweetealerta('Error!','Debe seleccionar EL TIPO de Proveedor','error');
        } else if ($("#mdl_add_nombre").val()==""){
            sweetealerta('Error!','Debe ingresar el NOMBRE del Proveedor','error');
        } else {
            var url = "../../modelo/insert?id=INS-PROVEEDOR-MDL";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#frmAddProveedor").serialize(),
                success: function(data){
                    if(data=='2'){
                        sweetealerta('¡ALERTA!','Ya existe un proveedor con los mismos datos.','warning');
                    }else{
                        refrescarSelectProveedor(data,$("#mdl_add_nombre").val());
                        //limpiarModal();
                        $("#add-modal-marca").load("load/formularios/agregar/add.modales/add.marca");                        
                        $('#mdlAddProveedor').modal('toggle');
                        sweetealerta('¡ÉXITO!','Proveedor agregado con éxito','success');
                    }
                }
            });
        }
    });


    //Codigo para editar los datos del proveedor que se muestran en la modal
    $("#editarProveedor").click(function() {
        let prod_proveedorId = document.getElementById("prod_proveedorId").value;
        
        $.ajax({
            type: "POST",                                    
            data: $("#frmEditProveedor").serialize(),
            url: "../../modelo/update?id=UPD-PROVEEDOR-MDL",
            success: function(data){
                $('#proveedorId option[value="'+prod_proveedorId+'"]').remove(); 
                refrescarSelectProveedor(data,$("#mdl_edit_nombre").val());
                //limpiarModal();
                $('#mdlEditProveedor').modal('toggle');
                sweetealerta('¡ÉXITO!','Proveedor modificado con éxito','success');
            }
        });
    });
});

//refrescar select de patrocinadores
function refrescarSelectProveedor(id,nombre){       
    document.frmAddProveedor.mdl_add_proveedorId.value=id;

    let s=document.frmProductos.proveedorId; 
    let option=document.createElement("option"); 
    option.value=id; 
    option.text=nombre; 
    //s.appendChild(option) // añadir nuevo registro a select

    $('#btnEditar').css({display:'block'});
    $('#btnAgregar').css({display:'none'});

    $("#proveedorId option[value="+ id +"]").attr("selected",true);

    
    $.ajax({
        type: "POST",
        data: $("#frmAddProveedor").serialize(),
        url: "../../controlador/prod.proveedores/java.selProveedor.php",    
        success: function (data){
            let datos = data.split("¬");
            document.frmProductos.prod_proveedorId.value=datos[0];
            document.frmProductos.prod_tipoProveedor.value=datos[1];
            document.frmProductos.prod_nombre.value=datos[2];
            document.frmProductos.prod_email.value=datos[3];
            document.frmProductos.prod_telefono.value=datos[4];
            document.frmProductos.prod_sitioWeb.value=datos[5];            
        }
    });
}

//Boton para agregar al proveedor si no existe
$('#btnAgregar').click(function(){
    var select = $('#proveedorId option:selected').html();
    $("#respuestaModal").hide(100)
    //limpiarModal();

    if(select!='-- Seleccione el proveedor --'){
        document.frmAddProveedor.mdl_add_nombre.value = select;
    }else{}
});

$('#mdlAddProveedor').on('shown.bs.modal', function () {
    $('#nombre').trigger('focus')
});//Autofocus para modal

function limpiarModal(){
    $("#frmAddProveedor")[0].reset();
}                        

$('.proveedor').select2({
    placeholder: '-- Seleccione el proveedor --',
    tags: true,
    minimumInputLength: 2,
    ajax: {
        url: '../../controlador/prod.proveedores/json.selProveedor.php',
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
function mostrarBtns(){
    let select = document.getElementById("proveedorId").value;
    let string=$('#proveedorId option:selected').html();

    //alert('Esto es del select: ' + select + ' y esto es del string ' + string);

    if(string==select){
        $('#btnEditar').css({display:'none'});
        $('#btnAgregar').css({display:'block'});
    }else{
        document.frmAddProveedor.mdl_add_proveedorId.value=select;

        $.ajax({
            type: "POST",
            data: $("#frmAddProveedor").serialize(),
            url: "../../controlador/prod.proveedores/java.selProveedor.php",                                    
            success: function (data){
                var datos = data.split("¬");
                document.frmProductos.prod_proveedorId.value=datos[0];
                document.frmProductos.prod_tipoProveedor.value=datos[1];
                document.frmProductos.prod_nombre.value=datos[2];
                document.frmProductos.prod_email.value=datos[3];
                document.frmProductos.prod_telefono.value=datos[4];
                document.frmProductos.prod_sitioWeb.value=datos[5];
            }
        });

        $('#btnEditar').css({display:'block'});
        $('#btnAgregar').css({display:'none'});   
    }
}

//funcion para copiar los datos del proveedor en el modal
function copiar(){
    document.frmEditProveedor.mdl_edit_proveedorId.value = $('#prod_proveedorId').val();
    document.frmEditProveedor.mdl_edit_tipoProveedor.value = $('#prod_tipoProveedor').val();
    document.frmEditProveedor.mdl_edit_nombre.value = $('#prod_nombre').val();
    document.frmEditProveedor.mdl_edit_email.value = $('#prod_email').val();
    document.frmEditProveedor.mdl_edit_telefono.value = $('#prod_telefono').val();
    document.frmEditProveedor.mdl_edit_sitioWeb.value = $('#prod_sitioWeb').val();                            
}

$('#mdlEditProveedor').on('shown.bs.modal', function () {
    $('#mdl_edit_nombre').focus();
    //$("#respuestaModalEdit").hide(100)
});