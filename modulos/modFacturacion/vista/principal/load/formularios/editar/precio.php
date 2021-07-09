                    <?php
                        include("../../../../../../../lib/config/conect.php");
                        $selPrecio=mysqli_query($con,"SELECT * FROM fac_precios WHERE precioId='$_REQUEST[precioId]' LIMIT 1");
                        $datPrecio=mysqli_fetch_assoc($selPrecio);


                        $query="SELECT pro.productoId,pro.producto,pro.lineaId,vl.linea,vl.marcaId,vl.marca
                                FROM inv_producto pro
                                LEFT JOIN vista_lineas vl ON vl.lineaId = pro.lineaId";
                    ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Precios </h3><br>
                            <form class="form-material" name="frmEditPrecios" id="frmEditPrecios">
                                <input type="hidden" name="precioId" id="precioId" value="<?php echo $datPrecio["precioId"] ?>">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>Seleccione el producto</label>
                                            <select class="form-control" name="productoId" id="productoId">
                                                <?php
                                                    $selProducto=mysqli_query($con,$query);
                                                    while ($datProducto=mysqli_fetch_assoc($selProducto)){

                                                    if ($datProducto["productoId"]==$datPrecio["productoId"]){
                                                        $selected="selected";
                                                    } else {
                                                        $selected="";
                                                    }
                                                ?>
                                                    <option value="<?php echo $datProducto["productoId"] ?>" <?php echo $selected;?>>
                                                        <?php echo $datProducto["marca"]." | ".$datProducto["linea"]." | ".$datProducto["producto"];?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Precio</label>
                                            <input type="number" min="0.00" step="0.01" value="<?php echo $datPrecio["precio"] ?>" class="form-control" name="precio" id="precio">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="editarPrecio">
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
                    <script src="../../controlador/js/form/frmPrecios.js"></script>

