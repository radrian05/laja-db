<?php
set_include_path(__DIR__ . PATH_SEPARATOR . get_include_path());
require_once 'lib/db.php';
require_once 'models/User.php';

// Función para confirmar la acción del usuario
function confirmAction($message) {
    echo $message . " (y/n): ";
    $handle = fopen("php://stdin", "r");
    $response = trim(fgets($handle));
    fclose($handle);
    return strtolower($response) === 'y';
}

// Crear tablas si no existen
function createTables($db) {
    // Crear tabla 'users'
    $createUsersTable = "
        CREATE TABLE IF NOT EXISTS users (
            userId INT AUTO_INCREMENT PRIMARY KEY,
            userName VARCHAR(255) NOT NULL,
            userUid VARCHAR(255) NOT NULL UNIQUE,
            userPwd VARCHAR(255) NOT NULL,
            IS_ADMIN TINYINT(1) NOT NULL DEFAULT 0
        );
    ";

    // Crear tabla 'items'
    $createItemsTable = "
        CREATE TABLE IF NOT EXISTS items (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            CODE VARCHAR(255) NOT NULL,
            NAME VARCHAR(255) NOT NULL,
            BRAND VARCHAR(255) NOT NULL,
            CATEGORY VARCHAR(255) NOT NULL,
            PRICE DECIMAL(10, 2) NOT NULL,
            STOCK INT NOT NULL
        );
    ";

    try {
        // Ejecutar las consultas
        $db->query($createUsersTable);
        $db->execute();
        echo "Tabla 'users' creada o ya existe.\n";

        $db->query($createItemsTable);
        $db->execute();
        echo "Tabla 'items' creada o ya existe.\n";
    } catch (Exception $e) {
        echo "Error al crear las tablas: " . $e->getMessage() . "\n";
    }
}

// Crear el primer usuario
function createFirstUser($userModel) {
    echo "Ingrese el nombre completo del usuario: ";
    $handle = fopen("php://stdin", "r");
    $userName = trim(fgets($handle));

    echo "Ingrese el nombre de usuario: ";
    $userUid = trim(fgets($handle));

    echo "Ingrese la contraseña: ";
    $userPwd = trim(fgets($handle));

    echo "Confirme la contraseña: ";
    $pwdRepeat = trim(fgets($handle));
    fclose($handle);

    // Validar contraseñas
    if ($userPwd !== $pwdRepeat) {
        echo "Las contraseñas no coinciden. Operación cancelada.\n";
        return;
    }

    // Verificar si el usuario ya existe
    if ($userModel->findUserByUsername($userUid)) {
        echo "El usuario '$userUid' ya existe. No se creó un nuevo usuario.\n";
        return;
    }

    // Hashear la contraseña
    $hashedPwd = password_hash($userPwd, PASSWORD_DEFAULT);

    // Crear el usuario con IS_ADMIN = 1
    $data = [
        'userName' => $userName,
        'userUid' => $userUid,
        'userPwd' => $hashedPwd,
        'IS_ADMIN' => 1
    ];

    if ($userModel->register($data)) {
        echo "El usuario '$userUid' ha sido creado exitosamente.\n";
    } else {
        echo "Error al crear el usuario.\n";
    }
}

// Confirmar acción del usuario
if (confirmAction("¿Desea crear las tablas 'users' y 'items' si no existen?")) {
    // Conectar a la base de datos
    $db = new DB();
    createTables($db);

    // Confirmar creación del primer usuario
    if (confirmAction("¿Desea crear un primer usuario?")) {
        $userModel = new User();
        createFirstUser($userModel);
    }
} else {
    echo "Operación cancelada.\n";
}
?>