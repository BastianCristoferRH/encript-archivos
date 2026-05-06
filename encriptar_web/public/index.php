<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cifrado de Archivos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Encriptar y Desencriptar Archivos</h1>

<section class="bloque">
    <h2>Cifrar archivo</h2>
    <?php include __DIR__ . '/components/form_encrypt.php'; ?>
</section>

<section class="bloque">
    <h2>Descifrar archivo</h2>
    <?php include __DIR__ . '/components/form_decrypt.php'; ?>
</section>

</body>
</html>