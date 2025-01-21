<?php
if(!isset($_SESSION)){
    session_start();
}

function flash($name = '', $message = '', $class = 'form-message form-message-red'){
    if(!empty($name)){
        if(!empty($name)){
            if(!empty($message) && empty($_SESSION[$name])){
                $_SESSION[$name] = $message;
                $_SESSION[$name.'class'] = $class;
            }else if(empty($message) && !empty($_SESSION[$name])){
                $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : $class;
                echo '<div class="'.$class.'" >'.$_SESSION[$name].'</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name.'_class']);
            }
       }
    }
}

function redirect($location){
    header("location: ".$location);
    exit();
}

function ensureLoggedIn() {
    if(!isset($_SESSION['userId'])) {
        flash("login", "Por favor, inicie sesión para continuar");
        header("location: ../views/login.php");
        exit();
    }
}
?>