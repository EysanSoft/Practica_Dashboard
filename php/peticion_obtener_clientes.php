<?php	
include "shared/endpoints.php";
$url = EndPoints::$apiUrl . EndPoints::$obtenerClientes;

include "shared/curl_opts/get_opt.php";

echo $response;
?>