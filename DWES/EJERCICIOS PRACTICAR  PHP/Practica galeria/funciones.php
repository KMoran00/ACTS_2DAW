<?php
// Comprobar si el formato es válido (JPG, PNG, GIF)
function imgValida($nombre) {
    $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
    return ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif");
}

// Devuelve un listado de todos los archivos de la carpeta
function listarImagenes($carpeta) {
    return scandir($carpeta); // scandir lista el contenido de uploads
}
?>