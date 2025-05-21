<?php
session_start();  // Asegúrate de que la sesión esté iniciada

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");  // Redirige al login si no hay sesión activa
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" href="css/esmaterial.css">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Material de Apoyo - Curious Hands</title>
    <link rel="stylesheet" href="css/esmaterial.css">
</head>

<body>
    <div class="material-container">
        <aside class="sidebar">
            <img src="multimedia/logo.png" class="logo-sidebar" alt="Curious Hands" />
            <ul>
                <li><a href="niveles.php">Inicio</a></li>
                <li><a href="progreso.php">Progreso</a></li>
                <li><a href="material.php">Material de apoyo</a></li>
                <li><a href="repaso.php">Prueba de repaso</a></li>
            </ul>
        </aside>

        <main class="main-material">
            <h1>Material de Apoyo: Lenguaje de Señas</h1>

            <section class="informacion">
                <h2>Introducción al Lenguaje de Señas</h2>
                <p>El lenguaje de señas es una lengua visual y gestual utilizada por la comunidad sorda en diferentes
                    partes del mundo. Aquí podrás encontrar recursos, videos e imágenes que te ayudarán a comprender
                    mejor este lenguaje.</p>
            </section>

            <section class="videos">
                <h2>Videos Educativos</h2>
                <p>Explora estos videos para aprender más sobre el lenguaje de señas:</p>
                <ul>
                    <li>
                        <h3>Abecedario en Señas - Minders</h3>
                        <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/g1Yxx1PzSjg?si=1Dt8oome4x_Pfran"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </li>
                    <li>
                        <h3>¿La lengua de señas es universal?</h3>
                        <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/q-juc7-tByU?si=uihTqvfke0vq-__o"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </li>
                </ul>
            </section>

            <section class="imagenes">
                <h2>Imágenes y Diagramas</h2>
                <p>Estas son algunas imágenes que ilustran signos comunes en el lenguaje de señas:</p>
                <div class="galeria-imagenes">
                    <img src="multimedia/senas/aloha.jpg" alt="Signo Aloha en Lenguaje de Señas" />
                    <img src="multimedia/senas/greetings.jpg" alt="Signos para Saludos" />
                    <img src="multimedia/senas/gracias.jpg" alt="Signo Gracias en Lenguaje de Señas" />
                </div>
            </section>

            <section class="enlaces">
                <h2>Enlaces Útiles</h2>
                <p>A continuación, algunos enlaces donde puedes aprender más sobre el lenguaje de señas:</p>
                <ul>
                    <li><a href="https://www.lenguajedeseñas.com" target="_blank">Lengua de Señas Española - Web
                            oficial</a></li>
                    <li><a href="https://www.youtube.com/c/LenguaDeSeñas" target="_blank">Canal de YouTube de Lengua de
                            Señas</a></li>
                    <li><a href="https://www.materiaisprofesor.com/lengua-de-senas" target="_blank">Materiales de apoyo
                            y recursos</a></li>
                </ul>
            </section>
        </main>
    </div>

    <div class="salir">
        <form action="Salir.php" method="post">
            <button type="submit" class="salirbtn">Cerrar sesión</button>
        </form>
    </div>

    <script src="js/scmaterial.js"></script>

</body>

</html>