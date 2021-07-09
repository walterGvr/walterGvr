                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Proveedores
                                <button class="btn btn-success" id="frmProveedor">
                                    <i class="fa fa-plus"></i> Proveedor
                                </button>
                            </h3>

                            <p>Buscar proveedores en el sistema.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqProveedores" id="bqProveedores">
                                    <small>Buscar por: Nombre del provedor</small>
                                </div>
                            </form>

                            <div id="loadTblProveedor"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxProveedor.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmProveedor").click(function(){
                                cargarFormulario();
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/proveedores", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqProveedores", function() {
                                swal.close();
                            });
                        }

                        function editarProveedor(proveedorId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/proveedores?proveedorId="+proveedorId, function() {
                                swal.close();
                            });
                        }

                        function eliminarProveedor(id){
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
                                var url = "../../modelo/delete?id=DEL-PROVEEDOR&proveedorId="+id;
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
                                            sweetealerta('Un momento!','No puede eliminar este Proveedor, porque se encontraron datos en otra tabla...','warning');
                                        }
                                    }
                                })
                            })
                        }
                    </script>

