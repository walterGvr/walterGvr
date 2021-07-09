                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Lineas
                                <button class="btn btn-success" id="frmLineas">
                                    <i class="fa fa-plus"></i> Linea
                                </button>
                            </h3>

                            <p>Buscar líneas en el sistema.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqLineas" id="bqLineas">
                                    <small>Buscar por: Nombre de lineas, marca o proveedor</small>
                                </div>
                            </form>

                            <div id="loadTblLineas"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxLinea.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmLineas").click(function(){
                                cargarFormulario();
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/lineas", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqLineas", function() {
                                swal.close();
                            });
                        }

                        function editarLinea(lineaId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/lineas?lineaId="+lineaId, function() {
                                swal.close();
                            });
                        }

                        function eliminarLinea(id){
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
                                var url = "../../modelo/delete?id=DEL-LINEA&lineaId="+id;
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
                                            sweetealerta('Un momento!','No puede eliminar esta LINEA, porque tiene PRODUCTOS asociados...','warning');
                                        }
                                    }
                                })
                            })
                        }
                    </script>

