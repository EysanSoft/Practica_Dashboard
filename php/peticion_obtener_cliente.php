<?php
include "shared/endpoints.php";
$indexID = $_POST['postID'];	
$url = EndPoints::$apiUrl . EndPoints::$obtenerCliente . $indexID;

include "shared/curl_opts/get_opt.php";

echo $response;
?>
