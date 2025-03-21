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

        //init data
        $data = [
            'userName' => $_POST['userName'],
            'userUid' => $_POST['userUid'],
            'userPwd' => $_POST['userPwd'],
            'pwdRepeat' => $_POST['pwdRepeat'],
            'IS_ADMIN' => 0 // Valor predeterminado para nuevos usuarios
        ];

        //validar data
        if(empty($data['userName']) || empty($data['userUid']) || empty($data['userPwd']) || empty($data['pwdRepeat'])){
            //algo de un error
            flash("register", "Por favor llene todos los campos");
            redirect("../views/signup.php");
        }

        //si el nombre de usuario tiene caracteres no alfanumericos
        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['userUid'])){
            flash("register", "Nombre de usuario invalido");
            redirect("../views/signup.php");
        }

        //si la contraseña tiene menos de 8 caracteres
        if(strlen($data['userPwd']) < 8){
            flash("register", "Invalid password");
            redirect("../signup.php");
        } else if($data['userPwd'] !== $data['pwdRepeat']){ //si las contraseñas no coinciden
            flash("register", "Las contraseñas no coinciden");
            redirect("../views/signup.php");
        }

        //Si existe un usuario con el mismo username
        if($this->userModel->findUserByUsername($data['userName'])){
            flash("register", "El Nombre de usuario ya está en uso");
            redirect("../views/signup.php");
        }

        //si se llega a este punto, se ha pasado todas las validaciones
        //ahora se "hasheará" la contraseña

        $data['userPwd'] = password_hash($data['userPwd'], PASSWORD_DEFAULT);

        //Registrar Usuario
        if($this->userModel->register($data)){
            redirect("../views/login.php");
        }else{
            die("Algo salio mal...");
        }
    }

    public function login(){
        //sanitizar POST data (sin FILTER_SANITIZE_STRING)
        $_POST['userPwd'] = htmlspecialchars(trim($_POST['userPwd']));
        $_POST['name'] = htmlspecialchars(trim($_POST['name']));

        //init
        $data=[
            'name' => $_POST['name'],
            'userPwd' => $_POST['userPwd'],
        ];

        if(empty($data['name']) || empty($data['userPwd'])){
            flash("login", "Por favor, complete todos los campos");
            header("location: ../views/login.php");
            exit();
        }   
        
        //revisa si el usuario o email existe
        if($this->userModel->findUserByUsername($data['name'])){
            //si el usuario o correo fue encontrado
            $loggedInUser = $this->userModel->login($data['name'], $data['userPwd']);
            if($loggedInUser){
                //crear sesión
                $this->createUserSession($loggedInUser);
            }
        }else{ 
            //si el usuario no fue encontrado
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
   
   public function updatePassword() {
    // Verificar si el usuario actual tiene permisos de administrador
    if (!isset($_SESSION['userId']) || !isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN'] != 1) {
        flash("update_password", "No tiene permisos para actualizar contraseñas");
        redirect("../views/dashboard.php");
    }

    // Sanitizar datos del formulario
    $_POST['userUid'] = htmlspecialchars(trim($_POST['userUid']));
    $_POST['newPassword'] = htmlspecialchars(trim($_POST['newPassword']));

    // Validar datos
    if (empty($_POST['userUid']) || empty($_POST['newPassword'])) {
        flash("update_password", "Por favor, complete todos los campos");
        redirect("../views/dashboard.php");
    }

    // Validar longitud de la nueva contraseña
    if (strlen($_POST['newPassword']) < 8) {
        flash("update_password", "La contraseña debe tener al menos 8 caracteres");
        redirect("../views/dashboard.php");
    }

    // Actualizar la contraseña
    $result = $this->userModel->updatePassword($_POST['userUid'], $_POST['newPassword']);
    if ($result) {
        flash("update_password", "Contraseña actualizada correctamente");
        redirect("../views/dashboard.php");
    } else {
        flash("update_password", "Error al actualizar la contraseña");
        redirect("../views/dashboard.php");
    }
   }
}
    
$init = new Users;

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Maneja el tipo de formulario para registrar usuario o iniciar sesión
        switch ($_POST['type']) {
            case 'register':
                $init->register();
                break;
            case 'login':
                $init->login();
                break;
        }
    } else {
        switch ($_GET['q']) { // Maneja el query para cerrar la sesión
            case 'logout':
                $init->logout();
                break;
            default:
                redirect("../index.php");
        }
    }