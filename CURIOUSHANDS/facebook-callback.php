<?php
include 'conexion.php';
session_start();

$app_id = '1388281852326367';
$app_secret = 'b9becf30c408764ee056695f0de9c4d4';
$redirect_uri = 'http://localhost/CURIOUSHANDS/facebook-callback.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Paso 1: Obtener access_token
    $token_url = "https://graph.facebook.com/v22.0/oauth/access_token?" .
        "client_id=$app_id&redirect_uri=$redirect_uri&client_secret=$app_secret&code=$code";

    $response = file_get_contents($token_url);
    $params = json_decode($response, true);

    if (isset($params['access_token'])) {
        $access_token = $params['access_token'];

        // Paso 2: Obtener info del usuario
        $user_info = file_get_contents("https://graph.facebook.com/me?fields=name,email&access_token=$access_token");
        $user = json_decode($user_info, true);

        // Verificar si se recibió el correo
        if (isset($user['email'])) {
            $nombre = $user['name'];
            $correo = $user['email'];

            $conexion = conectarBD();
            $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE Correo = ?");
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows === 0) {
                // Si no existe el usuario, registrarlo
                $usuarioDefault = explode('@', $correo)[0]; // Genera un nombre de usuario por defecto
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

            // Redirigir al usuario
            header("Location: niveles.php");
            exit;
        } else {
            die('Error: No se recibió el correo electrónico desde Facebook.');
        }
    } else {
        echo "Error obteniendo el token de acceso.";
    }
} else {
    header("Location: login.php");
    echo "No se recibió el código de autorización.";
}
?>