<?php
require_once 'vendor/autoload.php';
include 'conexion.php';
session_start();

$client = new Google_Client();
$client->setClientId('426396660013-ans7ehle3vvpon3rg9db1qs86bc07unj.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/CURIOUSHANDS/google-callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Obtener la información del usuario
    $oauth = new Google_Service_Oauth2($client);
    $userInfo = $oauth->userinfo->get();

    $correo = $userInfo->email;
    $nombre = $userInfo->name;

    $conexion = conectarBD();
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE Correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        // Crear usuario si no existe
        $stmt = $conexion->prepare("INSERT INTO usuarios (NombreUsuario, Correo, Usuario, Contraseña) VALUES (?, ?, ?, '')");
        $usuarioDefault = explode('@', $correo)[0];
        $stmt->bind_param("sss", $nombre, $correo, $usuarioDefault);
        $stmt->execute();
        $usuario_id = $stmt->insert_id;
    } else {
        $usuario = $resultado->fetch_assoc();
        $usuario_id = $usuario['IdUsuario'];
    }

    $_SESSION['usuario_id'] = $usuario_id;
    $_SESSION['usuario'] = $correo;

    header("Location: niveles.php");
    exit;
} else {
    echo "Error al iniciar sesión con Google.";
}
?>

<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '{your-app-id}',
            cookie: true,
            xfbml: true,
            version: '{api-version}'
        });

        FB.AppEvents.logPageView();

    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) { return; }
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>