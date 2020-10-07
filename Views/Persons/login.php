<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Digital MTX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="Assets/img/logo-rojo.png">
    <link rel="stylesheet" type="text/css" href="Assets/css/styleLogin.css">
</head>

<body>
    <div class="login-reg-panel">
        <div class="register-info-box">
            <h2><img src="Assets/img/logo.png" width="200"> </h2>
        </div>
        <div class="white-panel">
            <div class="login-show">
                <h2>Iniciar Sesión </h2>
                <form action="?controller=person&method=loginIn" method="POST">
                    <?php if(isset($error['errorMessage'])){ ?>
                        <div class="alert alert-danger"><?php echo $error['errorMessage']; ?></div>
                    <?php } ?>
                    <input type="text" name="Correo" placeholder="Correo" value="<?php echo isset($error['email']) ? $error['email'] : '' ?>">
                    <input type="password" name="Contrasena" placeholder="Contraseña">
                    <button type="submit" class="btn btn-danger float-right">Ingresar</button>
                </form>
                <a href="">Recuperar contraseña?</a>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.login-info-box').fadeOut();
            $('.login-show').addClass('show-log-panel');
        });
        $('.login-reg-panel input[type="radio"]').on('change', function() {
            if ($('#log-login-show').is(':checked')) {
                $('.register-info-box').fadeOut();
                $('.login-info-box').fadeIn();

                $('.white-panel').addClass('right-log');
                $('.register-show').addClass('show-log-panel');
                $('.login-show').removeClass('show-log-panel');

            } else if ($('#log-reg-show').is(':checked')) {
                $('.register-info-box').fadeIn();
                $('.login-info-box').fadeOut();

                $('.white-panel').removeClass('right-log');

                $('.login-show').addClass('show-log-panel');
                $('.register-show').removeClass('show-log-panel');
            }
        });
    </script>
</body>

</html>