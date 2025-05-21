<?php
session_start();

// Verifica si la respuesta está disponible
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respuesta = $_POST['respuesta'];

    // Simula la respuesta correcta (en este caso, 'A' es la correcta)
    $respuestaCorrecta = 'A';

    // Verifica si la respuesta es correcta
    if ($respuesta === $respuestaCorrecta) {
        $mensaje = "¡Correcto!";
    } else {
        $mensaje = "¡Incorrecto! La respuesta correcta es la letra A.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Prueba</title>
    <link rel="stylesheet" href="css/esrepaso.css">
</head>

<body>
    <div class="resultado-container">
        <h1>Resultado de la Pregunta</h1>
        <p><?php echo $mensaje; ?></p>
        <a href="repaso.php" class="btn-regresar">Volver a intentar</a>
    </div>
</body>

</html>