                    <?php include("../../../../../../../lib/config/conect.php");?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Clientes</h3><br>
                            <form class="form-material" name="frmCliente" id="frmCliente">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombres</label>
                                            <input type="text" class="form-control" name="nombres" id="nombres">
                                        </div>

                                        <div class="form-group">
                                            <label>Apellidos</label>
                                            <input type="text" class="form-control" name="apellidos" id="apellidos">
                                        </div>

                                        <div class="form-group">
                                            <label>Tipo Cliente</label>
                                            <select class="form-control" name="tipoClienteId" id="tipoClienteId">
                                                <option value="1">PARTICULAR</option>
                                                <option value="2">FRECUENTE</option>
                                                <option value="3">SOCIO</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Tipo Persona</label>
                                            <select class="form-control" name="tipoPersona" id="tipoPersona">
                                                <option value="NATURAL">NATURAL</option>
                                                <option value="JURIDICA">JURIDICA</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tipo Contribuyente</label>
                                            <select class="form-control" name="tipoContribuyente" id="tipoContribuyente">
                                                <option value="NA">NO CONTRIBUYENTE</option>
                                                <option value="PEQUENO">PEQUEÑO CONTRIBUYENTE</option>
                                                <option value="MEDIANO">MEDIANO CONTRIBUYENTE</option>
                                                <option value="GRAN">GRAN CONTRIBUYENTE</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label># dE NRC</label>
                                            <input type="text" class="form-control" name="NRC" id="NRC">
                                        </div>

                                        <div class="form-group">
                                            <label># dE NRC</label>
                                            <label>GIRO</label>
                                            <textarea class="form-control" name="giro" id="giro" rows="3" onblur="javascript:this.value=this.value.toUpperCase();"></textarea>
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
                    <script src="../../controlador/js/form/frmClientes.js"></script>

