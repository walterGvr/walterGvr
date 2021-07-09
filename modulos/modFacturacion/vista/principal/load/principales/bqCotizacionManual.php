                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Cotizaciones Manuales
                                <button class="btn btn-success" id="frmCotizacionManual">
                                    <i class="fa fa-plus"></i> Agregar Cotización
                                </button>
                            </h3>

                            <p>Buscar Cotizaciones elaboradas en el programa.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqCotizacionManual" id="bqCotizacionManual">
                                    <small>Buscar por: </small>
                                </div>
                            </form>

                            <div id="loadTblCotizacionManual"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxCotizacionManual.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmCotizacionManual").click(function(){
                                cargarFormulario();
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/cotizacionManual", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqCotizacionManual", function() {
                                swal.close();
                            });
                        }

                        function editarCotizacionManual(cotizacionManualId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/cotizacionManual?cotizacionManualId="+cotizacionManualId, function() {
                                swal.close();
                            });
                        }

                        function eliminarCotizacionManual(id){
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
                                var url = "../../modelo/delete?id=DEL-COTIZACION-MANUAL&cotizacionManualId="+id;
                                $.ajax({
                                    type:"POST",
                                    url:url,
                                    beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                    data:{x:'x'},
                                    success:function(data){
                                        if(data==1){
                                            cargarBusqueda();
                                            sweerAlertProceso();
                                        } else if (data==2){
                                            sweetealerta('Un momento!','No puede eliminar esta COTIZACION, ya que tiene productos agregados.','warning');
                                        }
                                    }
                                })
                            })
                        }

                        function duplicarCotizacion(cotizacionManualId){
                            swal({
                                title: '¿Duplicar?',
                                text: "Realmente desea duplicar esta cotización!",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#e53935',
                                cancelButtonColor: '#d7d7d7',
                                confirmButtonText: 'Si, Duplicar!',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then(function () {
                                var url = "../../modelo/insert?id=INS-DUPLICAR&cotizacionManualId="+cotizacionManualId;
                                $.ajax({
                                    type:"POST",
                                    url:url,
                                    beforeSend: function(object) {sweetwait('Por favor espere...','Se está procesando la petición','info');},
                                    data:{x:'x'},
                                    success:function(data){
                                        if(data==1){
                                            cargarBusqueda();
                                            sweerAlertProceso();
                                        }
                                    }
                                })
                            })
                        }
                    </script>

