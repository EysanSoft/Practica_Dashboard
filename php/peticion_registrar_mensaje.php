<?php
require_once '../vendor/autoload.php';
include "shared/endpoints.php";

use Twilio\Rest\Client;

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
$status = false;

switch ($_POST["tipo"]) {
    case "C": $tipo = "Correo Electrónico";
      break;
    case "T": $tipo = "SMS";
      break;
    case "W": $tipo = "WhatsApp";
      break;
} 
if ($_POST["tipo"] == "D") {
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
    $contacto = strip_tags($_POST["contacto"]);

    if ($_POST["tipo"] == "T" || $_POST["tipo"] == "W") {
        // Validar telefono.
        $contacto = str_replace(' ', '', $contacto);
        $contacto = str_replace('-', '', $contacto);
        $contacto = strval($contacto);
    }
    if (empty(trim($cuerpo)) !== true && empty(trim($contacto)) !== true) {
        session_start();
        $usuarioId = $_SESSION["userId"];
        $cliente = $_POST["cliente"];
        $data = array(
            'cuerpo' => $cuerpo,
            'contacto' => $contacto,
            'tipo' => $tipo,
            'status' => "Enviado",
            'clienteId' => $cliente,
            'usuarioId' => $usuarioId
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
                if ($_POST["tipo"] == "T") {
                    try {
                        enviarSMS($contacto, $cuerpo);
                        $customResponse = ["status" => $status, "message" => "Mensaje enviado a través de SMS"];
                        curl_close($ch);
                        echo json_encode($customResponse);
                    }
                    catch (Exception $e) {
                        $status = false;
                        $customResponse = ["status" => $status, "message" => "El mensaje fue enviado, pero ocurrio un error en el envio a través de SMS..."];
                        curl_close($ch);
                        // Aqui seria bueno hacer una petición PUT para cambiar el estado del mensaje.
                        echo json_encode($customResponse);
                    }
                }
                elseif ($_POST["tipo"] == "W") {
                    try {
                        enviarWhatsApp($contacto, $cuerpo);
                        $customResponse = ["status" => $status, "message" => "Mensaje enviado a través de WhatsApp"];
                        curl_close($ch);
                        echo json_encode($customResponse);
                    }
                    /*
                        Por alguna razón, Twilio no marca excepción cuando el numero del cliente no esté verificado.
                        Posiblemente se tenga que evaluar los contenidos de la respuesta.
                    */
                    catch (Exception $e) {
                        $status = false;
                        $customResponse = ["status" => $status, "message" => "El mensaje fue enviado, pero ocurrio un error en el envio a través de WhatsApp..."];
                        curl_close($ch);
                        echo json_encode($customResponse);
                    }
                }
                else {
                    $customResponse = ["status" => $status, "message" => "Mensaje Enviado"];
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
}

function enviarSMS($numeroCliente, $cuerpoMsg) {
    $sid    = $_ENV['SID'];
    $token  = $_ENV['TOKEN'];
    $numeroTwilio = $_ENV['TWILIO_TEL'];
    $twilio = new Client($sid, $token);
    $twilio->messages
        ->create(
            "+52$numeroCliente",
            array(
                "from" => $numeroTwilio,
                "body" => $cuerpoMsg
            )
        );
}

function enviarWhatsApp($numeroCliente, $cuerpoMsg) {
    $sid    = $_ENV['SID'];
    $token  = $_ENV['TOKEN'];
    $numeroWhatsAppTwilio = $_ENV['WHATSAPP_TWILIO_TEL'];
    $twilio = new Client($sid, $token);
    $twilio->messages
        ->create(
            "whatsapp:+521$numeroCliente",
            array(
                "from" => "whatsapp:$numeroWhatsAppTwilio",
                "body" => $cuerpoMsg
            )
        );
}
