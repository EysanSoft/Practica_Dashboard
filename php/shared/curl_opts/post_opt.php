<?php
session_start();

if (isset($_SESSION['token'])) {
    $token = $_SESSION['token'];
}

$json_data = json_encode($data);
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

if (isset($_SESSION['token'])) {
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Authorization: Bearer $token",
        "Content-Length: " . strlen($json_data)
    ));
}
else {
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Content-Length: " . strlen($json_data)
    ));
}

$response = curl_exec($ch);
