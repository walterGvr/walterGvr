                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Precios
                                <button class="btn btn-success" id="frmPrecios">
                                    <i class="fa fa-plus"></i> Agregar Precio
                                </button>
                            </h3>

                            <p>Buscar Precio de los productos en el sistema.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqPrecios" id="bqPrecios">
                                    <small>Buscar por: Nombre de producto</small>
                                </div>
                            </form>

                            <div id="loadTblPrecios"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxPrecios.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmPrecios").click(function(){
                                cargarFormulario();
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/precio", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqPrecios", function() {
                                swal.close();
                            });
                        }

                        function editarPrecio(precioId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/precio?precioId="+precioId, function() {
                                swal.close();
                            });
                        }

                        function eliminarPrecio(id){
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
                                var url = "../../modelo/delete?id=DEL-PRECIO&precioId="+id;
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

