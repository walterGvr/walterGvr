                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Buscar / Compras Nacionales
                                <button class="btn btn-success" id="frmNacionales">
                                    <i class="fa fa-plus"></i> Agregar Compra Nacional
                                </button>

                                <a href="#" target="_blank" class="btn btn-warning" style="margin-left: 5px; color: white" data-toggle="modal" data-target="#mdlComprasNac">
                                    <i class="fa fa-print"></i> Imprimir Compras
                                </a>
                            </h3>

                            <p>Buscar compras nacionales en el sistema.</p>

                            <form class="form-material">
                                <div style="margin-top: 10px;">
                                    <input onkeyup="loadXMLDoc()" type="text" class="form-control" name="bqNacionales" id="bqNacionales">
                                    <small>Buscar por: Fecha, Numero de Factura o Proveedor</small>
                                </div>
                            </form>

                            <div id="loadTblNacionales"></div>

                        </div>
                    </div>
                    <div class="modal fade" id="mdlComprasNac" name="mdlComprasNac" tabindex="-1" role="dialog" aria-labelledby="mdlComprasNac" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form name="frmRepCompraNac" id="frmRepCompraNac">
                                    <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Reporte - Compras nacionales</h4>
                                    </div>
                                    <div class="modal-body">                
                                        <div class="row">
                                            <input type="hidden" name="mdl_add_lineaId" id="mdl_add_lineaId" value=""/>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Desde</label>
                                                    <input type="date" class="form-control" name="desde" id="desde">
                                                </div>

                                                <div class="form-group">
                                                    <label>Hasta</label>
                                                    <input type="date" class="form-control" name="hasta" id="hasta">
                                                </div>
                                            </div>
                                        </div>                
                                    </div>                
                                    
                                    <div class="modal-footer">
                                        <button type="button" id="repNacionales" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Generar Reporte
                                        </button>

                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            <i class="fa fa-close"></i> Cerrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script src="load/ajax/ajaxArchivos/ajaxNacionales.js"></script>
                    <script>
                        'use strict'
                        $(document).ready(function(){
                            $("#frmNacionales").click(function(){
                                cargarFormulario();
                            });

                            $("#repNacionales").click(function() {
                                
                                let desde = $("#desde").val();
                                let hasta = $("#hasta").val();

                                if ($("#desde").val()==""){
                                    sweetealerta('Error!','Debe ingresar LA FECHA INICIAL','error');
                                } else if ($("#hasta").val()==""){
                                    sweetealerta('Error!','Debe ingresar LA FECHA FINAL','error');
                                } else {
                                    window.open("../reportes/repComprasNacionales.php?desde="+desde+"&hasta="+hasta, "Reporte de compras", "width=860, height=640");
                                    //window.location.href = "../reportes/repComprasNacionales.php?desde="+desde+"&hasta="+hasta";
                                }
                            });
                        });

                        function cargarFormulario() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/agregar/nacionales", function() {
                                swal.close();
                            });
                        }

                        function cargarBusqueda() {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/principales/bqNacionales", function() {
                                swal.close();
                            });
                        }

                        function editarNacional(compraId) {
                            cargando('Cargando Contenido...')
                            $("#root").load("load/formularios/editar/nacionales?compraId="+compraId, function() {
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

