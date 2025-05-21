<?php
include 'conexion.php';
session_start();

// Obtener los datos enviados desde el frontend (JavaScript)
if (isset($_POST['email']) && isset($_POST['name'])) {
    $nombre = $_POST['name'];
    $correo = $_POST['email'];

    // Verificar que el correo no esté vacío
    if (empty($correo)) {
        die('Error: No se recibió el correo electrónico.');
    }

    // Conexión a la base de datos
    $conexion = conectarBD();

    // Verificar si el usuario ya existe
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE Correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        // Si no existe el usuario, registrarlo
        $usuarioDefault = explode('@', $correo)[0]; // Generar un nombre de usuario por defecto
        $stmt = $conexion->prepare("INSERT INTO usuarios (NombreUsuario, Correo, Usuario, Contraseña) VALUES (?, ?, ?, '')");
        $stmt->bind_param("sss", $nombre, $correo, $usuarioDefault);
        $stmt->execute();
        $usuario_id = $stmt->insert_id;
    } else {
        // Si ya existe el usuario, obtener el ID
        $usuario = $resultado->fetch_assoc();
        $usuario_id = $usuario['IdUsuario'];
    }

    // Guardar en la sesión
    $_SESSION['usuario_id'] = $usuario_id;
    $_SESSION['usuario'] = $correo;

    // Enviar respuesta en formato JSON
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se recibieron datos del usuario.']);
}
?>