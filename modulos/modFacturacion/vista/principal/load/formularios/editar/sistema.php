					<?php
						include("../../../../../../../lib/config/conect.php");
						$selSistema=mysqli_query($con,"SELECT * FROM fac_sistema WHERE sistemaId='$_REQUEST[sistemaId]'");
						$datSistema=mysqli_fetch_assoc($selSistema);
					?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Sistemas</h3><br>
                            <form class="form-material" name="frmEditSistema" id="frmEditSistema">
                            	<input type="hidden" name="sistemaId" id="sistemaId" value="<?php echo $datSistema["sistemaId"];?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombre del Sistema</label>
                                            <input type="text" class="form-control" value="<?php echo $datSistema["nombreSistema"];?>" name="nombreSistema" id="nombreSistema">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="guardarSistema">
                                                <i class="fa fa-save"></i> Guardar Información
                                            </button>
                                            <button type="button" class="btn btn-warning" id="regresar" style="margin-left: 5px;">
                                                <i class="fa fa-arrow-left"></i> Regresar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div id="sistemaDetalle">

                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function(){
                            var sistemaId = $("#sistemaId").val();
                            cargarSistemaDetalle(sistemaId);
                        });
                    </script>
                    <script src="../../controlador/js/form/frmSistema.js"></script>