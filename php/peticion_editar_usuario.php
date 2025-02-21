<?php
include "shared/endpoints.php";

$id = $_POST["idOculto"];
$name = strip_tags($_POST["nombre"]);
$lastName = strip_tags($_POST["apellido"]);
$phone = strip_tags($_POST["telefono"]);
$phone = str_replace(' ', '', $phone);
$phone = str_replace('-', '', $phone);
$phone = strval($phone);
$email = strip_tags($_POST["correo"]);

if(isset($_POST["permisos"])) {
    switch ($_POST["permisos"]) {
        case "C":
            $permisoCrear = True;
            $permisoEliminar = False;
            break;
        case "E":
            $permisoCrear = False;
            $permisoEliminar = True;
            break;
        case "C&E":
            $permisoCrear = True;
            $permisoEliminar = True;
            break;
        default:
            $permisoCrear = False;
            $permisoEliminar = False;
            break;
    } 
}
else {
    $permisoCrear = True;
    $permisoEliminar = True;
}
$status = false;

if (empty(trim($name)) !== true && empty(trim($lastName)) !== true && empty(trim($phone)) !== true && empty(trim($email)) !== true) {
    $data = array(
        'nombre' => $name,
        'apellidos' => $lastName,
        'telefono' => $phone,
        'correo' => $email,
        'crear' => $permisoCrear,
        'eliminar' => $permisoEliminar,
    );
    $url = EndPoints::$apiUrl . EndPoints::$actualizarUsuario . $id;

    include "shared/curl_opts/put_opt.php";

    // Obtener el código de respuesta de la petición.
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch));
        $response = ["status" => $status, "message" => "Ha ocurrido un error con el servidor, intentelo más tarde."];
        curl_close($ch);
        echo json_encode($response);
    }
    elseif ($httpCode == 401) {
        $customResponse = ["status" => $status, "message" => "No tienes permiso."];
        curl_close($ch);
        echo json_encode($customResponse);
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
