<?php
    include_once '../helpers/session_helper.php';
    ensureLoggedIn();
    require_once 'sidebar.php';
    require_once 'users.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viffewport" content="width=device-width, initial-scale=1.0">
        <title>Usuarios</title>
        <link rel="stylesheet" href="dashboard.css" type="text/css">
    </head>

    

    <body>
        <main>
        <?php flash('user_message')?>
        <?php flash('register') ?>
        <?php generateSidebar(basename($_SERVER['PHP_SELF'])); ?>
            <img class="logo" src="logo.jpeg">
            <h1 id="index-text">Bienvenido, <?php echo explode(" ", $_SESSION['userName'])[0]; ?> </h1>
            <section class="user-list">
                <h2>Control de Usuarios</h2>
                <div class="button-containter">
                    <button class="add">+</button>
                </div>
                <table aria-label="Lista de usuarios">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Nombre de usuario</th>
                            <th scope="col">Contraseña</th>
                            <th scope="col">Administrador</th>
                            <th scope="col">Activo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php generateTable(); ?>
                    </tbody>
                </table>
            </section>
            
            <div class="add-user">
                <form method="post" action="../controllers/Users.php" aria-labelledby="registerUserTitle">
                    <h1 id="registerUserTitle">Registro de Usuario</h1>
                    <input type="hidden" name="type" value="register">
                    
                    <input type="text" name="userName" placeholder="Nombre y Apellido..." aria-label="Nombre y Apellido" required>
                    <input type="text" name="userUid" placeholder="Nombre de Usuario..." aria-label="Nombre de Usuario" required>
                    <input type="password" name="userPwd" placeholder="Contraseña..." aria-label="Contraseña" required>
                    <input type="password" name="pwdRepeat" placeholder="Repetir Contraseña" aria-label="Repetir Contraseña" required>
                    <input type="text" name="secretWord" placeholder="Palabra secreta..." aria-label="Palabra secreta" required>
                    
                    <button type="submit" name="submit" aria-label="Registrar usuario">Listo</button>
                    <button type="button" class="cancelAdd" aria-label="Cancelar registro de usuario">Cancelar</button>
                </form>
            </div>

            <div class="change-password">
                <form method="post" action="../controllers/Users.php" aria-labelledby="changePasswordTitle">
                    <h1 id="changePasswordTitle">Cambiar Contraseña</h1>
                    <input type="hidden" name="type" value="changePassword">
                    <input type="hidden" name="userId" value=" ">

                    <input type="password" name="userPwd" placeholder="Contraseña nueva" aria-label="Contraseña nueva" required>
                    <input type="password" name="pwdRepeat" placeholder="Repetir Contraseña" aria-label="Repetir Contraseña" required>
                    <?php if ($_SESSION['IS_ADMIN'] != 1){
                        echo '<input type="text" name="secretword" placeholder="Palabra secreta..." aria-label="Palabra secreta">';
                    }?>   
                    <button type="submit" name="submit" aria-label="Confirmar cambio de contraseña">Listo</button>
                    <button type="button" class="cancelChange" aria-label="Cancelar cambio de contraseña">Cancelar</button>
                </form>
            </div>
           
        </main>

        <script src="sidebar.js"></script>
        <script src="userControl.js"></script>
        <script src="alert.js"></script>
    </body>
</html>

