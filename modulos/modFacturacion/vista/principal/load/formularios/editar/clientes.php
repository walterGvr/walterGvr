                    <?php
                        include("../../../../../../../lib/config/conect.php");
                        $selCliente=mysqli_query($con,"SELECT * FROM fac_clientes WHERE clienteId='$_REQUEST[clienteId]' LIMIT 1");
                        $datCliente=mysqli_fetch_assoc($selCliente);
                    ?>
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card" style="padding: 25px;">
                            <h3>Formulario / Editar Usuarios</h3><br>
                            <form class="form-material" name="frmEditCliente" id="frmEditCliente">
                                <input type="hidden" name="clienteId" id="clienteId" value="<?php echo $datCliente["clienteId"]?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombres</label>
                                            <input type="text" class="form-control" value="<?php echo $datCliente["nombres"] ?>" name="nombres" id="nombres">
                                        </div>

                                        <div class="form-group">
                                            <label>Apellidos</label>
                                            <input type="text" class="form-control" value="<?php echo $datCliente["apellidos"] ?>" name="apellidos" id="apellidos">
                                        </div>

                                        <div class="form-group">
                                            <label>Tipo Cliente</label>
                                            <select class="form-control" name="tipoClienteId" id="tipoClienteId">
                                                <?php if ($datCliente["tipoClienteId"]==1){ ?>
                                                    <option value="1" selected>PARTICULAR</option>
                                                    <option value="2">FRECUENTE</option>
                                                    <option value="3">SOCIO</option>
                                                <?php } else if ($datCliente["tipoClienteId"]==2){?>
                                                    <option value="1">PARTICULAR</option>
                                                    <option value="2" selected>FRECUENTE</option>
                                                    <option value="3">SOCIO</option>
                                                <?php } else if ($datCliente["tipoClienteId"]==3){?>
                                                    <option value="1">PARTICULAR</option>
                                                    <option value="2">FRECUENTE</option>
                                                    <option value="3" selected>SOCIO</option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Tipo Persona</label>
                                            <select class="form-control" name="tipoPersona" id="tipoPersona">
                                                <?php if ($datCliente["tipoPersona"]=="NATURAL"){ ?>
                                                    <option value="NATURAL" selected>NATURAL</option>
                                                    <option value="JURIDICA">JURIDICA</option>
                                                <?php } else if ($datCliente["tipoPersona"]=="JURIDICA"){?>
                                                    <option value="NATURAL">NATURAL</option>
                                                    <option value="JURIDICA" selected>JURIDICA</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tipo Contribuyente</label>
                                            <select class="form-control" name="tipoContribuyente" id="tipoContribuyente">
                                                <?php if ($datCliente["tipoContribuyente"]=="NA"){ ?>
                                                    <option value="NA" selected>NO CONTRIBUYENTE</option>
                                                    <option value="PEQUENO">PEQUEÑO CONTRIBUYENTE</option>
                                                    <option value="MEDIANO">MEDIANO CONTRIBUYENTE</option>
                                                    <option value="GRAN">GRAN CONTRIBUYENTE</option>
                                                <?php } else if ($datCliente["tipoContribuyente"]=="PEQUENO"){?>
                                                    <option value="NA">NO CONTRIBUYENTE</option>
                                                    <option value="PEQUENO" selected>PEQUEÑO CONTRIBUYENTE</option>
                                                    <option value="MEDIANO">MEDIANO CONTRIBUYENTE</option>
                                                    <option value="GRAN">GRAN CONTRIBUYENTE</option>
                                                <?php } else if ($datCliente["tipoContribuyente"]=="MEDIANO"){?>
                                                    <option value="NA">NO CONTRIBUYENTE</option>
                                                    <option value="PEQUENO">PEQUEÑO CONTRIBUYENTE</option>
                                                    <option value="MEDIANO" selected>MEDIANO CONTRIBUYENTE</option>
                                                    <option value="GRAN">GRAN CONTRIBUYENTE</option>
                                                <?php } else if ($datCliente["tipoContribuyente"]=="GRAN"){?>
                                                    <option value="NA">NO CONTRIBUYENTE</option>
                                                    <option value="PEQUENO">PEQUEÑO CONTRIBUYENTE</option>
                                                    <option value="MEDIANO">MEDIANO CONTRIBUYENTE</option>
                                                    <option value="GRAN" selected>GRAN CONTRIBUYENTE</option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label># dE NRC</label>
                                            <input type="text" class="form-control" name="NRC" id="NRC">
                                        </div>

                                        <div class="form-group">
                                            <label># dE NRC</label>
                                            <label>GIRO</label>
                                            <textarea class="form-control" name="giro" id="giro" rows="3" onblur="javascript:this.value=this.value.toUpperCase();"><?php echo $datCliente["giro"] ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <button type="button" class="btn btn-primary" id="editarCliente">
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
                    <script src="../../controlador/js/form/frmClientes.js"></script>

