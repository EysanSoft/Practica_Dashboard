<?php	
include "shared/endpoints.php";

session_start();

$url = EndPoints::$apiUrl . EndPoints::$obtenerFotoDePerfil . $_SESSION["userId"];

include "shared/curl_opts/get_opt.php";

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    throw new Exception(curl_error($ch));
    $customResponse = ["message" => "Ha ocurrido un error con el servidor, intentelo más tarde."];
    curl_close($ch);
    echo json_encode($customResponse);
}
elseif ($httpCode == 401) {
    $customResponse = ["message" => "No tienes permiso."];
    curl_close($ch);
    echo json_encode($customResponse);
}
else {
    echo $response;
}
?>