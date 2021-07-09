                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Clientes
                                <button class="btn btn-success" id="frmClientes">
                                    <i class="fa fa-plus"></i> Clientes
                                </button>
                            </h3>

                            <p>Buscar clientes activos e inactivos en el sistema.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqClientes" id="bqClientes">
                                    <small>Buscar por: Nombre o usuario</small>
                                </div>
                            </form>

                            <div id="loadTblClientes"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxClientes.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmClientes").click(function(){
                                cargarFormulario();
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/clientes", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqClientes", function() {
                                swal.close();
                            });
                        }

                        function editarCliente(clienteId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/clientes?clienteId="+clienteId, function() {
                                swal.close();
                            });
                        }

                        function eliminarCliente(id){
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
                                var url = "../../modelo/delete?id=DEL-CLIENTE&clienteId="+id;
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
                                            sweetealerta('Un momento!','No puede eliminar este usuario, porque se encontraron datos en otra tabla...','warning');
                                        }
                                    }
                                })
                            })
                        }
                    </script>

