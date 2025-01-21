<?php
    include_once '../helpers/session_helper.php';
    if(isset($_SESSION['userId'])){
        header("location: ../views/dashboard.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Login System</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>

    <body>
        <div class="login">
            <div class="logo">
                <img src="logo.jpeg" alt="Logo">
            </div>
            <h1>Inventario</h1>
            <form method="post" action="../controllers/Users.php">
            <input type="hidden" name="type" value="login">
                <label for="name">
                    <i class="fas fa-user"></i>
                </label>
                <input type="text" name="name" placeholder="Nombre de Usuario...">

                <label for="userPwd">
                    <i class="fas fa-lock"></i>
                </label>
                <input type="password" name="userPwd" placeholder="Contraseña...">
                <?php flash('login') ?>
                <button type="submit" name="submit">Iniciar Sesión</button>
            </form>
        </div>

        <footer>
            <p>&copy; LAJA-DB <?php echo date("Y"); ?></p>
        </footer>

    </body>
    </html>