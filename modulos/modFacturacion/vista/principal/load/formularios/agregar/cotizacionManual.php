                    <?php include("../../../../../../../lib/config/conect.php"); ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Cotización Manual</h3><br>
                            <form class="form-material" name="frmCotizacionManual" id="frmCotizacionManual">
                            <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <select class="cotClientes form-control" name="clienteId" id="clienteId">
                                                <option value="" selected disabled>-- Seleccione el cliente --</option>                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <input type="date" class="form-control" value="<?php echo date("Y-m-d") ?>" name="fecha" id="fecha">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Lugar de Entrega</label>
                                            <input type="text" class="form-control" name="lugarEntrega" id="lugarEntrega">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tiempo de Entrega</label>
                                            <input type="text" class="form-control" name="tiempoEntrega" id="tiempoEntrega">
                                        </div>
                                    </div>
                                </div>

                                <!-- SEGUNDA FILA -->

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Garantía</label>
                                            <input type="text" class="form-control" name="garantia" id="garantia">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Validez</label>
                                            <input type="text" class="form-control" name="validez" id="validez">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Atención A</label>
                                            <input type="text" class="form-control" name="atencionA" id="atencionA">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" id="email">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Telefono</label>
                                            <input type="text" class="form-control" name="telefono" id="telefono">
                                        </div>
                                    </div>
                                </div>

                                <!-- TERCERA FILA -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Condiciones de Pago</label>
                                            <textarea class="form-control" rows="2" name="condicionesPago" id="condicionesPago"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- CUARTA FILA -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Descripción de la cotización</label>
                                            <textarea class="form-control" rows="2" name="descripcion" id="condicionesPago"></textarea>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="agregarDetalleManual">
                                                <i class="fa fa-save"></i> Guardar Información
                                            </button>
                                            <button type="button" class="btn btn-warning" id="regresar" style="margin-left: 5px;">
                                                <i class="fa fa-arrow-left"></i> Regresar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div id="cotizacionDetalleManual">

                            </div>
                        </div>
                    </div>
                    <script src="../../controlador/js/form/frmCotizacionManual.js"></script>

