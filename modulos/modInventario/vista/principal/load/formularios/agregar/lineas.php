                    <?php include("../../../../../../../lib/config/conect.php");?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Lineas</h3><br>
                            <form class="form-material" name="frmLineas" id="frmLineas">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Seleccione La Marca</label>
                                            <select class="form-control" name="marcaId" id="marcaId">
                                                <option value="" selected disabled>-- Seleccione la Marca --</option>
                                                <?php $selMarca=mysqli_query($con,"SELECT * FROM vista_marcas");
                                                    while($datMarca=mysqli_fetch_assoc($selMarca)){?>
                                                    <option value="<?php echo $datMarca["marcaId"]?>"><?php echo $datMarca["marca"]." | ".$datMarca["nombre"]?></option>
                                                <?php } mysqli_free_result($selMarca);?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre de la Linea</label>
                                            <input type="text" class="form-control" name="linea" id="linea">
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
                    <script src="../../controlador/js/form/frmLinea.js"></script>

