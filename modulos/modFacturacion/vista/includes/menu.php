        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <div class="user-profile" style="background: url(../../../../lib/assets/sysTemplate/assets/images/background/user-info-facturacion.jpg) no-repeat;">
                    <div class="profile-img"> <img src="../../../../lib/assets/sysTemplate/assets/images//users/profile.png" alt="user" /> </div>
                    <div class="profile-text">
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            <?php echo "Usuario: ".$_SESSION["nombres"];?>
                        </a>
                        <div class="dropdown-menu animated flipInY">
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> Mi Perfil</a>
                            <a href="#" class="dropdown-item"><i class="ti-wallet"></i> Opción</a>
                            <a href="#" class="dropdown-item"><i class="ti-email"></i> Mensajes</a>

                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item"><i class="ti-settings"></i> Configuración</a>

                            <div class="dropdown-divider"></div>
                            <a href="../../../lib/data/cerrar" class="dropdown-item"><i class="fa fa-power-off"></i> Salir</a>
                        </div>
                    </div>
                </div>
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">PRINCIPAL</li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                                <i class="mdi mdi-gauge"></i>
                                <span class="hide-menu">Dashboard </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="#" id="principal">Principal</a></li>
                            </ul>
                        </li>
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">ADMINISTRACIÓN</li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                                <i class="mdi mdi-settings"></i><span class="hide-menu">Configuración</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="#" id="tipoClientes">Tipos de Clientes</a></li>
                                <li><a href="#" id="clientes">Clientes</a></li>
                                <li><a href="#" id="precios">Precios</a></li>
                                <li><a href="#" id="prueba1">Prueba1</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                                <i class="mdi mdi-cart"></i><span class="hide-menu">Ventas</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="#" id="cotizacion-manual">Cotización</a></li>
                                <li><a href="#" id="consumidor">Consumidor Final</a></li>
                                <li><a href="#" id="creditoFiscal">Crédito Fiscal</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                                <i class="mdi mdi-printer"></i><span class="hide-menu">Reportes</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="#" id="impReportes">Impresion de Reportes</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="sidebar-footer">
                <a href="#" class="link" data-toggle="tooltip" title="Configuración"><i class="ti-settings"></i></a>
                <a href="#" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <a href="../../../../lib/config/cerrar" class="link" data-toggle="tooltip" title="Salir"><i class="mdi mdi-power"></i></a>
            </div>
        </aside>