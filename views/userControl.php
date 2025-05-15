<?php
include_once '../helpers/session_helper.php';
ensureLoggedIn();
require_once 'users.php';
?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once 'head.php'; ?> <!--head-->
    <title>Control de Usuarios</title>
</head>

<body>
    <?php include_once 'nav.php'; ?> <!--navbar y sidebar-->
    <?php flash('register'); ?>
    <?php flash('user_message')?>
    <?php flash('recover_password')?>

    <div class="container-fluid"> <!--CONTENIDO AQUI-->
        <div class="col min-vh-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Control de Usuarios</h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Añadir Usuario</button>
            </div>
            <?php generateTable(); ?>
        </div>
    </div>

    <!-- Modal de Registro de Usuario -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="registerUserTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="registerUserTitle">Registro de Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="../controllers/Users.php">
                        <input type="hidden" name="type" value="register">

                        <div class="mb-3">
                            <label for="userName" class="form-label">Nombre y Apellido</label>
                            <input type="text" id="userName" name="userName" class="form-control" placeholder="Nombre y Apellido..." aria-label="Nombre y Apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="userUid" class="form-label">Nombre de Usuario</label>
                            <input type="text" id="userUid" name="userUid" class="form-control" placeholder="Nombre de Usuario..." aria-label="Nombre de Usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="userPwd" class="form-label">Contraseña</label>
                            <input type="password" id="userPwd" name="userPwd" class="form-control" placeholder="Contraseña..." aria-label="Contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="pwdRepeat" class="form-label">Repetir Contraseña</label>
                            <input type="password" id="pwdRepeat" name="pwdRepeat" class="form-control" placeholder="Repetir Contraseña" aria-label="Repetir Contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="secretWord" class="form-label">Palabra Secreta</label>
                            <input type="text" id="secretWord" name="secretWord" class="form-control" placeholder="Palabra secreta..." aria-label="Palabra secreta" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" aria-label="Registrar usuario">Registrar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Cancelar">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Cambiar Contraseña -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="changePasswordTitle">Cambiar Contraseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="../controllers/Users.php">
                        <input type="hidden" name="type" value="changePassword">
                        <input type="hidden" id="change-userId" name="userId" value="">

                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Contraseña Nueva</label>
                            <input type="password" id="newPassword" name="userPwd" class="form-control" placeholder="Contraseña nueva" aria-label="Contraseña nueva" required>
                        </div>
                        <div class="mb-3">
                            <label for="repeatPassword" class="form-label">Repetir Contraseña</label>
                            <input type="password" id="repeatPassword" name="pwdRepeat" class="form-control" placeholder="Repetir Contraseña" aria-label="Repetir Contraseña" required>
                        </div>
                        <?php if ($_SESSION['IS_ADMIN'] != 1): ?>
                            <div class="mb-3">
                                <label for="secretWordChange" class="form-label">Palabra Secreta</label>
                                <input type="text" id="secretWordChange" name="secretword" class="form-control" placeholder="Palabra secreta..." aria-label="Palabra secreta">
                            </div>
                        <?php endif; ?>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" aria-label="Confirmar cambio de contraseña">Confirmar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Cancelar">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setupChangePasswordButtons();
        });

        function setupChangePasswordButtons() {
            // Seleccionar todos los botones que abren el modal de cambiar contraseña
            const changePasswordButtons = document.querySelectorAll(".changePassword");

            changePasswordButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const userId = button.getAttribute("data-id"); // Obtener la ID del usuario desde el atributo data-id
                    const changePasswordModal = document.querySelector("#changePasswordModal"); // Seleccionar el modal
                    const userIdInput = changePasswordModal.querySelector("#change-userId"); // Seleccionar el campo input hidden
                    userIdInput.value = userId; // Asignar la ID al campo input hidden
                });
            });
        }
    </script>
</body>

</html>