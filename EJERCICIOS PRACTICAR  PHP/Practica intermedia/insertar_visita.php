<?php
//Coge la información del formulario completado de nueva_visita.php
//Y lo escribe en el visitas.txt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre']; 
    $coment = $_POST['coment'];
    $archivo = fopen('visitas.txt', 'a');
    if ($archivo) {
        $contenido = "\n". $nombre . ": " . $coment ;
        fwrite($archivo, $contenido);
        fclose($archivo);
    }
}

header("Location: libro_visitas.php");  //Redireccionar al libro visitas
?> 