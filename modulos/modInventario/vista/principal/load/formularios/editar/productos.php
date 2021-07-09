                    <?php
                        include("../../../../../../../lib/config/conect.php");
                        $selProd=mysqli_query($con,"SELECT * FROM inv_producto WHERE productoId='$_REQUEST[productoId]' LIMIT 1");
                        $datProd=mysqli_fetch_assoc($selProd);
                    ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Productos</h3><br>
                            <form class="form-material" name="frmEditProductos" id="frmEditProductos">
                                <input type="hidden" name="productoId" id="productoId" value="<?php echo $datProd["productoId"] ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Línea</label>
                                            <select class="form-control" name="lineaId" id="lineaId">
                                                <option value="">-- Seleccione la Linea --</option>
                                                <?php
                                                    $selLinea=mysqli_query($con,"SELECT * FROM vista_lineas");
                                                    while($datLinea=mysqli_fetch_assoc($selLinea)){

                                                    if ($datProd["lineaId"]==$datLinea["lineaId"]){
                                                        $selected="selected";
                                                    } else {
                                                        $selected="";
                                                    }
                                                ?>
                                                    <option value="<?php echo $datLinea["lineaId"] ?>" <?php echo $selected;?>>
                                                        <?php
                                                            echo "» ".$datLinea["nombre"]." | ".$datLinea["marca"]." | ".$datLinea["linea"];
                                                        ?>
                                                    </option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Producto</label>
                                            <input type="text" class="form-control" value="<?php echo $datProd["producto"];?>" name="producto" id="producto">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Color</label>
                                            <input type="text" class="form-control" value="<?php echo $datProd["color"];?>" name="color" id="color">
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Existencia mínima</label>
                                            <input type="text" class="form-control" value="<?php echo $datProd["exMin"];?>" name="exMin" id="exMin">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Existencia máxima</label>
                                            <input type="text" class="form-control" value="<?php echo $datProd["exMax"];?>" name="exMax" id="exMax">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Existencia actual</label>
                                            <input type="text" class="form-control" value="<?php echo $datProd["exActual"];?>" name="exActual" id="exActual">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ubicación</label>
                                            <input type="text" class="form-control" value="<?php echo $datProd["ubicacion"];?>" name="ubicacion" id="ubicacion">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Costo Promedio</label>
                                            <input type="number" class="form-control" value="<?php echo $datProd["costoPromedio"];?>" min="0.0" step="0.01" name="costoPromedio" id="costoPromedio" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Bodega</label>
                                            <select class="form-control" name="bodegaId" id="bodegaId">
                                                <option value="">-- Seleccione la bodega --</option>
                                                <?php
                                                    $selBodega=mysqli_query($con,"SELECT * FROM inv_bodega");
                                                    while($datBodega=mysqli_fetch_assoc($selBodega)){

                                                    if ($datProd["bodegaId"]==$datBodega["bodegaId"]){
                                                        $selected="selected";
                                                    } else {
                                                        $selected="";
                                                    }
                                                ?>
                                                    <option value="<?php echo $datBodega["bodegaId"] ?>" <?php echo $selected;?>><?php echo "» ".$datBodega["bodega"] ?></option>
                                                <?php }  mysqli_free_result($selLinea); mysqli_free_result($selBodega); ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                        $selPrecio=mysqli_query($con,"SELECT * FROM fac_precios WHERE productoId='$datProd[productoId]' LIMIT 1");
                                        $datPrecio=mysqli_fetch_assoc($selPrecio);
                                        
                                    ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                                <label>Precio de venta</label>
                                                <input type="number" class="form-control" value="<?php echo $datPrecio["precio"]?>" min="0.0" step="0.01" name="precio" id="precio">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="editarProductos">
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
                    <?php mysqli_free_result($selPrecio); mysqli_close($con); ?>
                    <script src="../../controlador/js/form/frmProductos.js"></script>

