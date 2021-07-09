                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Cotizaciones
                                <button class="btn btn-success" id="frmCotizacion">
                                    <i class="fa fa-plus"></i> Agregar Cotización
                                </button>
                            </h3>

                            <p>Buscar Cotizaciones elaboradas en el programa.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqCotizacion" id="bqCotizacion">
                                    <small>Buscar por: </small>
                                </div>
                            </form>

                            <div id="loadTblCotizacion"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxCotizacion.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmCotizacion").click(function(){
                                cargarFormulario();
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/cotizacion", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqCotizacion", function() {
                                swal.close();
                            });
                        }

                        function editarCotizacion(cotizacionId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/cotizacion?cotizacionId="+cotizacionId, function() {
                                swal.close();
                            });
                        }

                        function eliminarCotizacion(id){
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
                                var url = "../../modelo/delete?id=DEL-COTIZACION&cotizacionId="+id;
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
                                            sweetealerta('Un momento!','No puede eliminar esta cotizacion, porque se convirtioó a factura...','warning');
                                        }
                                    }
                                })
                            })
                        }
                    </script>

