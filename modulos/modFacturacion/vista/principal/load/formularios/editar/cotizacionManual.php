                    <?php
                        include("../../../../../../../lib/config/conect.php");
                        $selCotizacionManual=mysqli_query($con,"SELECT * FROM fac_cotizacion_manual WHERE cotizacionManualId='$_REQUEST[cotizacionManualId]' LIMIT 1");
                        $datCotizacionManual=mysqli_fetch_assoc($selCotizacionManual);
                    ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Cotización Manual</h3><br>
                            <form class="form-material" name="frmEditarCotizacionManual" id="frmEditarCotizacionManual">
                                <input type="hidden" name="cotizacionManualId" id="cotizacionManualId" value="<?php echo $datCotizacionManual["cotizacionManualId"];?>">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <select class="form-control" name="clienteId" id="clienteId">
                                                <option value="" selected disabled>-- Seleccione el cliente --</option>
                                                <?php
                                                    $selCliente=mysqli_query($con,"SELECT * FROM fac_clientes");
                                                    while ($datCliente=mysqli_fetch_assoc($selCliente)){
                                                    if ($datCliente["clienteId"]==$datCotizacionManual["clienteId"]){
                                                        $selected="selected";
                                                    } else {
                                                        $selected="";
                                                    }
                                                ?>
                                                    <option value="<?php echo $datCliente["clienteId"] ?>" <?php echo $selected;?>>
                                                        <?php echo $datCliente["nombres"]." ".$datCliente["apellidos"];?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <input type="date" class="form-control" value="<?php echo $datCotizacionManual["fecha"];?>" name="fecha" id="fecha">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Lugar de Entrega</label>
                                            <input type="text" class="form-control" value="<?php echo $datCotizacionManual["lugarEntrega"];?>" name="lugarEntrega" id="lugarEntrega">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tiempo de Entrega</label>
                                            <input type="text" class="form-control" value="<?php echo $datCotizacionManual["tiempoEntrega"];?>" name="tiempoEntrega" id="tiempoEntrega">
                                        </div>
                                    </div>
                                </div>

                                <!-- SEGUNDA FILA -->

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Garantía</label>
                                            <input type="text" class="form-control" value="<?php echo $datCotizacionManual["garantia"];?>" name="garantia" id="garantia">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Validez</label>
                                            <input type="text" class="form-control" value="<?php echo $datCotizacionManual["validez"];?>" name="validez" id="validez">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Atención A</label>
                                            <input type="text" class="form-control" value="<?php echo $datCotizacionManual["atencionA"];?>" name="atencionA" id="atencionA">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Correo Electrónico</label>
                                            <input type="email" class="form-control" value="<?php echo $datCotizacionManual["email"];?>" name="email" id="email">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Telefono</label>
                                            <input type="text" class="form-control" value="<?php echo $datCotizacionManual["telefono"];?>" name="telefono" id="telefono">
                                        </div>
                                    </div>
                                </div>

                                <!-- TERCERA FILA -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Condiciones de Pago</label>
                                            <textarea class="form-control" rows="2" name="condicionesPago" id="condicionesPago"><?php echo $datCotizacionManual["condicionesPago"];?></textarea>
                                        </div>
                                    </div>
                                </div> 
                                
                                <!-- CUARTA FILA -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Descripción de la cotizacion</label>
                                            <textarea class="form-control" rows="2" name="descripcion" id="descripcion"><?php echo $datCotizacionManual["descripcion"];?></textarea>
                                        </div>
                                    </div>
                                </div> 

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="editarCotizacionManual">
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
                    <script>
                        $(document).ready(function(){
                            var cotizacionManualId = $("#cotizacionManualId").val();
                            cargarCotizacionDetalleManual(cotizacionManualId);
                        });
                    </script>
                    <script src="../../controlador/js/form/frmCotizacionManual.js"></script>

