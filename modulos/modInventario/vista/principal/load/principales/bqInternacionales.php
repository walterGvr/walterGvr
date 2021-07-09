                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Compras Internacionales
                                <button class="btn btn-success" id="frmInternacionales">
                                    <i class="fa fa-plus"></i> Agregar Compra Internacional
                                </button>
                            </h3>

                            <p>Buscar compras Internacionales en el sistema.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqInternacionales" id="bqInternacionales">
                                    <small>Buscar por: Fecha, Numero de Factura o Proveedor</small>
                                </div>
                            </form>

                            <div id="loadTblInternacionales"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxInternacionales.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmInternacionales").click(function(){
                                cargarFormulario();
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/internacionales", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqInternacionales", function() {
                                swal.close();
                            });
                        }

                        function editarInternacional(compraId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/internacionales?compraId="+compraId, function() {
                                swal.close();
                            });
                        }

                        function eliminarInternacional(id){
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
                                var url = "../../modelo/delete?id=DEL-NACIONAL&compraId="+id;
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

