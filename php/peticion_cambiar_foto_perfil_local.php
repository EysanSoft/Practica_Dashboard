<?php
include "shared/endpoints.php";
$status = false;

session_start();

$userId = $_SESSION['userId'];
$currentImageName = $_POST["imageName"];

$nombreImagen = $_FILES["fotoDePerfil"]["name"];
$tempImagen = $_FILES["fotoDePerfil"]["tmp_name"];

$extImagen = $_FILES["fotoDePerfil"]["type"];
$extension = explode("/", $extImagen);
$currentImageRoute = "../img/perfil/$currentImageName";
if (strlen($currentImageName) > 0 && file_exists($currentImageRoute)) {
    unlink($currentImageRoute);
}
// Valida que la extensión sea PNG, JPG o JPEG.
if ($extension[1] == "png" || $extension[1] == "jpg" || $extension[1] == "jpeg") {
    $randomName = uniqid();
    $nombreImagen = $randomName . "." . $extension[1];
    $ruta = "../img/perfil/$nombreImagen";

    // Valida si la imagen fue almacenada a la ruta local establecida.
    if (move_uploaded_file($tempImagen, $ruta)) {
        if (empty(trim($nombreImagen)) !== true) {
            $data = array(
                'imageUrl' => $nombreImagen,
            );
            $url = EndPoints::$apiUrl . EndPoints::$actualizarFotoDePerfil . $userId;
        
            include "shared/curl_opts/put_opt.php";
        
            if (curl_errno($ch)) {
                throw new Exception(curl_error($ch));
                $response = ["status" => $status, "message" => "Ha ocurrido un error con el servidor, intentelo más tarde."];
                curl_close($ch);
                echo json_encode($response);
            } 
            else {
                $status = true;
                $response = ["status" => $status, "message" => "¡Foto de perfil establecida!"];
                curl_close($ch);
                echo json_encode($response);
            }
        } 
        else {
            $response = ["status" => $status, "message" => "Uno o mas campos estan vacios"];
            echo json_encode($response);
            exit();
        }
    } 
    else {
        $response = ["status" => $status, "message" => "Error al subir la imagen."];
        echo json_encode($response);
    }
} 
else {
    $response = ["status" => $status, "message" => "Solo se permiten imágenes en formato PNG, JPG o JPEG."];
    echo json_encode($response);
}
