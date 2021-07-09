                    <?php
                        include("../../../../../../../lib/config/conect.php");
                        $selRetaceo=mysqli_query($con,"SELECT * FROM inv_retaceo WHERE compraId='$_REQUEST[compraId]' LIMIT 1");
                        if ($datRetaceo=mysqli_fetch_assoc($selRetaceo)){
                            $retaceoHecho="1";
                        } else {
                            $retaceoHecho="0";
                        }
                    ?>
                    <br><br>
                    <h3>Agregar Trámites</h3><br>
                    <form class="form-material" name="frmTramites" id="frmTramites">
                        <input type="hidden" name="compraId" id="compraId" value="<?php echo $_REQUEST["compraId"];?>">
                        <input type="hidden" name="retaceo" id="retaceo" value="<?php echo $retaceoHecho;?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Trámites</label>
                                    <input type="text" class="form-control" name="tramite" id="tramite">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="number" min="1" step="1" class="form-control" name="cantidadTramite" id="cantidadTramite">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>P. Unitario</label>
                                    <input type="number" onkeyup="multi2();" min="0.01" step="0.01" class="form-control" name="valorUnitarioTramite" id="valorUnitarioTramite">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" class="form-control" name="totalTramite" id="totalTramite" readonly>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="button" class="btn btn-success" id="agregarTramite">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br><br><br>
                    </form>


                    <div id="loadTablaTramite">

                    </div>


                    <button type="button" class="btn btn-warning" id="agregarRetaceo">
                        <i class="fa fa-cog"></i> AGREGAR RETACEO
                    </button>



                    <script>
                        $(document).ready(function(){
                            var compraId = $("#compraId").val();
                            cargarTablaTramite(compraId);

                            var retaceoHecho = $("#retaceo").val();
                            if (retaceoHecho==1){
                                $("#agregarRetaceo").hide();
                            } else if (retaceoHecho==0) {
                                $("#agregarRetaceo").show();
                            }

                            $("#agregarRetaceo").click(function(){
                                var compraId = $("#compraId").val();
                                agregarRetaceo(compraId);
                                $("#agregarRetaceo").hide();
                            });


                            $("#agregarTramite").click(function() {

                                if ($("#cantidadTramite").val()==""){
                                    sweetealerta('Error!','Debe ingresar la CANTIDAD en el TRAMITE','error');
                                } else if ($("#valorUnitarioTramite").val()==""){
                                    sweetealerta('Error!','Debe ingresar el VALOR UNITARIO en el TRAMITE','error');
                                } else {
                                    var url = "../../modelo/insert?id=INS-TRAMITE";
                                    $.ajax({
                                        type: "POST",
                                        url: url,
                                        data: $("#frmTramites").serialize(),
                                        beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                        success: function(data){

                                            datos = data.split("¬");
                                            var res = datos[0];
                                            var compraId = datos[1];

                                            if(res==1){
                                                sweerAlertProceso();
                                                limpiarFormTramite();
                                                $("#agregarRetaceo").show();
                                                cargarTablaTramite(compraId);
                                            }
                                        }
                                    });
                                }
                            });
                        });

                        function agregarRetaceo(compraId){
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
                                var url = "../../controlador/retaceo?compraId="+compraId;
                                $.ajax({
                                    type:"POST",
                                    url:url,
                                    beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                    data:{x:'x'},
                                    success:function(data){
                                        if(data==1){
                                            $("#agregarRetaceo").hide();
                                            cargarTablaDetalle(compraId);
                                            cargarTablaTramite(compraId);
                                            sweerAlertProceso();
                                        }
                                    }
                                })
                            })
                        }

                        function eliminarTramite(id,compId){
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
                                var url = "../../modelo/delete?id=DEL-TRAMITE&tramiteId="+id+"&compraId="+compId;
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
                                            cargarTablaTramite(compraId);
                                            sweerAlertProceso();
                                        }
                                    }
                                })
                            })
                        }

                        function limpiarFormTramite(){
                            document.frmTramites.cantidadTramite.value="";
                            document.frmTramites.valorUnitarioTramite.value="";
                            document.frmTramites.totalTramite.value="";
                        }

                        function cargarTablaTramite(compraId){
                            var compraId=compraId;
                            cargando('Cargando Contenido...')
                            $("#loadTablaTramite").load("load/formularios/agregar/tablaTramite?compraId="+compraId, function() {
                                swal.close();
                            });
                        };

                        function multi2(){
                            var cantidadTramite = document.getElementsByName("cantidadTramite")[0].value;
                            var valorUnitarioTramite = document.getElementsByName("valorUnitarioTramite")[0].value;

                            if (cantidadTramite!=0 || valorUnitarioTramite!=0){
                                var multiTramite = (parseFloat(cantidadTramite) * parseFloat(valorUnitarioTramite));
                                document.getElementsByName('totalTramite')[0].value=parseFloat(multiTramite);
                            }
                        }
                    </script>

