<?php


require_once 'cryptoService.php';

$v_crypto = new cryptoService();

file_put_contents('original.txt', 'camaron');

$v_cifrado = $v_crypto->f_cifrarArchivo('original.txt', 'claveBastian');
file_put_contents('archivo.enc', $v_cifrado);

$v_descifrado = $v_crypto->f_decifrararArchivo('archivo.enc', 'claveBastian');
file_put_contents('resultado.txt', $v_descifrado);

echo "OK\n";
