<?php
if(!isset($_SESSION)){
    session_start();
}

function flash($name = '', $message = '', $class = 'alert alert-primary') {
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            // Guardar el mensaje y la clase en la sesión
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            // Mostrar el mensaje si existe en la sesión
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : 'alert alert-primary';
            echo '<div class="' . $class . ' alert-dismissible fade show" role="alert">
                    ' . $_SESSION[$name] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            // Eliminar el mensaje de la sesión
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

function redirect($location) {
    if (php_sapi_name() === 'cli') {
        // Si se ejecuta desde la terminal, no realizar redirección
        echo "Redirección omitida: $location\n";
        return;
    }
    header("location: " . $location);
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
