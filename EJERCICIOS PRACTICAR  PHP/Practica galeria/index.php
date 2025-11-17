<?php
include "funciones.php";

$mensaje = ""; //Mensaje informativo

if (!empty($_FILES["imagen"]["name"])) {
    $nombre = $_FILES["imagen"]["name"];
    $tmp = $_FILES["imagen"]["tmp_name"];
    // Verificar que sea imagen en formato válido
    if (imgValida($nombre)) {

        $carpeta = "uploads/" . $nombre;
        // Movemos el archivo al servidor
        if (move_uploaded_file($tmp, $carpeta)) {
            $mensaje = "Imagen subida correctamente.";
        } else {
            $mensaje = "Error al subir la imagen.";
        }

    } else {
        $mensaje = "ERROR. Solo JPG, PNG o GIF.";
        echo "<script>alert('" . $mensaje . "');</script>";
    }
}

$lista = listarImagenes("uploads"); // Obtenemos los archivos de la carpeta de imgs.
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería Imágenes</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h1>Galería de Imágenes</h1>
    <form method="POST" action="" enctype="multipart/form-data" class="subida">
        <input type="file" name="imagen" required>
        <button type="submit">Subir</button>
    </form>

    <h2>Imágenes</h2>
    <table class="tabla-galeria">
        <thead>
            <tr>
                <th>Miniatura</th>
                <th>Nombre</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Recorrer todos los archivos de la carpeta uploads
            foreach ($lista as $img) {

                // Ignorar los "." y ".." y verificar que sea imagen
                if ($img != "." && $img != ".." && imgValida($img)) {

                    echo "<tr>";
                    echo "<td><img src='uploads/$img' class='miniatura'></td>"; // Miniatura
                    echo "<td>$img</td>"; // Nombre del archivo
        
                    // Form para borrar la img
                    echo "<td><form action='borrar.php' method='POST' style='display:inline;' onsubmit=\"return confirm('¿Desea eliminar este archivo?');\">
                    <input type='hidden' name='archivo' value='$img'>
                    <button class='borrar' type='submit'>Borrar</button>
                    </form></td>";

                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>