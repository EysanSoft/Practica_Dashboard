<?php
include "correo.php";
include "shared/endpoints.php";
$correo = strip_tags($_POST['correo']);	

$data = array(
    'correo' => $correo,
);

$url = EndPoints::$apiUrl . EndPoints::$recuperarContra;

include "shared/curl_opts/post_opt.php";

if (curl_errno($ch)) {
    throw new Exception(curl_error($ch));
    $customResponse = ["message" => "Ha ocurrido un error con el servidor, intentelo más tarde."];
    curl_close($ch);
    echo json_encode($customResponse);
}
else {
    $response = json_decode($response);

    if ($response -> success == false) {
        curl_close($ch);
        session_unset();
        session_destroy();
        echo json_encode($response);
    }
    else {
        $nombreUsuario = $response -> userName;
        $idUsuario = $response -> userId;
        $tokenAcceso = $response -> token;
        $urlAcceso = EndPoints::$webUrl . "cambiar_contrasena?token=" . $tokenAcceso . "&userId=" . $idUsuario;
        $correoEle = new Correo();
        $cuerpoCorreo = "
                            Solicitaste un cambio de contraseña. <br>
                            $nombreUsuario, ingresa a este siguiente enlace para poder cambiar tu contraseña: <br>
                            $urlAcceso <br>
                            ¡No compartas este enlace con nadie! Tienes 5 minutos para poder cambiar tu contraseña.
                        ";
        $correoEle -> enviarCorreo(
            $correo,
            'EysanDashboard - Recuperar Contraseña',
            $cuerpoCorreo,
            $nombreUsuario . ', solicitaste un cambio de contraseña: ' . $urlAcceso
        );
        $response -> token = "Revisa tu correo...";

        curl_close($ch);
        session_unset();
        session_destroy();
        echo json_encode($response);
    }
}
?>
