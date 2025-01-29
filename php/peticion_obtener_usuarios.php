<?php	
include "shared/endpoints.php";
$url = EndPoints::$apiUrl . EndPoints::$obtenerUsuarios;

include "shared/curl_opts/get_opt.php";

echo $response;
?>
