<form action="encrypt.php" method="POST" enctype="multipart/form-data">

    <label>Archivo a cifrar:</label>
    <input type="file" name="file" required>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <button type="submit">Cifrar archivo</button>

</form>
