                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Sistemas
                                <button class="btn btn-success" id="frmSistema">
                                    <i class="fa fa-plus"></i> Agregar Sistema
                                </button>
                            </h3>

                            <p>Buscar Sistemas en el listado.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqSistemas" id="bqSistemas">
                                    <small>Buscar por: Nombre de producto</small>
                                </div>
                            </form>

                            <div id="loadTblSistemas"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxSistemas.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmSistema").click(function(){
                                cargarFormulario();
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/sistema", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqSistemas", function() {
                                swal.close();
                            });
                        }

                        function editarSistema(sistemaId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/sistema?sistemaId="+sistemaId, function() {
                                swal.close();
                            });
                        }

                        function eliminarSistema(id){
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
                                var url = "../../modelo/delete?id=DEL-SISTEMA&sistemaId="+id;
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
                                            sweetealerta('Un momento!','No puede eliminar este SISTEMA, porque se encontraron datos en otra tabla...','warning');
                                        }
                                    }
                                })
                            })
                        }
                    </script>

