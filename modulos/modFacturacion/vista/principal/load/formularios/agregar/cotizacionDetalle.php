                    <?php include("../../../../../../../lib/config/conect.php");?>
                    <br><br>
                    <h3>Detalle de la Cotización</h3><br>
                    <form class="form-material" name="frmCotizacionDetalle" id="frmCotizacionDetalle">
                        <input type="hidden" name="cotizacionId" id="cotizacionId" value="<?php echo $_REQUEST["cotizacionId"];?>">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="number" min="1" step="1" class="form-control" value="1" name="cantidad" id="cantidad">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Buscar Sistema</label>
                                    <select class="form-control" name="sistemaId" id="sistemaId">
                                        <option value="">-- Seleccione el sistema --</option>
                                        <?php
                                            $selSistema=mysqli_query($con,"SELECT * FROM fac_sistema");
                                            while($datSistema=mysqli_fetch_assoc($selSistema)){
                                        ?>
                                            <option value="<?php echo $datSistema["sistemaId"]?>">
                                                <?php echo "» ".$datSistema["nombreSistema"];?>
                                            </option>
                                        <?php }  mysqli_free_result($selSistema); mysqli_close($con); ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Unidad Medida</label>
                                    <select class="form-control" name="unidadMedida" id="unidadMedida">
                                        <option value="ML" selected>Metros Lineales</option>
                                        <option value="MC" disabled>Metros Cuadrados</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Ancho</label>
                                    <input type="number" min="5" step="1" class="form-control" name="ancho" id="ancho">
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

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Esquinas</label>
                                    <input type="number" class="form-control" value="0" name="esquinas" id="esquinas">
                                </div>                                
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Descansos</label>
                                    <input type="number" class="form-control" value="0" name="descansos" id="descansos">
                                </div>                                
                            </div>
                        </div>
                        <br><br><br>
                    </form>


                    <div id="loadTablaDetalle">

                    </div>

                    <script>
                        $(document).ready(function(){
                            var cotizacionId = $("#cotizacionId").val();
                            cargarTablaDetalle(cotizacionId);                            

                            $("#si").click(function(){
                                $("#cuantas").show();
                            })

                            $("#agregarLista").click(function() {
                                var selectSistema = $("#sistemaId option:selected").html();

                                if ($("#cantidad").val()==""){
                                    sweetealerta('Error!','Debe ingresar la CANTIDAD','error');
                                } else if (selectSistema=="-- Seleccione el sistema --"){
                                    sweetealerta('Error!','Debe seleccionar el SISTEMA','error');
                                } else if ($("#ancho").val()==""){
                                    sweetealerta('Error!','Debe ingresar el ANCHO','error');
                                } else {
                                    var url = "../../modelo/insert?id=INS-CDETALLE";
                                    $.ajax({
                                        type: "POST",
                                        url: url,
                                        data: $("#frmCotizacionDetalle").serialize(),
                                        beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                        success: function(data){

                                            datos = data.split("¬");
                                            var res = datos[0];
                                            var cotizacionId = datos[1];

                                            if(res==1){
                                                sweerAlertProceso();
                                                limpiarForm();
                                                cargarTablaDetalle(cotizacionId);
                                            } else if (res==2) {
                                                sweetealerta('Un momento!','El SISTEMA seleccionado YA ESTÁ AGREGADO a esta cotización','warning');
                                            }
                                        }
                                    });
                                }
                            });
                        });

                        function eliminarCDetalle(id,cotizacionId,sistemaId){
                            var cotizacionId = cotizacionId;
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
                                var url = "../../modelo/delete?id=DEL-CDETALLE&cotizacionDetalleId="+id+"&cotizacionId="+cotizacionId+"&sistemaId="+sistemaId;
                                $.ajax({
                                    type:"POST",
                                    url:url,
                                    beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                    data:{x:'x'},
                                    success:function(data){

                                        if(data==1){
                                            cargarTablaDetalle(cotizacionId);
                                            sweerAlertProceso();
                                        }
                                    }
                                })
                            })
                        }

                        function limpiarForm(){
                            document.frmCotizacionDetalle.cantidad.value="";
                            document.frmCotizacionDetalle.sistemaId.value="";
                            document.frmCotizacionDetalle.unidadMedida.value="";
                            document.frmCotizacionDetalle.valorMedida.value="";
                        }

                        function cargarTablaDetalle(cotizacionId){
                            var cotizacionId=cotizacionId;
                            cargando('Cargando Contenido...')
                            $("#loadTablaDetalle").load("load/formularios/agregar/tablaCDetalle?cotizacionId="+cotizacionId, function() {
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

