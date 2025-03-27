<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../helpers/session_helper.php';

class Users{
    private $userModel;

    public function __construct(){
        $this->userModel = new User; 
    }

    public function register(){
        //procesa el formulario

        // Sanitizar POST data (sin usar FILTER_SANITIZE_STRING)
        $_POST['userName'] = htmlspecialchars(trim($_POST['userName']));
        $_POST['userUid'] = htmlspecialchars(trim($_POST['userUid']));
        $_POST['userPwd'] = htmlspecialchars(trim($_POST['userPwd']));
        $_POST['pwdRepeat'] = htmlspecialchars(trim($_POST['pwdRepeat']));
        $_POST['secretWord'] = htmlspecialchars(trim($_POST['secretWord']));

        //init data
        $data = [
            'userName' => $_POST['userName'],
            'userUid' => $_POST['userUid'],
            'userPwd' => $_POST['userPwd'],
            'pwdRepeat' => $_POST['pwdRepeat'],
            'secretWord' => $_POST['secretWord'],
            'IS_ADMIN' => 0 // Valor predeterminado para nuevos usuarios
        ];

        //validar data
        if(empty($data['userName']) || empty($data['userUid']) || empty($data['userPwd']) || empty($data['pwdRepeat']) || empty($data['secretWord'])){
            //algo de un error
            flash("register", "Por favor llene todos los campos");
            redirect("../views/userControl.php");
        }

        //si el nombre de usuario tiene caracteres no alfanumericos
        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['userUid'])){
            flash("register", "Nombre de usuario invalido");
            redirect("../views/userControl.php");
        }

        //si la contraseña tiene menos de 8 caracteres
        if(strlen($data['userPwd']) < 8){
            flash("register", "Invalid password");
            redirect("../views/userControl.php");
        } else if($data['userPwd'] !== $data['pwdRepeat']){ //si las contraseñas no coinciden
            flash("register", "Las contraseñas no coinciden");
            redirect("../views/userControl.php");
        }

        //Si existe un usuario con el mismo username
        if($this->userModel->findUserByUsername($data['userUid'])){
            flash("register", "El Nombre de usuario ya está en uso");
            redirect("../views/userControl.php");
        }

        //si se llega a este punto, se ha pasado todas las validaciones
        //ahora se "hasheará" la contraseña

        $data['userPwd'] = password_hash($data['userPwd'], PASSWORD_DEFAULT);

        //Registrar Usuario
        if($this->userModel->register($data)){
            flash("register", "Usuario registrado correctamente");
            redirect("../views/userControl.php");
        }else{
            flash("register", "Error al registrar el usuario");
            redirect("../views/userControl.php");
        }
    }

    public function login() {
        // Sanitizar POST data
        $_POST['userPwd'] = htmlspecialchars(trim($_POST['userPwd']));
        $_POST['name'] = htmlspecialchars(trim($_POST['name']));

        // Inicializar datos
        $data = [
            'name' => $_POST['name'],
            'userPwd' => $_POST['userPwd'],
        ];

        // Validar datos
        if (empty($data['name']) || empty($data['userPwd'])) {
            flash("login", "Por favor, complete todos los campos");
            redirect("../views/login.php");
            exit();
        }

        // Revisar si el usuario existe
        $user = $this->userModel->findUserByUsername($data['name']);
        if ($user) {
            // Verificar si el usuario está activo
            if ($user->IS_ACTIVE == 0) {
                flash("login", "Su cuenta ha sido desactivada. Contacte al administrador.");
                redirect("../views/login.php");
                exit();
            }

            // Intentar iniciar sesión
            $loggedInUser = $this->userModel->login($data['name'], $data['userPwd']);
            if ($loggedInUser) {
                // Crear sesión
                $this->createUserSession($loggedInUser);
            } else {
                flash("login", "Contraseña incorrecta");
                redirect("../views/login.php");
            }
        } else {
            // Si el usuario no fue encontrado
            flash("login", "Usuario no encontrado");
            redirect("../views/login.php");
        }
    }

   //crea la sesión
   public function createUserSession($user){
    $_SESSION['userId'] = $user->userId;
    $_SESSION['userName'] = $user->userName;
    $_SESSION['IS_ADMIN'] = $user->IS_ADMIN;
    redirect("../views/home.php");
   }

   //cierra la sesión
   public function logout(){
    unset($_SESSION['userId']);
    unset($_SESSION['userName']);
    unset($_SESSION['IS_ADMIN']);
    session_destroy();
    redirect("../views/login.php");
   }

   public function getUsers() {
    $users = $this->userModel->getUsers(); // Llama al modelo para obtener los usuarios
    return $users; // Devuelve la lista de usuarios
    }

    public function getInactiveUsers(){
        $users = $this->userModel->getInactiveUsers();
        return $users;
    }
    
   public function changePassword() {
    // Verificar si el usuario actual tiene permisos de administrador
    if (!isset($_SESSION['userId']) || !isset($_SESSION['IS_ADMIN'])) {
        flash("user_message", "No tiene permisos para actualizar contraseñas");
        redirect("../views/userControl.php");
    }

    // Sanitizar datos del formulario
    $_POST['userId'] = htmlspecialchars(trim($_POST['userId']));
    $_POST['userPwd'] = htmlspecialchars(trim($_POST['userPwd']));
    $_POST['pwdRepeat'] = htmlspecialchars(trim($_POST['pwdRepeat']));
    $_POST['secretWord'] = htmlspecialchars(trim($_POST['secretWord']));

    // Validar datos
    if (empty($_POST['userId']) || empty($_POST['userPwd']) || empty($_POST['pwdRepeat'])) {
        flash("user_message", "Por favor, complete todos los campos");
        redirect("../views/userControl.php");
    }

    // Validar que las contraseñas coincidan
    if ($_POST['userPwd'] !== $_POST['pwdRepeat']) {
        flash("user_message", "Las contraseñas no coinciden");
        redirect("../views/userControl.php");
    }

    // Validar longitud de la nueva contraseña
    if (strlen($_POST['userPwd']) < 8) {
        flash("user_message", "La contraseña debe tener al menos 8 caracteres");
        redirect("../views/userControl.php");
    }

    // Verificar la palabra secreta si el usuario no es administrador
    if ($_SESSION['IS_ADMIN'] != 1) {
        if (empty($_POST['secretWord']) || !$this->userModel->verifySecretWord($_POST['userId'], $_POST['secretWord'])) {
            flash("user_message", "Palabra secreta incorrecta");
            redirect("../views/userControl.php");
        }
    }

    // Actualizar la contraseña
    $result = $this->userModel->updatePassword($_POST['userId'], $_POST['userPwd']);
    if ($result) {
        flash("user_message", "Contraseña actualizada correctamente");
    } else {
        flash("user_message", "Error al actualizar la contraseña");
    }
    redirect("../views/userControl.php");
   }

   public function disableUser($id) {
    if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN'] != 1) {
        flash("user_message", "No tiene permisos para desactivar usuarios");
        redirect("../views/userControl.php");
    }

    if ($this->userModel->disableUser($id)) {
        flash("user_message", "Usuario desactivado correctamente");
    } else {
        flash("user_message", "Error al desactivar el usuario");
    }
    redirect("../views/userControl.php");
   }

   public function enableUser($id) {
    if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN'] != 1) {
        flash("user_message", "No tiene permisos para reactivar usuarios");
        redirect("../views/userControl.php");
    }

    if ($this->userModel->enableUser($id)) {
        flash("user_message", "Usuario reactivado correctamente");
    } else {
        flash("user_message", "Error al reactivar el usuario");
    }
    redirect("../views/userControl.php");
   }

   public function recoverPassword() {
    // Sanitizar datos del formulario
    $_POST['userUid'] = htmlspecialchars(trim($_POST['userUid']));
    $_POST['secretWord'] = htmlspecialchars(trim($_POST['secretWord']));
    $_POST['newPassword'] = htmlspecialchars(trim($_POST['newPassword']));
    $_POST['confirmPassword'] = htmlspecialchars(trim($_POST['confirmPassword']));

    // Validar datos
    if (empty($_POST['userUid']) || empty($_POST['secretWord']) || empty($_POST['newPassword']) || empty($_POST['confirmPassword'])) {
        flash("recover_password", "Por favor, complete todos los campos");
        redirect("../views/recover_password.php");
    }

    // Validar que las contraseñas coincidan
    if ($_POST['newPassword'] !== $_POST['confirmPassword']) {
        flash("recover_password", "Las contraseñas no coinciden");
        redirect("../views/recover_password.php");
    }

    // Validar longitud de la nueva contraseña
    if (strlen($_POST['newPassword']) < 8) {
        flash("recover_password", "La contraseña debe tener al menos 8 caracteres");
        redirect("../views/recover_password.php");
    }

    // Verificar la palabra secreta
    $user = $this->userModel->findUserByUsername($_POST['userUid']);
    if ($user && $user->secretWord === $_POST['secretWord']) {
        // Actualizar la contraseña en la base de datos
        $this->userModel->updatePassword($user->userId, $_POST['newPassword']);

        // Mostrar mensaje de éxito
        flash("recover_password", "Contraseña actualizada correctamente. Ahora puede iniciar sesión.");
        redirect("../views/login.php");
    } else {
        flash("recover_password", "Nombre de usuario o palabra secreta incorrectos");
        redirect("../views/recover_password.php");
    }
   }
}
    
$init = new Users;

if (php_sapi_name() !== 'cli') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $init = new Users();
        switch ($_POST['type']) {
            case 'register':
                $init->register();
                break;
            case 'changePassword':
                $init->changePassword();
                break;
            case 'login':
                $init->login();
                break;
            case 'recoverPassword':
                $init->recoverPassword();
                break;
        }
    } elseif (isset($_GET['q'])) {
        $init = new Users();
        switch ($_GET['q']) {
            case 'logout':
                $init->logout();
                break;
            case 'disableUser':
                $init->disableUser($_GET['id']);
                break;
            case 'enableUser':
                $init->enableUser($_GET['id']);
                break;
            default:
                redirect("../index.php");
        }
    }
}

?>
