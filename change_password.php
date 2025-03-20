<?php
require_once 'controllers/users.php';
require_once 'helpers/session_helper.php';

class PasswordChanger {
    private $usersController;

    public function __construct() {
        $this->usersController = new Users();
    }

    public function run() {
        // Autenticación del administrador
        echo "Ingrese su nombre de usuario (administrador): ";
        $adminUsername = trim(fgets(STDIN));

        echo "Ingrese su contraseña: ";
        $adminPassword = trim(fgets(STDIN));

        // Simular datos POST para la autenticación
        $_POST['name'] = $adminUsername;
        $_POST['userPwd'] = $adminPassword;

        // Intentar iniciar sesión
        ob_start(); // Capturar cualquier salida de la función login
        $this->usersController->login();
        ob_end_clean();

        // Verificar si la sesión tiene permisos de administrador
        if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN'] != 1) {
            echo "Error: No tiene permisos de administrador.\n";
            return;
        }

        // Solicitar el nombre de usuario y la nueva contraseña
        echo "Ingrese el nombre de usuario del usuario a modificar: ";
        $userUid = trim(fgets(STDIN));

        echo "Ingrese la nueva contraseña: ";
        $newPassword = trim(fgets(STDIN));

        // Simular datos POST para actualizar la contraseña
        $_POST['userUid'] = $userUid;
        $_POST['newPassword'] = $newPassword;

        // Intentar actualizar la contraseña
        ob_start(); // Capturar cualquier salida de la función updatePassword
        $this->usersController->updatePassword();
        ob_end_clean();

        echo "Contraseña actualizada correctamente para el usuario '$userUid'.\n";
    }
}

// Ejecutar el script
$changer = new PasswordChanger();
$changer->run();