<?php	
include "shared/endpoints.php";
$url = EndPoints::$apiUrl . EndPoints::$obtenerMensajes;

include "shared/curl_opts/get_opt.php";

echo $response;
?>
