<?php
include "shared/endpoints.php";

$id = $_POST["hiddenIdUser"];
$name = strip_tags($_POST["nombre"]);
$lastName = strip_tags($_POST["apellido"]);
// Validar telefono.
$phone = strip_tags($_POST["telefono"]);
$phone = str_replace(' ', '', $phone);
$phone = str_replace('-', '', $phone);
$phone = strval($phone);
$email = strip_tags($_POST["correo"]);
$status = false;

if (empty(trim($name)) !== true && empty(trim($lastName)) !== true && empty(trim($phone)) !== true && empty(trim($email)) !== true) {
    // El campo id es necesario para la petición cURL.
    $data = array(
        'nombre' => $name,
        'apellidos' => $lastName,
        'telefono' => $phone,
        'correo' => $email,
    );
    $url = EndPoints::$apiUrl . EndPoints::$actualizarUsuario . $id;
    include "shared/curl_opts/put_opt.php";

    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch));
        $response = ["status" => $status, "message" => "Ha ocurrido un error con el servidor, intentelo más tarde."];
        curl_close($ch);
        echo json_encode($response);
    }
    else {
        $status = true;
        $response = json_decode($response);

        // Validar si se obtuvo una excepción de parte de la API.
        if (isset($response->errors)) {
            $status = false;
            if (isset($response->errors->Email[0])) {
                $message = $response->errors->Email[0];
            } 
            elseif (isset($response->errors->Phone[0])) {
                $message = $response->errors->Phone[0];
            }
            elseif (isset($response->errors->Name[0])) {
                $message = $response->errors->Name[0];
            }
            elseif (isset($response->errors->LastName[0])) {
                $message = $response->errors->LastName[0];
            }
            else {
                $message = "Ha ocurrido un error con el servidor, intentelo más tarde.";
            }
            $customResponse = ["status" => $status, "message" => $message];
            curl_close($ch);
            echo json_encode($customResponse);
        }
        else {
            $customResponse = ["status" => $status, "message" => "Los datos del usuario han sido actualizados"];
            curl_close($ch);
            echo json_encode($customResponse);
        }
    }
}
else {
    $response = ["status" => $status, "message" => "Uno o más campos están vacíos"];
    echo json_encode($response);
    exit();
}
