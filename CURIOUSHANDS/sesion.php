<?php

// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ya está logueado
function verificarSesion()
{
    // Si no está logueado, redirigir al login
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php");
        exit();
    }
}
?>