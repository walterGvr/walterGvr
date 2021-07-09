<?php
    session_start();
    include("../../../../lib/config/conect.php");
    include("../../../../lib/config/seguridadPrincipal.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>App</title>
    <link rel="shortcut icon" href="../../../../lib/assets/sysTemplate/assets/images/icon.png">


    <link href="../../../../lib/assets/sysTemplate/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../lib/assets/sysTemplate/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <link href="../../../../lib/assets/sysTemplate/principal/css/style.css" rel="stylesheet">
    <link href="../../../../lib/assets/sysTemplate/principal/css/colors/blue.css" id="theme" rel="stylesheet">
    <link href="../../../../lib/assets/sysTemplate/principal/css/sweetalert2.min.css" rel="stylesheet">
    <link href="../../../../lib/assets/css/select.min.css" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <?php include("../includes/header.php") ?>
        <?php include("../includes/menu.php") ?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Principal</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Principal</li>
                        </ol>
                    </div>
                </div>

                <div class="row" id="root">

                </div>
            </div>
            <?php include("../includes/footer.php")  ?>
        </div>
    </div>

    <script src="../../../../lib/assets/sysTemplate/assets/plugins/jquery/jquery.min.js"></script>
    <script src="../../../../lib/assets/sysTemplate/assets/plugins/popper/popper.min.js"></script>
    <script src="../../../../lib/assets/sysTemplate/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../../lib/assets/sysTemplate/principal/js/jquery.slimscroll.js"></script>
    <script src="../../../../lib/assets/sysTemplate/principal/js/waves.js"></script>
    <script src="../../../../lib/assets/sysTemplate/principal/js/sidebarmenu.js"></script>
    <script src="../../../../lib/assets/sysTemplate/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../../../../lib/assets/sysTemplate/principal/js/custom.min.js"></script>
    <script src="../../../../lib/assets/sysTemplate/principal/js/sweetalert2.min.js"></script>

    <script src="../../controlador/js/menu.js"></script>
    <script src="../../../../lib/config/js/helper.js"></script>
    <script src="../../../../lib/assets/js/select.min.js"></script>
    

</body>
</html>