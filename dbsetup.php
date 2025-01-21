<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'phplogin';

// Crear conexión
$conn = new mysqli($host, $user, $password);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear base de datos
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos creada exitosamente\n";
} else {
    echo "Error al crear la base de datos: " . $conn->error . "\n";
}

// Seleccionar la base de datos
$conn->select_db($dbname);

// Crear tabla 'users'
$sql = "CREATE TABLE IF NOT EXISTS users (
    userId INT(11) AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(100) NOT NULL,
    userUid VARCHAR(100) NOT NULL UNIQUE,
    userPwd VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla 'users' creada exitosamente\n";
} else {
    echo "Error al crear la tabla 'users': " . $conn->error . "\n";
}

// Cerrar conexión
$conn->close();
?>