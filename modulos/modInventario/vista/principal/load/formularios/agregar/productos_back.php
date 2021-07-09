                    <?php include("../../../../../../../lib/config/conect.php");?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Productos</h3><br>
                            <form class="form-material" name="frmProductos" id="frmProductos">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Línea</label>
                                            <select class="form-control" name="lineaId" id="lineaId">
                                                <option value="">-- Seleccione la Linea --</option>
                                                <?php
                                                    $selLinea=mysqli_query($con,"SELECT * FROM vista_lineas");
                                                    while($datLinea=mysqli_fetch_assoc($selLinea)){
                                                ?>
                                                    <option value="<?php echo $datLinea["lineaId"] ?>">
                                                        <?php
                                                            echo "» ".$datLinea["nombre"]." | ".$datLinea["marca"]." | ".$datLinea["linea"];
                                                        ?>
                                                    </option>
                                                <?php }?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Producto</label>
                                            <input type="text" class="form-control" name="producto" id="producto">
                                        </div>

                                        <div class="form-group">
                                            <label>Color</label>
                                            <input type="text" class="form-control" name="color" id="color">
                                        </div>

                                        <div class="form-group">
                                            <label>Modelo</label>
                                            <input type="text" class="form-control" name="modelo" id="modelo">
                                        </div>

                                        <div class="form-group">
                                            <label>Existencia mínima</label>
                                            <input type="text" class="form-control" name="exMin" id="exMin">
                                        </div>

                                        <div class="form-group">
                                            <label>Existencia máxima</label>
                                            <input type="text" class="form-control" name="exMax" id="exMax">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Existencia actual</label>
                                            <input type="text" class="form-control" name="exActual" id="exActual">
                                        </div>

                                        <div class="form-group">
                                            <label>Ubicación</label>
                                            <input type="text" class="form-control" name="ubicacion" id="ubicacion">
                                        </div>

                                        <div class="form-group">
                                            <label>Observaciones</label>
                                            <input type="text" class="form-control" name="obs" id="obs">
                                        </div>

                                        <div class="form-group">
                                            <label>Costo Promedio</label>
                                            <input type="number" class="form-control" min="0.0" step="0.01" value="0.00" name="costoPromedio" id="costoPromedio" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Bodega</label>
                                            <select class="form-control" name="bodegaId" id="bodegaId">
                                                <option value="">-- Seleccione la bodega --</option>
                                                <?php
                                                    $selBodega=mysqli_query($con,"SELECT * FROM inv_bodega");
                                                    while($datBodega=mysqli_fetch_assoc($selBodega)){
                                                ?>
                                                    <option value="<?php echo $datBodega["bodegaId"] ?>"><?php echo "» ".$datBodega["bodega"] ?></option>
                                                <?php }  mysqli_free_result($selLinea); mysqli_free_result($selBodega); mysqli_close($con); ?>
                                            </select>
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
                    <script src="../../controlador/js/form/frmProductos.js"></script>

