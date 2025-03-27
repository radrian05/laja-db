<?php
    include_once '../helpers/session_helper.php';
    if(isset($_SESSION['userId'])){
        header("location: ../views/home.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema de Inventario</title>
        <link rel="stylesheet" href="login.css" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>

    <body>
        <div class="login">
            <div class="logo">
                <img src="logo.jpeg" alt="Logo">
            </div>
            <h1>LAJA-DB</h1>
            <form method="post" action="../controllers/Users.php" aria-label="Iniciar Sesión">
                <input type="hidden" name="type" value="login">

                <label for="name">
                    <i class="fas fa-user"></i> Nombre de Usuario
                </label>
                <input type="text" id="name" name="name" placeholder="Nombre de Usuario..." aria-label="Nombre de Usuario" required>

                <label for="userPwd">
                    <i class="fas fa-lock"></i> Contraseña
                </label>
                <input type="password" id="userPwd" name="userPwd" placeholder="Contraseña..." aria-label="Contraseña" required>

                <?php flash('login') ?>
                <button type="submit" name="submit" aria-label="Iniciar sesión">Iniciar Sesión</button>
            </form>
            <a href="recover_password.php" class="recover-password-link" aria-label="Recuperar contraseña">¿Olvidaste tu contraseña?</a>
        </div>

        <footer>
            <p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/"><a property="dct:title" rel="cc:attributionURL" href="https://github.com/radrian05/laja-db">LAJA DB</a> by <a rel="cc:attributionURL dct:creator" property="cc:attributionName" href="https://github.com/radrian05">Adrian Rojas, Alvaro Lara, Juan Jordan, Leizzy Goitia</a> is licensed under <a href="https://creativecommons.org/licenses/by-nc-nd/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-NC-ND 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nd.svg?ref=chooser-v1" alt=""></a></p>
        </footer>

    </body>
</html>