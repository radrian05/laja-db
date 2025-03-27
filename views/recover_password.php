<?php
    include_once '../helpers/session_helper.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recuperar Contraseña</title>
        <link rel="stylesheet" href="login.css" type="text/css">
    </head>

    <body>
        <div class="login">
            <div class="logo">
                <img src="logo.jpeg" alt="Logo">
            </div>
            <h1>Recuperar Contraseña</h1>
            <form method="post" action="../controllers/Users.php" aria-label="Recuperar Contraseña">
                <input type="hidden" name="type" value="recoverPassword">

                <label for="userUid">
                    <i class="fas fa-user"></i> Nombre de Usuario
                </label>
                <input type="text" id="userUid" name="userUid" placeholder="Nombre de Usuario..." aria-label="Nombre de Usuario" required>

                <label for="secretWord">
                    <i class="fas fa-key"></i> Palabra Secreta
                </label>
                <input type="text" id="secretWord" name="secretWord" placeholder="Palabra Secreta..." aria-label="Palabra Secreta" required>

                <label for="newPassword">
                    <i class="fas fa-lock"></i> Nueva Contraseña
                </label>
                <input type="password" id="newPassword" name="newPassword" placeholder="Nueva Contraseña..." aria-label="Nueva Contraseña" required>

                <label for="confirmPassword">
                    <i class="fas fa-lock"></i> Confirmar Contraseña
                </label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmar Contraseña..." aria-label="Confirmar Contraseña" required>

                <?php flash('recover_password') ?>
                <button type="submit" name="submit" aria-label="Recuperar contraseña">Recuperar Contraseña</button>
            </form>
            <a href="login.php" class="back-to-login" aria-label="Volver al inicio de sesión">Volver al inicio de sesión</a>
        </div>

    </body>
</html>