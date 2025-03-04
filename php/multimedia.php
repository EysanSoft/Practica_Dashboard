<?php
require_once '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv -> load();

// Configurar Cloudinary...
use Cloudinary\Configuration\Configuration;
Configuration::instance($_ENV['CLOUDINARY_URL']);
// Usar UploadApi para subir la imagen.
use Cloudinary\Api\Upload\UploadApi;
// Usar AdminApi para obtener los datos de la imagen subida.
use Cloudinary\Api\Admin\AdminApi;

class Multimedia {
    public function subirImagen($url, $nombreImagen) {
        $upload = new UploadApi();
        $upload -> upload(
            $url, 
            [
                'public_id' => $nombreImagen,
                'use_filename' => true,
                'overwrite' => true,
                'media_metadata' => true,
                'format' => 'webp',
                "eager" => [
                    ["fetch_format" => "jpg", "format" => "webp"],
                    ["fetch_format" => "png", "format" => "webp"]
                ]
            ]
        );
        $result = (new AdminApi())->asset($nombreImagen);

        return $result;
    }
    public function eliminarImagen($nombreImagen) {
        (new UploadApi()) -> destroy($nombreImagen, ['resource_type' => 'image']);
    }
}
?>