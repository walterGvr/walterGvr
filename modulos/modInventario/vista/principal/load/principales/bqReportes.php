                    <?php
                        include("../../../../../../lib/config/conect.php");
                    ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>
                                Reportes del Sistema
                            </h3>

                            <p>Seleccionar e imprimir el reporte.</p><br>

                            <form class="form-material" name="frmReportes" id="frmReportes">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Seleccione el reporte</label>
                                            <select class="form-control" name="reporte" id="reporte">
                                                <option value="" selected disabled>-- Seleccione el reporte --</option>
                                                <option value="repBarras">» Codigo de Barras </option>
                                                <option value="repInventario">» Reporte de Inventario </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="selectProducto">
                                        <div class="form-group">
                                            <label>Seleccione el Producto</label>
                                            <select class="form-control" name="productoId" id="productoId">
                                                <?php
                                                    $selProd=mysqli_query($con,"SELECT * FROM inv_producto");
                                                    while ($datProd=mysqli_fetch_assoc($selProd)){
                                                ?>
                                                    <option value="<?php echo $datProd["productoId"];?>">
                                                        <?php echo $datProd["codigo"]." | ".$datProd["producto"];?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="imprimirReporte">
                                                <i class="fa fa-print"></i> Imprimir Reporte
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script src="../../controlador/js/form/frmBqReporte.js"></script>


