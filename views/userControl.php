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
                <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Nombre de usuario</th>
                        <th>Contraseña</th>
                        <th>Administrador</th>
                        <th>Activo</th>
                        <th>Acciones</tr>
                    </tr>
                </thead>
                <tbody>
                    <?php generateTable(); ?>
                </tbody>
            </section>
            
            <div class="add-user">
                <form method="post" action="../controllers/Users.php">
                    <h1>Registro de Usuario</h1>
                    <input type="hidden" name="type" value="register">
                    <input type="text" name="userName" placeholder="Nombre y Apellido...">
                    <input type="text" name="userUid" placeholder="Nombre de Usuario...">
                    <input type="password" name="userPwd" placeholder="Contraseña...">
                    <input type="password" name="pwdRepeat" placeholder="Repetir Contraseña">
                    <button type="submit" name="submit">Listo</button>
                    <button type="button" class="cancelAdd">Cancelar</button>
                </form>
            </div>

            <div class="change-password">
                <form method="post" action="../controllers/Users.php">
                    <h1>Cambiar Contraseña</h1>
                    <input type="hidden" name="type" value="changePassword">
                    <input type="hidden" name="userId" value=" ">
                    <input type="password" name="userPwd" placeholder="Contraseña nueva" required>
                    <input type="password" name="pwdRepeat" placeholder="Repetir Contraseña" required>

                    <button type="submit" name="submit">Listo</button>
                    <button type="button" class="cancelChange">Cancelar</button>
                </form>
            </div>
           
        </main>

        <footer>
            <p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/"><a property="dct:title" rel="cc:attributionURL" href="https://github.com/radrian05/laja-db">LAJA DB</a> by <a rel="cc:attributionURL dct:creator" property="cc:attributionName" href="https://github.com/radrian05">Adrian Rojas, Alvaro Lara, Juan Jordan, Leizzy Goitia</a> is licensed under <a href="https://creativecommons.org/licenses/by-nc-nd/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-NC-ND 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nd.svg?ref=chooser-v1" alt=""></a></p>
        </footer>

        <script src="sidebar.js"></script>
        <script src="userControl.js"></script>
        <script src="alert.js"></script>
    </body>
</html>

