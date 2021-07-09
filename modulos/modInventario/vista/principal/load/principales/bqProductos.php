                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Productos
                                <button class="btn btn-success" id="frmProductos">
                                    <i class="fa fa-plus"></i> Producto
                                </button>
                            </h3>

                            <p>Buscar productos en el sistema.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqProductos" id="bqProductos">
                                    <small>Buscar por: Producto, marca o proveedor</small>
                                </div>
                            </form>

                            <div id="loadTblProductos"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxProducto.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmProductos").click(function(){
                                cargarFormulario();
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/productos", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqProductos", function() {
                                swal.close();
                            });
                        }

                        function editarProducto(productoId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/productos?productoId="+productoId, function() {
                                swal.close();
                            });
                        }

                        function eliminarProducto(id){
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
                                var url = "../../modelo/delete?id=DEL-PRODUCTO&productoId="+id;
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
                                            sweetealerta('Un momento!','No puede eliminar este PRODUCTO, porque tiene DATOS asociados...','warning');
                                        }
                                    }
                                })
                            })
                        }
                    </script>

