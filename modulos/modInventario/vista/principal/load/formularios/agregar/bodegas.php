                    <?php include("../../../../../../../lib/config/conect.php");?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Bodegas</h3><br>
                            <form class="form-material" name="frmBodegas" id="frmBodegas">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select class="form-control" name="tipoBodega" id="tipoBodega">
                                                <option value="" selected disabled>-- Seleccione el tipo --</option>
                                                <option value="1">BODEGA GENERAL</option>
                                                <option value="2">BODEGA DE AVERIAS</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre de la Bodega</label>
                                            <input type="text" class="form-control" name="bodega" id="bodega">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Dirección</label>
                                            <input type="text" class="form-control" name="direccion" id="direccion">
                                        </div>

                                        <div class="form-group">
                                            <label>Teléfono</label>
                                            <input type="text" class="form-control" name="telefono" id="telefono">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="guardar">
                                                <i class="fa fa-save"></i> Guardar Información
                                            </button>
                                            <button type="button" class="btn btn-warning" id="regresar" style="margin-left: 5px;">
                                                <i class="fa fa-arrow-left"></i> Regresar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script src="../../controlador/js/form/frmBodegas.js"></script>

