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
    <title>Prueba de Repaso - Curious Hands</title>
    <link rel="stylesheet" href="css/esrepaso.css">
</head>

<body>
    <div class="repaso-container">
        <aside class="sidebar">
            <img src="multimedia/logo.png" class="logo-sidebar" alt="Curious Hands" />
            <ul>
                <li><a href="niveles.php">Inicio</a></li>
                <li><a href="progreso.php">Progreso</a></li>
                <li><a href="material.php">Material de apoyo</a></li>
                <li><a href="repaso.php">Prueba de repaso</a></li>
            </ul>
        </aside>

        <main class="main-repaso">
            <h1>Prueba de Repaso</h1>

            <!-- Pregunta de ejemplo -->
            <form action="repaso_resultados.php" method="POST">
                <section class="pregunta">
                    <h2>¿Qué letra representa esta seña?</h2>
                    <img src="multimedia/A.png" alt=Seña de la letra A" class="imagen-seña">

                    <div class="opciones">
                        <label>
                            <input type="radio" name="respuesta" value="A" required> A
                        </label>
                        <label>
                            <input type="radio" name="respuesta" value="B"> B
                        </label>
                        <label>
                            <input type="radio" name="respuesta" value="C"> C
                        </label>
                        <label>
                            <input type="radio" name="respuesta" value="D"> D
                        </label>
                    </div>
                </section>

                <button type="submit" class="btn-responder">Enviar Respuesta</button>
            </form>

            <!-- Aquí podrías añadir más preguntas con la misma estructura -->
        </main>
    </div>

    <div class="salir">
        <form action="Salir.php" method="post">
            <button type="submit" class="salirbtn">Cerrar sesión</button>
        </form>
    </div>

    <script src="js/screpaso.js"></script>

</body>

</html>