        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">
                        <b>
                            <img src="../../../../lib/assets/sysTemplate/assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <img src="../../../../lib/assets/sysTemplate/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <span>
                            <img src="../../../../lib/assets/sysTemplate/assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                            <img src="../../../../lib/assets/sysTemplate/assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                                href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-menu"></i></a> </li>

                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="../../../../lib/assets/sysTemplate/assets/images/users/profile.png" alt="user" class="profile-pic" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="../../../../lib/assets/sysTemplate/assets/images/users/profile.png" alt="user"></div>
                                            <div class="u-text">
                                                <h4><?php echo $_SESSION["usuario"] ?></h4>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="../../../selectModulo"><i class="fa fa-arrow-left"></i> Seleccionar Modulo</a></li>
                                    <li><a href="../../../../lib/config/cerrar"><i class="fa fa-power-off"></i> Salir del sistema</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>