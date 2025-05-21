<?php

include 'conexion.php';
include 'sesion.php';

// Comprobar si la sesión ya está activa
if (session_status() == PHP_SESSION_NONE) {
  session_start();  // Iniciar la sesión si no está activa
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  $conexion = conectarBD();

  // Obtener los datos del formulario
  $nombre = $_POST['NombreU'] ?? '';
  $correo = $_POST['Correo'] ?? '';
  $usuario = $_POST['Usuario'] ?? '';
  $contraseña = $_POST['Contraseña'] ?? '';
  $rcontraseña = $_POST['rcontraseña'] ?? '';
  $telefono = $_POST['Telefono'] ?? '';

  // Validaciones básicas
  if (!$nombre || !$correo || !$usuario || !$contraseña || !$rcontraseña || !$telefono) {
    echo "No se han llenado todos los campos <br><a href='registro.php'>Volver</a>";
    exit;
  }

  if ($contraseña !== $rcontraseña) {
    echo "Las contraseñas no coinciden <br><a href='registro.php'>Volver</a>";
    exit;
  }

  // Validar si ya existe un usuario o correo
  $verifica = $conexion->prepare("SELECT * FROM usuarios WHERE NombreUsuario = ? OR Correo = ?");
  $verifica->bind_param("ss", $nombre, $correo);
  $verifica->execute();
  $resultado = $verifica->get_result();

  if ($resultado->num_rows > 0) {
    echo "⚠️ Ya existe un usuario con ese nombre o correo.<br><a href='registro.php'>Volver</a>";
    exit;
  }

  // Encriptar contraseña
  $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);

  // Insertar en base de datos con prepared statements
  $stmt = $conexion->prepare("INSERT INTO usuarios (NombreUsuario, Correo, Usuario, Contraseña, Telefono) VALUES (?, ?, ?, ?, ?)");
  if (!$stmt) {
    echo "Error al preparar la consulta: " . $conexion->error;
    exit;
  }

  $stmt->bind_param("sssss", $nombre, $correo, $usuario, $contraseñaHash, $telefono);

  if ($stmt->execute()) {
    // Redirige a la página de login
    header("Location: login.php?registro=exitoso");
    exit;
  } else {
    echo "<h2>Error en el registro: " . $stmt->error . "</h2>";
  }

  // Cerrar conexiones
  $stmt->close();
  $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro / Login - Curious Hands</title>
  <link rel="stylesheet" href="css/esregistro.css" />
</head>

<body>
  <main class="registro-login">
    <section class="registro">
      <h3>Únete a nuestra comunidad y aprende<br><strong>Lengua de Señas!</strong></h3>
      <form id="formRegistro" action="registro.php" method="POST">
        <input type="text" name="NombreU" placeholder="Nombre completo" required />
        <input type="email" name="Correo" placeholder="Correo electrónico" required />
        <input type="text" name="Usuario" placeholder="Crea usuario" required />
        <input type="password" name="Contraseña" placeholder="Contraseña" required />
        <input type="password" name="rcontraseña" placeholder="Repite la contraseña" required />
        <input type="tel" name="Telefono" placeholder="Teléfono" required />
        <button type="submit">Registrarse</button>
      </form>
    </section>
  </main>
  <script src="js/crud.js"></script>
</body>

</html>