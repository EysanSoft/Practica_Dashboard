<?php	
include "shared/endpoints.php";
$ini = strip_tags($_POST["postFechaInicial"]);
$fin = strip_tags($_POST["postFechaFinal"]);
$data = array(
    'inicial' => $ini,
    'final' => $fin
);

session_start();

if ($_SESSION["roleId"] == 1) {
    $url = EndPoints::$apiUrl . EndPoints::$obtenerMensajes;
}
else {
    $url = EndPoints::$apiUrl . EndPoints::$obtenerMensajes . $_SESSION["userId"];
}

include "shared/curl_opts/get_wh_opt.php";

// Obtener el código de respuesta de la petición.
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
