                    <?php 
                        include("../../../../../../../lib/config/conect.php");
                        $selCotizacionManual=mysqli_query($con,"
                            SELECT numCotizacion 
                            FROM fac_cotizacion_manual 
                            WHERE cotizacionManualId='$_REQUEST[cotizacionManualId]' LIMIT 1");
                        $datCotizacionManual=mysqli_fetch_assoc($selCotizacionManual);                    
                    ?>
                    <br><br>                    
                    <h1>Número Cotización: <?php echo $datCotizacionManual["numCotizacion"]?></h1>
                    <h3>
                        Detalle de la Cotización Manual
                        <a target="_blank" href="../reportes/repCotizacionManual.php?cotizacionManualId=<?php echo $_REQUEST['cotizacionManualId'];?>" class="btn btn-primary">
                            <i class="fa fa-print"></i> Imprimir
                        </a>
                    </h3>

                    <br><br>

                    <form class="form-material" name="frmCotizacionDetalleManual" id="frmCotizacionDetalleManual">
                        <input type="hidden" name="cotizacionManualId" id="cotizacionManualId" value="<?php echo $_REQUEST["cotizacionManualId"];?>">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="number" min="1" step="1" class="form-control" value="1" name="cantidad" id="cantidad">
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Producto</label>
                                    <select class="cotProductos form-control" name="productoId" id="productoId">
                                        <option value="">-- Seleccione el producto --</option>                                        
                                    </select>
                                </div>
                            </div>                            
    
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Acción</label><br>
                                    <button type="button" class="btn btn-success" id="agregarListaManual">
                                        <i class="fa fa-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>


                    <div id="loadTablaDetalleManual">

                    </div>

                    <script>
                        $(document).ready(function(){
                            var cotizacionManualId = $("#cotizacionManualId").val();
                            cargarTablaDetalleManual(cotizacionManualId);
                            
                            $("#agregarListaManual").click(function() {
                                var selectProducto = $("#productoId option:selected").html();

                                if ($("#cantidad").val()==""){
                                    sweetealerta('Error!','Debe ingresar la CANTIDAD','error');
                                } else if (selectProducto=="-- Seleccione el producto --"){
                                    sweetealerta('Error!','Debe seleccionar el PRODUCTO','error');
                                } else {
                                    var url = "../../modelo/insert?id=INS-CDETALLE-MANUAL";
                                    $.ajax({
                                        type: "POST",
                                        url: url,
                                        data: $("#frmCotizacionDetalleManual").serialize(),
                                        beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                        success: function(data){

                                            datos = data.split("¬");
                                            var res = datos[0];
                                            var cotizacionManualId = datos[1];

                                            if(res==1){
                                                sweerAlertProceso();
                                                limpiarForm();
                                                cargarTablaDetalleManual(cotizacionManualId);
                                            } else if (res==2) {
                                                sweetealerta('Un momento!','El PRODUCTO seleccionado YA ESTÁ AGREGADO a esta cotización','warning');
                                            }
                                        }
                                    });
                                }
                            });

                            $('.cotProductos').select2({
                                placeholder: '-- Seleccione la linea --',
                                tags: true,
                                minimumInputLength: 2,
                                ajax: {
                                    url: '../../controlador/cot.producto/json.selProducto.php',
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
                        });

                        

                        function eliminarCDetalleManual(id,cotizacionManualId,productoId){
                            var cotizacionManualId = cotizacionManualId;
                            var productoId = productoId;
                            swal({
                                title: '¿Eliminar?',
                                text: "La información eliminada no se podra recuperar!",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#e53935',
                                cancelButtonColor: '#d7d7d7',
                                confirmButtonText: 'Si, eliminar!',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then(function () {
                                var url = "../../modelo/delete?id=DEL-CDETALLE-MANUAL&cotizacionDetalleId="+id+"&cotizacionManualId="+cotizacionManualId+"&productoId="+productoId;
                                $.ajax({
                                    type:"POST",
                                    url:url,
                                    beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                    data:{x:'x'},
                                    success:function(data){

                                        if(data==1){
                                            cargarTablaDetalleManual(cotizacionManualId);
                                            sweerAlertProceso();
                                        }
                                    }
                                })
                            })
                        }

                        function limpiarForm(){
                            document.frmCotizacionDetalleManual.cantidad.value="1";
                            document.frmCotizacionDetalleManual.productoId.value="";
                        }

                        function cargarTablaDetalleManual(cotizacionManualId){
                            var cotizacionManualId=cotizacionManualId;
                            cargando('Cargando Contenido...')
                            $("#loadTablaDetalleManual").load("load/formularios/agregar/tablaCDetalleManual?cotizacionManualId="+cotizacionManualId, function() {
                                swal.close();
                            });
                        };
                    </script>

