<?php
                        include("../../../../../../../lib/config/conect.php");
                        $selTipoCliente=mysqli_query($con,"SELECT * FROM fac_tipocliente WHERE tipoClienteId='$_REQUEST[tipoClienteId]' LIMIT 1");
                        $datTipoCliente=mysqli_fetch_assoc($selTipoCliente);
                    ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Editar descuento del tipo de cliente</h3><br>
                            <form class="form-material" name="frmEditTipoCliente" id="frmEditTipoCliente">
                                <input type="hidden" name="tipoClienteId" id="tipoClienteId" value="<?php echo $datTipoCliente["tipoClienteId"]?>">
                                <div class="row">
                                    <div class="col-md-6">                                
                                        <div class="form-group">
                                            <label>Tipo Cliente</label>
                                            <input type="text" class="form-control" value="<?php echo $datTipoCliente["tipoCliente"] ?>" name="tipoCliente" id="tipoCliente" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Porcentaje descuento</label>
                                            <input type="text" class="form-control" value="<?php echo $datTipoCliente["descuento"] ?>" name="descuento" id="descuento">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="editarTipoCliente">
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
                    <script src="../../controlador/js/form/frmTipoCliente.js"></script>

