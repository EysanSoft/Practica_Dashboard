<?php
include "shared/endpoints.php";
$correo = strip_tags($_POST['correo']);	
$contra = strip_tags($_POST['contra']);

$data = array(
    'correo' => $correo,
    'contrasena' => $contra
);

$url = EndPoints::$apiUrl . EndPoints::$iniciarSesion;

include "shared/curl_opts/post_opt.php";

// Obtener el código de respuesta de la petición.
// $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    throw new Exception(curl_error($ch));
    $customResponse = ["message" => "Ha ocurrido un error con el servidor, intentelo más tarde."];
    curl_close($ch);
    echo json_encode($customResponse);
}
else {
    $response = json_decode($response);
    if ($response -> success == false) {
        curl_close($ch);
        session_unset();
        session_destroy();
        echo json_encode($response);
    }
    else {
        $_SESSION['token'] = $response -> token;
        $response -> token = "";
        curl_close($ch);
        echo json_encode($response);
    }
}
?>
