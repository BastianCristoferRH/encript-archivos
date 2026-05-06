<?php
require_once __DIR__ . '/../services/cryptoService.php';

class encryptController
{
    public function ejecutar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('metodo no permitido');
        }

        $v_archivo = $_FILES['file'] ?? null;
        $v_clave = $_POST['password'] ?? '';

        if (!$v_archivo || !$v_clave) {
            http_response_code(400);
            exit('Campos incompletos');

        }

        $s_datosCifrados = new cryptoService();

        $v_datosCifrados = $s_datosCifrados->f_cifrarArchivo($v_archivo['tmp_name'], $v_clave);
        $v_nombreSalida = $v_archivo['name'] . '.enc';


        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $v_nombreSalida . '"');
        header('Content-Length: ' . strlen($v_datosCifrados));

        echo $v_datosCifrados;
    }
}