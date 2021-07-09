                    <?php include("../../../../../../../lib/config/conect.php");?>
                    <br><br>
                    <h3>Valores adicionales a la Cotización</h3><br>
                    <form class="form-material" name="frmAdicionales" id="frmAdicionales">
                        <input type="hidden" name="cotizacionId" id="cotizacionId" value="<?php echo $_REQUEST["cotizacionId"];?>">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="number" min="1" step="1" class="form-control" name="adiCantidad" id="adiCantidad">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Adicionales</label>
                                    <select class="form-control" name="adicionalId" id="adicionalId">
                                        <option value="">-- Seleccione lo adicional --</option>
                                        <?php
                                            $selAdicional=mysqli_query($con,"SELECT * FROM fac_adicionales");
                                            while($datAdicional=mysqli_fetch_assoc($selAdicional)){
                                        ?>
                                            <option value="<?php echo $datAdicional["adicionalId"]?>">
                                                <?php echo "» ".$datAdicional["adicional"];?>
                                            </option>
                                        <?php }  mysqli_free_result($selAdicional); mysqli_close($con); ?>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Unitario</label>
                                    <input type="number" min="0.01" onkeyup="multi()" step="0.01" class="form-control" name="unitario" id="unitario">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="number" class="form-control" name="total" id="total" readonly>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-success" id="agregarAdicionales">
                                        <i class="fa fa-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br><br><br>
                    </form>


                    <div id="loadTablaAdicional">

                    </div>

                    <script>
                        $(document).ready(function(){
                            var cotizacionId = $("#cotizacionId").val();
                            cargarTablaAdicional(cotizacionId);


                            $("#agregarAdicionales").click(function() {
                                var selectAdicional = $("#adicionalId option:selected").html();

                                if ($("#adiCantidad").val()==""){
                                    sweetealerta('Error!','Debe ingresar la CANTIDAD','error');
                                } if (selectAdicional=="-- Seleccione lo adicional --"){
                                    sweetealerta('Error!','Debe seleccionar el SISTEMA','error');
                                } if ($("#unitario").val()==""){
                                    sweetealerta('Error!','Debe ingresar el valor UNITARIO','error');
                                } else {
                                    var url = "../../modelo/insert?id=INS-ADICIONAL";
                                    $.ajax({
                                        type: "POST",
                                        url: url,
                                        data: $("#frmAdicionales").serialize(),
                                        beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                        success: function(data){

                                            datos = data.split("¬");
                                            var res = datos[0];
                                            var cotizacionId = datos[1];

                                            if(res==1){
                                                sweerAlertProceso();
                                                limpiarForm();
                                                cargarTablaAdicional(cotizacionId);
                                            } else if (res==2){
                                                sweetealerta('Un momento!','Este adicional YA EXISTE en esta COTIZACION','warning');
                                            }
                                        }
                                    });
                                }
                            });
                        });

                        function eliminarAdicional(adicionalId,cotizacionId){
                            var cotizacionId = cotizacionId;
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
                                var url = "../../modelo/delete?id=DEL-ADICIONAL&adicionalId="+adicionalId;
                                $.ajax({
                                    type:"POST",
                                    url:url,
                                    beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                    data:{x:'x'},
                                    success:function(data){

                                        if(data==1){
                                            cargarTablaAdicional(cotizacionId);
                                            sweerAlertProceso();
                                        }
                                    }
                                })
                            })
                        }

                        function limpiarForm(){
                            document.frmAdicionales.adiCantidad.value="";
                            document.frmAdicionales.adicionalId.value="";
                            document.frmAdicionales.unitario.value="";
                            document.frmAdicionales.total.value="";
                        }

                        function cargarTablaAdicional(cotizacionId){
                            var cotizacionId=cotizacionId;
                            cargando('Cargando Contenido...')
                            $("#loadTablaAdicional").load("load/formularios/agregar/tablaAdicional?cotizacionId="+cotizacionId, function() {
                                swal.close();
                            });
                        };

                        function multi(){
                            var cantidad = document.getElementsByName("adiCantidad")[0].value;
                            var unitario = document.getElementsByName("unitario")[0].value;

                            if (cantidad!=0 || unitario!=0){
                                var multi = (parseFloat(cantidad) * parseFloat(unitario));
                                document.getElementsByName('total')[0].value=parseFloat(multi);
                            }
                        }
                    </script>

