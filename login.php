<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="shortcut icon" href="lib/assets/sysTemplate/assets/images/icon.png">

    <link href="lib/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/assets/css/all.min.css" rel="stylesheet">
    <link href="lib/assets/css/signin.css" rel="stylesheet">
</head>
<body>
    <form class="form-signin" name="frmLogin" id="frmLogin">
        <center>
            <!--`<img class="mb-4" src="./lib/assets/images/einsoft.png" alt="" width="180" height="72">-->
            <h2><strong>DENTALMED</strong></h2>
            <h4 class="mb-3 font-weight-normal">Entrar al sistema</h4>
        </center><br>        

        <label for="usuario" class="sr-only">Usuario</label>
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">

        <label for="clave" class="sr-only">Contraseña</label>
        <input type="password" id="clave" name="clave" class="form-control" placeholder="Contraseña">

        <br>

        <button class="btn btn-lg btn-primary btn-block" type="button" id="entrar">
            <i class="fa fa-sign-in-alt"></i> Iniciar Sesión
        </button>

        <div id="mensaje" class="mensaje"></div>

        <!--<p class="mt-5 mb-3 text-muted">
            <small>
                Propiedad Intelectual de &copy; <a href="http://www.einsoftsv.com" target="_blank">EinSoft & Solutions</a>
            </small>
        </p>-->
    </form>
    

    <script src="lib/assets/js/jquery-3.4.1.min.js"></script>
    <script src="lib/assets/js/bootstrap.min.js"></script>
    <script src="lib/config/js/form/frmLogin.js"></script>
    
</body>
</html>