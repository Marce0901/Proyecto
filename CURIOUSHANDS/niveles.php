<?php
session_start();  // Asegúrate de que la sesión esté iniciada

if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");  // Redirige al login si no hay sesión activa
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Niveles - Curious Hands</title>
  <link rel="stylesheet" href="css/esniveles.css">
</head>

<body>
  <div class="niveles-container">
    <aside class="sidebar">
      <img src="multimedia/logo.png" class="logo-sidebar" alt="Curious Hands" />
      <ul>
        <li><a href="niveles.php">Inicio</a></li>
        <li><a href="progreso.php">Progreso</a></li>
        <li><a href="material.php">Material de apoyo</a></li>
        <li><a href="repaso.php">Prueba de repaso</a></li>
      </ul>
    </aside>

    <main class="main-niveles">
      <div class="niveles-lista">
        <div class="nivel-card" onclick="irALeccion(1)">Nivel 1<br><small>Saludos</small></div>
        <div class="nivel-card" onclick="irALeccion(2)">Nivel 2<br><small>Gracias</small></div>
        <div class="nivel-card" onclick="irALeccion(3)">Nivel 3<br><small>Expresiones</small></div>
        <div class="nivel-card" onclick="irALeccion(4)">Nivel 4<br><small>Conversación</small></div>
        <div class="nivel-card examen" onclick="irALeccion(5)">Exámenes<br><small>¡Pruébate!</small></div>
      </div>

      <div class="perfil-logros">
        <div class="perfil">
          <a href="usuarios.php"><strong>👤 Perfil</strong></a>
        </div>
        <div class="logros">
          <h4>Logros</h4>
          <ul>
            <li class="estrella" id="estrella1">⭐</li>
            <li class="estrella" id="estrella2">⭐</li>
            <li class="estrella" id="estrella3">⭐</li>
            <li class="estrella" id="estrella4">⭐</li>
          </ul>
        </div>
      </div>
    </main>
  </div>

  <div class="salir">
    <form action="Salir.php" method="post">
      <button type="submit" class="salirbtn">Cerrar sesión</button>
    </form>
  </div>

  <script src="js/scniveles.js"></script>

</body>

</html>