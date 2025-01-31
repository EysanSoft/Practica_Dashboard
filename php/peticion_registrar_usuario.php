<?php
include "shared/endpoints.php";
$name = strip_tags($_POST["nombre"]);
$lastName = strip_tags($_POST["apellido"]);
// Validar telefono.
$phone = strip_tags($_POST["telefono"]);
$phone = str_replace(' ', '', $phone);
$phone = str_replace('-', '', $phone);
$phone = strval($phone);
$email = strip_tags($_POST["correo"]);
// Validar contraseña.
$password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
$password = strip_tags($_POST["contra"]);
$password2 = strip_tags($_POST["conContra"]);
$status = false;

if (empty(trim($name)) !== true && empty(trim($lastName)) !== true && empty(trim($phone)) !== true && empty(trim($email)) !== true && empty(trim($password)) !== true && empty(trim($password2)) !== true) { 
    if(preg_match($password_regex, $password) == 0) {
        $customResponse = ["status" => $status, "message" => "La contraseña no cumple con los requisitos."];
        echo json_encode($customResponse);
        exit();
    }
    if ($password != $password2) {
        $customResponse = ["status" => $status, "message" => "¡Las contraseñas no coinciden!"];
        echo json_encode($customResponse);
        exit();
    }
    else {
        $data = array(
            'nombre' => $name,
            'apellidos' => $lastName,
            'telefono' => $phone,
            'correo' => $email,
            'contrasena' => $password,
        );
        $url = EndPoints::$apiUrl . EndPoints::$crearUsuario;
    
        include "shared/curl_opts/post_opt.php";

        // Obtener el código de respuesta de la petición.
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
            $customResponse = ["status" => $status, "message" => "Ha ocurrido un error con el servidor, intentelo más tarde."];
            curl_close($ch);
            echo json_encode($customResponse);
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
                $customResponse = ["status" => $status, "message" => "Has sido registrado, ¡bienvenido $name!"];
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
