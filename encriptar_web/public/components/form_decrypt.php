<form action="decrypt.php" method="POST" enctype="multipart/form-data">

    <label>Archivo cifrado (.enc):</label>
    <input type="file" name="file" required>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <button type="submit">Descifrar archivo</button>

</form>
