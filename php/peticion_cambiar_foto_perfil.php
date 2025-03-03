<?php
include "multimedia.php";
include "shared/endpoints.php";
$status = false;

session_start();

// Variables para la consulta en la BD.
$userId = $_SESSION['userId'];
$currentImageName = $_POST["imageName"];

// Variables del archivo.
$tempImage = $_FILES["fotoDePerfil"]["tmp_name"];
$extImage = $_FILES["fotoDePerfil"]["type"];

// Variables propias para facilitar las cosas.
$ext = explode("/", $extImage);
$ext = $ext[1];
$currentImageNameOnly = explode(".", $currentImageName);
$currentImageNameOnly = $currentImageNameOnly[0];
$currentImageRoute = "../img/perfil/$currentImageName";
$multimedia = new Multimedia();

// Elimina la imagen anterior del directorio local si existe.
// NOTA: Cuando se logre obtener las imagenes desde cloudinary, se eliminará esto.
if (strlen($currentImageName) > 0 && file_exists($currentImageRoute)) {
    unlink($currentImageRoute);
    // Eliminar la imagen anterior de la BD en Cloudinary.
    $multimedia -> eliminarImagen($currentImageNameOnly);
}

// Valida que la extensión sea PNG, JPG o JPEG.
if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
    $randomName = uniqid();
    $nombreImagen = $randomName . "." . $ext;
    $ruta = "../img/perfil/$nombreImagen";

    if (move_uploaded_file($tempImage, $ruta)) {
        if (empty(trim($nombreImagen)) !== true) {
            // Subir la imagen a Cloudinary.
            $multimedia -> subirImagen($ruta, $randomName);
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
            $response = ["status" => $status, "message" => "Uno o más campos estan vacios"];
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
