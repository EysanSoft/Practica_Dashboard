<?php
include "shared/endpoints.php";

$id = $_POST["idOculto"];
$name = strip_tags($_POST["nombre"]);
$lastName = strip_tags($_POST["apellido"]);
$email = strip_tags($_POST["correo"]);
// Validar telefono.
$phone = strip_tags($_POST["telefono"]);
$phone = str_replace(' ', '', $phone);
$phone = str_replace('-', '', $phone);
$phone = strval($phone);
$status = false;

if (empty(trim($name)) !== true && empty(trim($lastName)) !== true && empty(trim($email)) !== true && empty(trim($phone)) !== true) {
    $data = array(
        'nombre' => $name,
        'apellidos' => $lastName,
        'correo' => $email,
        'telefono' => $phone,
    );
    $url = EndPoints::$apiUrl . EndPoints::$actualizarCliente . $id;
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
            if (isset($response->errors->Correo[0])) {
                $message = $response->errors->Correo[0];
            } 
            elseif (isset($response->errors->Telefono[0])) {
                $message = $response->errors->Telefono[0];
            }
            elseif (isset($response->errors->Nombre[0])) {
                $message = $response->errors->Nombre[0];
            }
            elseif (isset($response->errors->Apellidos[0])) {
                $message = $response->errors->Apellidos[0];
            }
            else {
                $message = "Ha ocurrido un error con el servidor, intentelo más tarde.";
            }
            $customResponse = ["status" => $status, "message" => $message];
            curl_close($ch);
            echo json_encode($customResponse);
        }
        else {
            $customResponse = ["status" => $status, "message" => "Los datos del cliente han sido actualizados"];
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
