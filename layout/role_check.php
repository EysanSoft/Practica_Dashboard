<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
    if ($_SESSION["roleId"] == 2) {
        header("Location: ./mensajes");
        exit;
    }
}
else {
    if ($_SESSION["roleId"] == 2) {
        header("Location: ./mensajes");
        exit;
    }
}
?>
