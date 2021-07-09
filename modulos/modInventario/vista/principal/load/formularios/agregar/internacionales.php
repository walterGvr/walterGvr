                    <?php include("../../../../../../../lib/config/conect.php");?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario para agregar Compras Internacionales</h3><br>
                            <form class="form-material" name="frmInternacionales" id="frmInternacionales">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <input type="date" class="form-control" value="<?php echo date("Y-m-d");?>" name="fechaCompra" id="fechaCompra">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Proveedor</label>
                                            <select class="form-control" name="proveedorId" id="proveedorId">
                                                <option value="">-- Seleccione el Proveedor --</option>
                                                <?php
                                                    $selProveedor=mysqli_query($con,"SELECT * FROM inv_proveedores WHERE tipoProveedor='INTERNACIONAL'");
                                                    while($datProveedor=mysqli_fetch_assoc($selProveedor)){
                                                ?>
                                                    <option value="<?php echo $datProveedor["proveedorId"] ?>">
                                                        <?php
                                                            echo "» ".$datProveedor["nombre"];
                                                        ?>
                                                    </option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Numero</label>
                                            <input type="text" class="form-control" name="numeroFactura" id="numeroFactura">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bodega</label>
                                            <select class="form-control" name="bodegaId" id="bodegaId">
                                                <option value="">-- Seleccione la bodega --</option>
                                                <?php
                                                    $selBodega=mysqli_query($con,"SELECT * FROM inv_bodega");
                                                    while($datBodega=mysqli_fetch_assoc($selBodega)){

                                                    if ($datBodega["bodegaId"]=="1"){
                                                        $selected="selected";
                                                    } else {
                                                        $selected="";
                                                    }
                                                ?>
                                                    <option value="<?php echo $datBodega["bodegaId"] ?>" <?php echo $selected;?>><?php echo "» ".$datBodega["bodega"] ?></option>
                                                <?php }  mysqli_free_result($selLinea); mysqli_free_result($selBodega); mysqli_close($con); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Descripción de la compra:</label>
                                            <textarea class="form-control" rows="2" name="descripcion" id="descripcion"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="agregarDetalle">
                                                <i class="fa fa-save"></i> Agregar Detalle
                                            </button>
                                            <button type="button" class="btn btn-danger" id="regresar" style="margin-left: 5px;">
                                                <i class="fa fa-arrow-left"></i> Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div id="internacionalesDetalle">

                            </div>

                            <div id="loadTramites">

                            </div>
                        </div>
                    </div>
                    <script src="../../controlador/js/form/frmInternacionales.js"></script>

