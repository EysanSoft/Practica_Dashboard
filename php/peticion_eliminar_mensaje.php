<?php
include "shared/endpoints.php";
$id = $_POST["postID"];
$status = false;
$url = EndPoints::$apiUrl . EndPoints::$eliminarMensaje . $id;

include "shared/curl_opts/delete_opt.php";

if (curl_errno($ch)) {
    throw new Exception(curl_error($ch));
    $response = ["status" => $status, "message" => "Ha ocurrido un error con el servidor, intentelo más tarde."];
    curl_close($ch);
    echo json_encode($response);
} 
else {
    $status = true;
    $response = ["status" => $status, "message" => "Mensaje eliminado."];
    curl_close($ch);
    echo json_encode($response);
}
?>
