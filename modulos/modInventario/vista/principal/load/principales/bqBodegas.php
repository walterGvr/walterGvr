                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Bodegas
                                <button class="btn btn-success" id="frmBodegas">
                                    <i class="fa fa-plus"></i> Bodegas
                                </button>
                            </h3>

                            <p>Buscar bodegas en el sistema.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqBodegas" id="bqBodegas">
                                    <small>Buscar por: Nombre de bodega</small>
                                </div>
                            </form>

                            <div id="loadTblBodegas"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxBodegas.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmBodegas").click(function(){
                                cargarFormulario();
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/bodegas", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqBodegas", function() {
                                swal.close();
                            });
                        }

                        function editarBodega(bodegaId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/bodegas?bodegaId="+bodegaId, function() {
                                swal.close();
                            });
                        }

                        function eliminarBodega(id){
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
                                var url = "../../modelo/delete?id=DEL-BODEGA&bodegaId="+id;
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
                                            sweetealerta('Un momento!','No puede eliminar esta bodega porque tiene productos asociados...','warning');
                                        }
                                    }
                                })
                            })
                        }
                    </script>

