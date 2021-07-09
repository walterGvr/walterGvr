                    <?php
                        include("../../../../../../../lib/config/conect.php");
                    ?>
                    <br><br>
                    <h3>Detalle del Sistema</h3><br>
                    <form class="form-material" name="frmSistemaDetalle" id="frmSistemaDetalle">
                        <input type="hidden" name="sistemaId" id="sistemaId" value="<?php echo $_REQUEST["sistemaId"];?>">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="number" min="1" step="1" value="0" class="form-control" name="cantidad" id="cantidad">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Buscar Producto (Con Precios)</label>
                                    <select class="form-control" name="precioId" id="precioId">
                                        <option value="">-- Seleccione el producto (Precio) --</option>
                                        <?php
                                            $selPrecio=mysqli_query($con,"SELECT * FROM view_producto_precio");
                                            while($datPrecio=mysqli_fetch_assoc($selPrecio)){
                                        ?>
                                            <option value="<?php echo $datPrecio["precioId"]."¬".$datPrecio["precio"] ?>">
                                                <?php echo "» ".$datPrecio["producto"]." | $ ".$datPrecio["precio"];?>
                                            </option>
                                        <?php }  mysqli_free_result($selPrecio); mysqli_close($con); ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-success" id="agregarLista">
                                        <i class="fa fa-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br><br><br>
                    </form>


                    <div id="loadTablaDetalle">

                    </div>

                    <script>
                        $(document).ready(function(){
                            var sistemaId = $("#sistemaId").val();
                            cargarTablaDetalle(sistemaId);


                            $("#agregarLista").click(function() {
                                var selectProducto = $("#precioId option:selected").html();

                                if ($("#cantidad").val()==""){
                                    sweetealerta('Error!','Debe ingresar la CANTIDAD','error');
                                } if (selectProducto=="-- Seleccione el producto (Precio) --"){
                                    sweetealerta('Error!','Debe seleccionar el PRODUCTO (Precio)','error');
                                } else {
                                    var url = "../../modelo/insert?id=INS-SDETALLE";
                                    $.ajax({
                                        type: "POST",
                                        url: url,
                                        data: $("#frmSistemaDetalle").serialize(),
                                        beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                        success: function(data){

                                            datos = data.split("¬");
                                            var res = datos[0];
                                            var sistemaId = datos[1];

                                            if(res==1){
                                                sweerAlertProceso();
                                                limpiarForm();
                                                cargarTablaDetalle(sistemaId);
                                            } else if(res==2) {
                                                sweetealerta('Un momento!','Este PRODUCTO ya está agregado en este SISTEMA...','warning');
                                            }
                                        }
                                    });
                                }
                            });
                        });

                        function eliminarSDetalle(sistemaDetalleId,sistemaId){
                            var sistemaId = sistemaId;
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
                                var url = "../../modelo/delete?id=DEL-SDETALLE&sistemaDetalleId="+sistemaDetalleId;
                                $.ajax({
                                    type:"POST",
                                    url:url,
                                    beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                    data:{x:'x'},
                                    success:function(data){

                                        if(data==1){
                                            cargarTablaDetalle(sistemaId);
                                            sweerAlertProceso();
                                        }
                                    }
                                })
                            })
                        }

                        function cargarTablaDetalle(sistemaId){
                            var sistemaId=sistemaId;
                            cargando('Cargando Contenido...')
                            $("#loadTablaDetalle").load("load/formularios/agregar/tablaSDetalle?sistemaId="+sistemaId, function() {
                                swal.close();
                            });
                        };

                        function limpiarForm(){
                            document.frmSistemaDetalle.cantidad.value="";
                            document.frmSistemaDetalle.precioId.value="";
                        }


                    </script>

