<?php
include "shared/endpoints.php";

session_start();

$userId = $_SESSION['userId'];
$password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
$password = strip_tags($_POST["contra"]);
$password2 = strip_tags($_POST["conContra"]);
$status = false;

if (empty(trim($password)) !== true && empty(trim($password2)) !== true) {
    if(preg_match($password_regex, $password) == 0) {
        $customResponse = [
            "status" => $status,
            "message" => "La contraseña no cumple con los requisitos. Mínimo 8 caracteres, una letra en mayúscula y otra en minúscula, un número y un símbolo especial: #?!@$%^&*-"
        ];
        echo json_encode($customResponse);
        exit();
    }
    else if ($password != $password2) {
        $customResponse = ["status" => $status, "message" => "¡Las contraseñas no coinciden!"];
        echo json_encode($customResponse);
        exit();
    }
    else {
        $data = array(
            'contrasena' => $password
        );
        $url = EndPoints::$apiUrl . EndPoints::$actualizarContra . $userId;
    
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
                if (isset($response->errors->Contrasena[0])) {
                    $message = $response->errors->Contrasena[0];
                } 
                else {
                    $message = "Ha ocurrido un error con el servidor, intentelo más tarde.";
                }
                $customResponse = ["status" => $status, "message" => $message];
                curl_close($ch);
                echo json_encode($customResponse);
            }
            else {
                $customResponse = ["status" => $status, "message" => "Su contraseña ha sido actualizada"];
                curl_close($ch);
                echo json_encode($customResponse);
            }
        }
    }
}
else {
    $response = ["status" => $status, "message" => "Uno o más campos están vacíos"];
    echo json_encode($response);
    exit();
}
?>
