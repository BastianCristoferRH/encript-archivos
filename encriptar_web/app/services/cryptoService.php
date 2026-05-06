<?php

class cryptoService
{
    private string $v_algoritmo = 'AES-256-CBC';
    private int $v_longitud = 16;
    private int $v_interacion = 100000;

    public function f_cifrarArchivo(string $v_rutaArchivo, string $v_clave): string
    {
        $v_archivo = file_get_contents($v_rutaArchivo);
        $v_salt = random_bytes(16);
        $v_iv = random_bytes($this->v_longitud);

        $v_hash = hash_pbkdf2(
            'sha256', 
            $v_clave, 
            $v_salt,
            $this->v_interacion,
            32,
            true
        );

        $v_datosCifrado = openssl_encrypt(
            $v_archivo,
            $this->v_algoritmo,
            $v_hash,
            OPENSSL_RAW_DATA,
            $v_iv
        );

        if ($v_datosCifrado === false) {
            throw new RuntimeException('Error al cifrar archivo');
        }

        $v_integridad = hash_hmac(
            'sha256',
            $v_datosCifrado,
            $v_hash,
            true
        );

        return $v_salt . $v_iv . $v_integridad . $v_datosCifrado;

    }

    public function f_decifrararArchivo(string $v_rutaArchivo, string $v_clave): string
    {

        $v_datos = file_get_contents($v_rutaArchivo);
        $v_salt = substr($v_datos, 0, 16);
        $v_iv = substr($v_datos, 16, $this->v_longitud);
        $v_hmac = substr($v_datos, 32, 32);
        $v_datosCifrados = substr($v_datos, 64);


        $v_hash = hash_pbkdf2(
            'sha256',
            $v_clave,
            $v_salt,
            $this->v_interacion,
            32,
            true
        );

        $v_hmacCalcular = hash_hmac(
            'sha256',
            $v_datosCifrados,
            $v_hash,
            true
        );

        if (!hash_equals($v_hmac, $v_hmacCalcular)) {
            throw new RuntimeException('El archivo fue modificado o password incorrecto');
        }

        $v_datosDecifrados = openssl_decrypt(
            $v_datosCifrados,
            $this->v_algoritmo,
            $v_hash,
            OPENSSL_RAW_DATA,
            $v_iv
        );


        if ($v_datosDecifrados === false) {
            throw new RuntimeException('No se puede decifrar el archivo');
        }

        return $v_datosDecifrados;
    }
}


