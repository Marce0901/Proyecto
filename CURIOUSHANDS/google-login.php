<?php
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('426396660013-ans7ehle3vvpon3rg9db1qs86bc07unj.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/CURIOUSHANDS/google-callback.php');
$client->addScope("email");
$client->addScope("profile");

// Redirige a Google
header('Location: ' . $client->createAuthUrl());
exit;
?>