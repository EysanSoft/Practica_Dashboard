<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
class Correo {
    
    public function enviarCorreo($correo, $asunto, $cuerpo, $cuerpoSinEstilos) {
        $usuario = $_ENV['REMITENTE_USUARIO'];
        $contra = $_ENV['CONTRA_REMITENTE_USUARIO'];
        $host = $_ENV['SMTP_HOST'];
        $puerto = $_ENV['SMTP_PORT'];
        $mail = new PHPMailer(true);

        try {
            // Configuraciones                  
            $mail->isSMTP();                                            
            $mail->Host       = $host;            
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = $usuario;               
            $mail->Password   = $contra;                         
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
            $mail->Port       = $puerto;                                  

            // Remitente
            $mail->setFrom($usuario, 'Correo Pruebas');
            // Destinatario
            $mail->addAddress($correo);    

            //Content
            $mail->isHTML(true);                            
            $mail->Subject = $asunto;
            $mail->Body    = $cuerpo;
            $mail->AltBody = $cuerpoSinEstilos;

            $mail->send();
            return "Correo Enviado.";
        }
        catch (Exception $e) {
            return "Error al enviar el correo";
        }
    }
}
