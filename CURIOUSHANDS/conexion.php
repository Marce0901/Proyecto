<?php
// archivo: conexion.php


// Función para conectar a la base de datos
function conectarBD() {
    // Crear la conexión
    $conexion = new mysqli('localhost', 'root', '', 'bdproyecto');

    // Comprobar si hay error de conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Retornar la conexión
    return $conexion;
}
?>
