<?php

// Incluir los archivos necesarios
include 'conexion.php';
include 'sesion.php';

// Iniciar sesión solo si no está activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si hay un usuario logueado
if (!isset($_SESSION['usuario_id'])) {
    echo "❌ No estás logueado. Por favor, inicia sesión.";
    exit;
}

// Obtener el ID del usuario logueado
$usuario_id = $_SESSION['usuario_id'];

// Incluir el archivo de conexión
$conexion = conectarBD();



// OBTENER EL USUARIO ACTUAL (El que está editando)
$usuarioEdit = null;
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE IdUsuario = ?");
$stmt->bind_param("i", $usuario_id); // Usamos el ID del usuario logueado
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado) {
    $usuarioEdit = $resultado->fetch_assoc();
} else {
    echo "❌ Error en la consulta: " . $conexion->error;
    exit;
}


// CREAR o ACTUALIZAR
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $telefono = $_POST['telefono'];

    if ($id) {
        // ACTUALIZAR
        $stmt = $conexion->prepare("UPDATE usuarios SET NombreUsuario=?, Correo=?, Usuario=?, Telefono=? WHERE IdUsuario=?");
        $stmt->bind_param("ssssi", $nombre, $correo, $usuario, $telefono, $id);
        $stmt->execute();
        echo "✅ Usuario actualizado.";
    }
}

// ELIMINAR
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE IdUsuario = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "🗑️ Usuario eliminado.";
}

// Si no se encuentra el usuario a editar, muestra un mensaje de error
if (!$usuarioEdit) {
    echo "❌ Usuario no encontrado.";
    exit;
}
?>


<!-- FORMULARIO DE EDITAR -->
<link rel="stylesheet" href="css/esusuarios.css">
<h2>Editar Perfil</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?= $usuarioEdit['IdUsuario'] ?>">
    <input type="text" name="nombre" placeholder="Nombre" value="<?= $usuarioEdit['NombreUsuario'] ?>" required>Nombre:
    <input type="email" name="correo" placeholder="Correo" value="<?= $usuarioEdit['Correo'] ?>" required>Email:
    <input type="text" name="usuario" placeholder="Usuario" value="<?= $usuarioEdit['Usuario'] ?>" required>Usuario:
    <input type="text" name="telefono" placeholder="Teléfono" value="<?= $usuarioEdit['Telefono'] ?>" required>Telefono:
    <button type="submit">Actualizar Usuario</button>
</form>

<hr>

<!-- Enlace para eliminar el usuario -->
<a href="?eliminar=<?= $usuarioEdit['IdUsuario'] ?>"
    onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">🗑️ Eliminar este Usuario</a>

<form action="niveles.php" method="get">
    <button type="submit" class="boton-volver">Volver</button>
</form>