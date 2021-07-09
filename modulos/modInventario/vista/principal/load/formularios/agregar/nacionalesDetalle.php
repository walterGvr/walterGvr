                    <?php
                        include("../../../../../../../lib/config/conect.php");
                        $selProrrateo=mysqli_query($con,"
                            SELECT * FROM inv_compradetalle
                            WHERE compraId='$_REQUEST[compraId]' AND retaceoEfectuado='1'");
                        if ($datProrrateo=mysqli_fetch_assoc($selProrrateo)){
                            $prorrateoHecho="1";
                        } else {
                            $prorrateoHecho="0";
                        }
                    ?>
                    <br><br>
                    <h3>Detalle de la Compra Nacional</h3><br>
                    <form class="form-material" name="frmDetalleNacional" id="frmDetalleNacional">
                        <input type="hidden" name="compraId" id="compraId" value="<?php echo $_REQUEST["compraId"];?>">
                        <input type="hidden" name="prorrateoHecho" id="prorrateoHecho" value="<?php echo $prorrateoHecho?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Buscar Producto</label>
                                    <select class="producto form-control" name="productoId" id="productoId">
                                        <option value="">-- Seleccione el producto --</option>                                        
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="number" min="1" step="1" class="form-control" name="cantidad" id="cantidad">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>P. Unitario</label>
                                    <input type="number" onkeyup="multi();" min="0.01" step="0.01" class="form-control" name="valorUnitario" id="valorUnitario">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" class="form-control" name="total" id="total" readonly>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="button" class="btn btn-success" id="agregarLista">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br><br><br>
                    </form>


                    <div id="loadTablaDetalle">

                    </div>


                    <button type="button" class="btn btn-warning" id="agregarProrateo">
                        <i class="fa fa-cog"></i> AGREGAR LOS PRODUCTOS AL INVENTARIO
                    </button>



                    <script>
                        $(document).ready(function(){
                            var compraId = $("#compraId").val();
                            cargarTablaDetalle(compraId);

                            var prorrateoHecho = $("#prorrateoHecho").val();
                            if (prorrateoHecho==1){
                                $("#agregarProrateo").hide();
                            } else if (prorrateoHecho==0) {
                                $("#agregarRetaceo").show();
                            }

                            $("#agregarProrateo").click(function(){
                                var compraId = $("#compraId").val();
                                agregarProrateo(compraId);
                                $("#agregarProrateo").hide();
                            })

                            $("#agregarLista").click(function() {
                                var selectProducto = $("#productoId option:selected").html();

                                if (selectProducto=="-- Seleccione el producto --"){
                                    sweetealerta('Error!','Debe ingresar el PRODUCTO','error');
                                } else if ($("#cantidad").val()==""){
                                    sweetealerta('Error!','Debe ingresar la CANTIDAD','error');
                                } else if ($("#valorUnitario").val()==""){
                                    sweetealerta('Error!','Debe ingresar el VALOR UNITARIO','error');
                                } else {
                                    var url = "../../modelo/insert?id=INS-DETALLE";
                                    $.ajax({
                                        type: "POST",
                                        url: url,
                                        data: $("#frmDetalleNacional").serialize(),
                                        beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                        success: function(data){

                                            datos = data.split("¬");
                                            var res = datos[0];
                                            var compraId = datos[1];

                                            if(res==1){
                                                sweerAlertProceso();
                                                limpiarForm();
                                                $("#agregarProrateo").show();
                                                cargarTablaDetalle(compraId);
                                            }
                                        }
                                    });
                                }
                            });
                        });

                        $('.producto').select2({
                            placeholder: '-- Seleccione el producto --',
                            tags: true,
                            minimumInputLength: 2,
                            ajax: {
                                url: '../../controlador/comp.nacionales/json.selProducto.php',
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

                        function agregarProrateo(compraId){
                            swal({
                                title: '¿Desea agregar los Productos al Inventario?',
                                text: "Los productos se agregarán, se actualizará el costo promedio y las existencias!",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#e53935',
                                cancelButtonColor: '#d7d7d7',
                                confirmButtonText: 'Si, Agregar!',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then(function () {
                                var url = "../../controlador/prorrateo?compraId="+compraId;
                                $.ajax({
                                    type:"POST",
                                    url:url,
                                    beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                    data:{x:'x'},
                                    success:function(data){
                                        if(data==1){
                                            cargarTablaDetalle(compraId);
                                            sweerAlertProceso();
                                        }
                                    }
                                })
                            })
                        }

                        function eliminarRegistro(id,compId){
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
                                var url = "../../modelo/delete?id=DEL-REGISTRO&compraDetalleId="+id+"&compraId="+compId;
                                $.ajax({
                                    type:"POST",
                                    url:url,
                                    beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                    data:{x:'x'},
                                    success:function(data){

                                        datos = data.split("¬");
                                        var res = datos[0];
                                        var compraId = datos[1];


                                        if(res==1){
                                            cargarTablaDetalle(compraId);
                                            sweerAlertProceso();
                                        }
                                    }
                                })
                            })
                        }

                        function limpiarForm(){
                            document.frmDetalleNacional.cantidad.value="";
                            document.frmDetalleNacional.valorUnitario.value="";
                            document.frmDetalleNacional.total.value="";
                        }

                        function cargarTablaDetalle(compraId){
                            var compraId=compraId;
                            cargando('Cargando Contenido...')
                            $("#loadTablaDetalle").load("load/formularios/agregar/tablaDetalle?compraId="+compraId, function() {
                                swal.close();
                            });
                        };

                        function multi(){
                            var cantidad = document.getElementsByName("cantidad")[0].value;
                            var valorUnitario = document.getElementsByName("valorUnitario")[0].value;

                            if (cantidad!=0 || valorUnitario!=0){
                                var multi = (parseFloat(cantidad) * parseFloat(valorUnitario));
                                document.getElementsByName('total')[0].value=parseFloat(multi);
                            }
                        }
                    </script>

