<?php
include "shared/endpoints.php";
$status = false;
if ($_POST["tipo-select"] == "D") {
    $response = ["status" => $status, "message" => "Por favor seleccione el tipo de mensaje"];
    echo json_encode($response);
    exit();
}
elseif ($_POST["cliente"] == "D") {
    $response = ["status" => $status, "message" => "Por favor seleccione un cliente"];
    echo json_encode($response);
    exit();
}
else {
    $cuerpo = strip_tags($_POST["cuerpo"]);
    $tipo = strip_tags($_POST["tipo"]);

    if ($_POST["tipo-select"] == "T") {
        // Validar telefono.
        $tipo = str_replace(' ', '', $tipo);
        $tipo = str_replace('-', '', $tipo);
        $tipo = strval($tipo);
    }

    if (empty(trim($cuerpo)) !== true && empty(trim($tipo)) !== true) {
        $data = array(
            'cuerpo' => $cuerpo,
            'tipo' => $tipo,
            'status' => "Enviado",
            'clienteId' => $_POST["cliente"]
        );
        $url = EndPoints::$apiUrl . EndPoints::$crearMensaje;

        include "shared/curl_opts/post_opt.php";

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
                if (isset($response->errors->Cuerpo[0])) {
                    $message = $response->errors->Cuerpo[0];
                }
                elseif (isset($response->errors->Tipo[0])) {
                    $message = $response->errors->Tipo[0];
                }
                else {
                    $message = "Ha ocurrido un error con el servidor, intentelo más tarde.";
                }
                $customResponse = ["status" => $status, "message" => $message];
                curl_close($ch);
                echo json_encode($customResponse);
            }
            else {
                $customResponse = ["status" => $status, "message" => "Mensaje Escrito"];
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
}
