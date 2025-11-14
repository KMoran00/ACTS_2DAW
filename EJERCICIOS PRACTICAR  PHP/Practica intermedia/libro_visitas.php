<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Visitas</title>
</head>

<body>
    <h1>Libro Visitas</h1>
    <h2>Listado de visitas</h2>
</body>

<?php
//Abre el archivo .txt y lista según el contenido que haya dentro
$archivo = fopen('visitas.txt', 'r');
if ($archivo) {
    while (($linea = fgets($archivo)) !== false) {
        echo $linea . "<br>";
    }
    fclose($archivo);
}

echo "<br>";
echo "<a href='nueva_visita.php'>Nueva Visita</a>";

?>
</html>