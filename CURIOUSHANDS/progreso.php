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
    <title>Progreso - Curious Hands</title>
    <link rel="stylesheet" href="css/esprogreso.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Agregar Chart.js -->
</head>

<body>
    <div class="progreso-container">
        <aside class="sidebar">
            <img src="multimedia/logo.png" class="logo-sidebar" alt="Curious Hands" />
            <ul>
                <li><a href="niveles.php">Inicio</a></li>
                <li><a href="progreso.php">Progreso</a></li>
                <li><a href="material.php">Material de apoyo</a></li>
                <li><a href="repaso.php">Prueba de repaso</a></li>
            </ul>
        </aside>

        <main class="main-progreso">
            <h1>Tu Progreso</h1>

            <!-- Gráfico de Progreso -->
            <section class="grafico">
                <h2>Progreso por Nivel</h2>
                <canvas id="graficoNivel" width="400" height="200"></canvas>
            </section>

            <section class="grafico">
                <h2>Progreso por Lección</h2>
                <canvas id="graficoLeccion" width="400" height="200"></canvas>
            </section>

            <section class="grafico">
                <h2>Logros</h2>
                <p>A continuación, podrás ver los logros que has alcanzado:</p>
                <ul>
                    <li><strong>Lecciones Completadas:</strong> 3/5</li>
                    <li><strong>Exámenes Aprobados:</strong> 2/3</li>
                </ul>
            </section>
        </main>
    </div>

    <div class="salir">
        <form action="Salir.php" method="post">
            <button type="submit" class="salirbtn">Cerrar sesión</button>
        </form>
    </div>

    <script src="js/scprogreso.js"></script>

</body>

</html>