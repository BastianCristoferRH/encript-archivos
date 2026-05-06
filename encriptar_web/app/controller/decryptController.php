<?php
require_once __DIR__ . '/../services/cryptoService.php';

class descryptController
{
    public function ejecutar(): void
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Metodo no permitido');
        }

        $v_archivo = $_FILES['file'] ?? null;
        $v_clave = $_POST['password'] ?? '';

        if (!$v_archivo || !$v_clave) {
            http_response_code(400);
            exit('Campos imcompletos');
        }

        $s_cryptoService = new cryptoService();

        $v_datosDecifrados = $s_cryptoService->f_decifrararArchivo($v_archivo['tmp_name'], $v_clave);

        $v_nombreSalida = preg_replace('/\.enc$/', '', $v_archivo['name']);


        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $v_nombreSalida . '"');
        header('Content-Length: ' . strlen($v_datosDecifrados));

        echo $v_datosDecifrados;
        exit;
    }
}