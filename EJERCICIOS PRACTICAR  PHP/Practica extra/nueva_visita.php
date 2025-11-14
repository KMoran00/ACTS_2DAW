<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Visita</title>
</head>

<body>
    <h1>Formulario de comentarios</h1>

    <form method="POST">
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
        <br><br>
        <label for="coment">Comentario: </label>
        <textarea name="coment" id="coment" placeholder="Escribe tu comentario..." rows="3" cols="20" required>
        </textarea>
        <br><br>
        <input type="submit" value="Enviar">
    </form>

</body>

</html>

<?php
?>