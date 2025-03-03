<?php
require_once '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv -> load();

// Configurar Cloudinary...
use Cloudinary\Configuration\Configuration;
Configuration::instance($_ENV['CLOUDINARY_URL']);

// Usar UploadApi para subir la imagen.
use Cloudinary\Api\Upload\UploadApi;

class Multimedia {
    public function subirImagen($url, $nombreImagen) {
        $upload = new UploadApi();
        $upload -> upload(
            $url, 
            [
                'public_id' => $nombreImagen,
                'use_filename' => true,
                'overwrite' => true
            ]
        );
    }
    public function eliminarImagen($nombreImagen) {
        (new UploadApi()) -> destroy($nombreImagen, ['resource_type' => 'image']);
    }
}
?>