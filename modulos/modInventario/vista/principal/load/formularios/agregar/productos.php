                    <?php include("../../../../../../../lib/config/conect.php");?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Productos</h3><br>
                            <form class="form-material" name="frmProductos" id="frmProductos">

                                <div class="row">
                                    <!-- PROVEEDORES -->
                                    <div class="col-md-4">
                                        <input type="hidden" name="prod_proveedorId" id="prod_proveedorId">
                                        <input type="hidden" name="prod_tipoProveedor" id="prod_tipoProveedor">
                                        <input type="hidden" name="prod_nombre" id="prod_nombre">
                                        <input type="hidden" name="prod_email" id="prod_email">
                                        <input type="hidden" name="prod_telefono" id="prod_telefono">
                                        <input type="hidden" name="prod_sitioWeb" id="prod_sitioWeb">
                                        <div class="form-group">
                                            <label>Proveedor</label>
                                            <select class="proveedor form-control" name="proveedorId" id="proveedorId" onchange="mostrarBtns();">
                                                <option value="0" selected disabled>-- Seleccione el proveedor --</option>                                                
                                            </select>      
                                        </div>                                        
                                    </div>
                                    <div class="col-md-2">
                                        <label>&nbsp;</label><br>
                                        <button type="button" id="btnAgregar" class="btn btn-success" title="Agregar" data-toggle="modal" data-target="#mdlAddProveedor">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <button type="button" id="btnEditar" class="btn btn-primary" title="Editar" data-toggle="modal" data-target="#mdlEditProveedor" onclick="copiar();">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div>
                                    <!-- PROVEEDORES -->
                                
                                    <!-- MARCAS -->
                                    <div class="col-md-4">
                                        <input type="hidden" name="marc_marcaId" id="marc_marcaId">
                                        <input type="hidden" name="marc_proveedorId" id="marc_proveedorId">
                                        <input type="hidden" name="marc_marca" id="marc_marca">
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <select class="marca form-control" name="marcaId" id="marcaId" onchange="mostrarBtnMarcas();">
                                                <option value="0" selected disabled>-- Seleccione la marca --</option>                                                
                                            </select>      
                                        </div>                                        
                                    </div>
                                    <div class="col-md-2">
                                        <label>&nbsp;</label><br>
                                        <button type="button" id="btnAgregarMarca" class="btn btn-success" title="Agregar" data-toggle="modal" data-target="#mdlAddMarca">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <button type="button" id="btnEditarMarca" class="btn btn-primary" title="Editar" data-toggle="modal" data-target="#mdlEditMarca" onclick="copiarMarca();">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div>
                                    <!-- MARCAS -->
                                </div>

                                <div class="row">
                                    <!-- LINEAS -->
                                    <div class="col-md-4">
                                        <input type="hidden" name="line_lineaId" id="line_lineaId">
                                        <input type="hidden" name="line_marcaId" id="line_marcaId">
                                        <input type="hidden" name="line_linea" id="line_linea">
                                        <div class="form-group">
                                            <label>Linea</label>
                                            <select class="linea form-control" name="lineaId" id="lineaId" onchange="mostrarBtnLineas();">
                                                <option value="0" selected disabled>-- Seleccione la linea --</option>                                                
                                            </select>      
                                        </div>                                        
                                    </div>
                                    <div class="col-md-2">
                                        <label>&nbsp;</label><br>
                                        <button type="button" id="btnAgregarLinea" class="btn btn-success" title="Agregar" data-toggle="modal" data-target="#mdlAddLinea">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <button type="button" id="btnEditarLinea" class="btn btn-primary" title="Editar" data-toggle="modal" data-target="#mdlEditLinea" onclick="copiarLinea();">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div>
                                    <!-- LINEAS -->

                                    <div class="col-md-6">                                        
                                        <div class="form-group">
                                            <label>Nombre del producto</label>
                                            <input type="text" class="form-control" name="producto" id="producto">
                                        </div>                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">                                        
                                        <div class="form-group">
                                            <label>Color</label>
                                            <input type="text" class="form-control" name="color" id="color">
                                        </div>                                        
                                    </div>

                                    <div class="col-md-3">                                        
                                        <div class="form-group">
                                            <label>Ex. Minima</label>
                                            <input type="text" class="form-control" name="exMin" id="exMin" value="1">
                                        </div>                                        
                                    </div>

                                    <div class="col-md-3">                                        
                                        <div class="form-group">
                                            <label>Ex. Máxima</label>
                                            <input type="text" class="form-control" name="exMax" id="exMax" value="10">
                                        </div>                                        
                                    </div>

                                    <div class="col-md-3">                                        
                                        <div class="form-group">
                                            <label>Ex. Actual</label>
                                            <input type="text" class="form-control" name="exActual" id="exActual" value="0">
                                        </div>                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ubicación</label>
                                            <input type="text" class="form-control" name="ubicacion" id="ubicacion">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Costo Promedio</label>
                                            <input type="text" class="form-control" value="0.000" name="costoPromedio" id="costoPromedio" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Bodega</label>
                                            <select class="form-control" name="bodegaId" id="bodegaId">
                                                <?php
                                                    $selBodega=mysqli_query($con,"SELECT * FROM inv_bodega");
                                                    while($datBodega=mysqli_fetch_assoc($selBodega)){
                                                ?>
                                                    <option value="<?php echo $datBodega["bodegaId"] ?>"><?php echo "» ".$datBodega["bodega"] ?></option>
                                                <?php }  mysqli_free_result($selLinea); mysqli_free_result($selBodega); mysqli_close($con); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Precio de venta</label>
                                            <input type="text" class="form-control" value="0.0" name="precio" id="precio">
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

                    <!-- Formularios para las modales -->
                    <?php include("./add.modales/add.proveedor.php")?>
                    <?php include("./add.modales/edit.proveedor.php")?>
                    
                    <div id="add-modal-marca">
                    </div>
                    
                    <?php include("./add.modales/edit.marca.php")?>
                    
                    <div id="add-modal-linea">
                    </div>                    


                    <?php include("./add.modales/edit.linea.php")?>

                    <!-- Scripts para controlar todas las funciones -->
                    <script src="../../controlador/js/form/frmProductos.js"></script>
                    <script src="../../controlador/js/form/frm.mdl.proveedor.js"></script>
                    <script src="../../controlador/js/form/frm.mdl.marcas.js"></script>
                    <script src="../../controlador/js/form/frm.mdl.lineas.js"></script>

