<?php

// Iniciar sesión solo si no está activa
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Incluir el archivo de conexión y sesión
include 'conexion.php';
include 'sesion.php';

// Verificar si el usuario ya está logueado
if (isset($_SESSION['usuario_id'])) {
  // Si está logueado, redirigir a la página de niveles
  header("Location: niveles.php");
  exit;
}

// Manejo del formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Obtener los datos del formulario de login
  $usuario = $_POST['Usuario'] ?? '';
  $contraseña = $_POST['Contraseña'] ?? '';

  // Validar los datos
  if (!$usuario || !$contraseña) {
    // Si los campos están vacíos, mostrar un mensaje
    echo "Por favor, complete todos los campos. <br><a href='login.php'>Volver</a>";
    exit;
  }

  // Conectar a la base de datos
  $conexion = conectarBD();

  // Consulta SQL segura para verificar el usuario
  $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE Usuario = ?");
  $stmt->bind_param("s", $usuario);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows > 0) {
    // Si el usuario existe, verificar la contraseña
    $usuarioDB = $resultado->fetch_assoc();
    echo "Usuario en la BD: " . $usuarioDB['Usuario'] . "<br>";
    echo "Hash en la BD: " . $usuarioDB['Contraseña'] . "<br>";

    if (password_verify($contraseña, $usuarioDB['Contraseña'])) {
      echo "✅ La contraseña coincide<br>";
      // Si la contraseña es correcta, iniciar sesión
      session_start();
      $_SESSION['usuario_id'] = $usuarioDB['IdUsuario'];
      $_SESSION['usuario'] = $usuarioDB['Usuario'];

      // Redirigir al usuario a la página de niveles
      header("Location: niveles.php");
      exit;
    } else {
      // Si la contraseña es incorrecta
      echo "Contraseña incorrecta. <a href='login.php'>Intentar de nuevo</a>";
      echo "Contraseña ingresada: $contraseña<br>";
      echo "Hash en BD: " . $usuarioDB['Contraseña'] . "<br>";
    }
  } else {
    // Si el usuario no existe
    echo "Usuario no encontrado. <a href='login.php'>Intentar de nuevo</a>";
  }

  // Cerrar las conexiones
  $stmt->close();
  $conexion->close();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Curious Hands</title>
  <link rel="stylesheet" href="css/esregistro.css" />
</head>

<body>
  <main class="registro-login">
    <section class="login">
      <h3><i class="icon-user"></i> Login</h3>
      <form id="formLogin" action="login.php" method="POST">
        <input type="text" name="Usuario" placeholder="Usuario" required />
        <input type="password" name="Contraseña" placeholder="Contraseña" required />
        <button type="submit">Ingresar</button>
      </form>
      <a href="registro.php"><strong>¿Aun no tienes cuenta? Registrate</strong></a>
      <div class="social-login">
        <img src="multimedia/microsoft.jpg" alt="Login con Microsoft" />
        <a href="google-login.php"><img src="multimedia/google.jpg" alt="Login con Google"
            style="cursor:pointer;" /></a>
        <a href="https://www.facebook.com/v22.0/dialog/oauth?client_id=1388281852326367&redirect_uri=http://localhost/CURIOUSHANDS/facebook-callback.php&scope=email"
          class="btn btn-primary"><img src="multimedia/facebook.jpg" alt="Login con Facebook"
            style="cursor:pointer;" /></a>
      </div>
    </section>
  </main>

  <script src="js/crud.js"></script>
</body>

</html>