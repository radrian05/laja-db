<?php
// Ruta al archivo config.json
$configFile = __DIR__ . '/../config.json';

// Verificar si el archivo existe
if (!file_exists($configFile)) {
    die("Error: El archivo de configuración no existe.");
}

// Leer y decodificar el archivo JSON
$configData = json_decode(file_get_contents($configFile), true);

// Verificar si la decodificación fue exitosa
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error: No se pudo decodificar el archivo de configuración.");
}

// Extraer los valores de configuración de la base de datos
if (isset($configData['DB'][0])) {
    define('DB_HOST', $configData['DB'][0]['host']);
    define('DB_USER', $configData['DB'][0]['user']);
    define('DB_PASSWORD', $configData['DB'][0]['password']);
    define('DB_NAME', $configData['DB'][0]['dbname']);
} else {
    die("Error: Configuración de la base de datos no encontrada en config.json.");
}
?>