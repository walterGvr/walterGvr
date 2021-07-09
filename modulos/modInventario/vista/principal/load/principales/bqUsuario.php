                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Usuarios
                                <button class="btn btn-success" id="frmUsuario">
                                    <i class="fa fa-plus"></i> Usuario
                                </button>
                            </h3>

                            <p>Buscar usuarios activos e inactivos en el sistema.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqUsuario" id="bqUsuario">
                                    <small>Buscar por: Nombre o usuario</small>
                                </div>
                            </form>

                            <div id="loadTblUsuario"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxUsuario.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmUsuario").click(function(){
                                cargarFormulario();
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/usuarios", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqUsuario", function() {
                                swal.close();
                            });
                        }

                        function editarUsuario(usuarioId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/usuarios?usuarioId="+usuarioId, function() {
                                swal.close();
                            });
                        }

                        function permisosUsuarios(usuarioId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/permisos?usuarioId="+usuarioId, function() {
                                swal.close();
                            });
                        }

                        function eliminarUsuario(id){
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
                                var url = "../../modelo/delete?id=DEL-USUARIO&usuarioId="+id;
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

