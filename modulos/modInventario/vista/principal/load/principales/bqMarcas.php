                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Marcas
                                <button class="btn btn-success" id="frmMarcas">
                                    <i class="fa fa-plus"></i> Marca
                                </button>
                            </h3>

                            <p>Buscar marcas en el sistema.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqMarcas" id="bqMarcas">
                                    <small>Buscar por: Marca o Proveedor</small>
                                </div>
                            </form>

                            <div id="loadTblMarcas"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxMarca.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmMarcas").click(function(){
                                cargarFormulario();
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/marcas", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqMarcas", function() {
                                swal.close();
                            });
                        }

                        function editarMarca(marcaId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/marcas?marcaId="+marcaId, function() {
                                swal.close();
                            });
                        }

                        function eliminarMarca(id){
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
                                var url = "../../modelo/delete?id=DEL-MARCA&marcaId="+id;
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
                                            sweetealerta('Un momento!','No puede eliminar esta MARCA, porque tiene LINEAS asociadas...','warning');
                                        }
                                    }
                                })
                            })
                        }
                    </script>

