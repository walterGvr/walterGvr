                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Tipo de clientes
                            </h3>

                            <p>Buscar clientes activos e inactivos en el sistema.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqTipoCliente" id="bqTipoCliente">
                                    <small>Buscar por: Tipo de cliente</small>
                                </div>
                            </form>

                            <div id="loadTblTipoCliente"></div>

                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxTipoCliente.js"></script>
                    <script>
                        'use strict'
                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqTipoCliente", function() {
                                swal.close();
                            });
                        }

                        function editarTipoCliente(tipoClienteId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/tipoCliente?tipoClienteId="+tipoClienteId, function() {
                                swal.close();
                            });
                        }
                    </script>

