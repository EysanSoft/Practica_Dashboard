<?php
session_start();
session_unset();
session_destroy();
$customResponse = ["message" => "Cerraste Sesión."];
echo json_encode($customResponse);
?>