<?php
include "shared/endpoints.php";
$indexID = $_POST['postID'];	
$url = EndPoints::$apiUrl . EndPoints::$obtenerUsuario . $indexID;

include "shared/curl_opts/get_opt.php";

echo $response;
?>
