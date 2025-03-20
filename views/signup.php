<?php 
    include_once '../helpers/session_helper.php';
    if (!isset($_SESSION['userId'])) {
        // Si no hay sesión activa, redirigir a la página de inicio de sesión
        header("location: ../views/login.php");
        exit();
    } elseif ($_SESSION['IS_ADMIN'] != 1) {
        // Si el usuario no es administrador, redirigir a la página de inicio
        header("location: ../views/dashboard.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Login System</title>
        <link rel="stylesheet" href="login.css" type="text/css">
    </head>

    <body>
        <div class="login">
            <form method="post" action="../controllers/Users.php">
                <h1>Registro de Usuario</h1>
                <input type="hidden" name="type" value="register">
                <input type="text" name="userName" placeholder="Nombre y Apellido...">
                <input type="text" name="userUid" placeholder="Nombre de Usuario...">
                <input type="password" name="userPwd" placeholder="Contraseña...">
                <input type="password" name="pwdRepeat" placeholder="Repetir Contraseña">
                <?php flash('register') ?>
                <button type="submit" name="submit">Listo</button>
            </form>
        </div>

        <footer>
            <p>&copy; LAJA-DB <?php echo date("Y"); ?></p>
        </footer>

    </body>
</html>