<?php
// Leer CSV como array
function leerProductos($archivo) {
    $productos = [];
    if (($handle = fopen($archivo, "r")) !== FALSE) {
        $cabecera = fgetcsv($handle, 1000, ","); // Saltar cabecera
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $productos[] = [
                "id" => $data[0],
                "nombre" => $data[1],
                "precio" => $data[2],
                "descripcion" => $data[3]
            ];
        }
        fclose($handle);
    }
    return $productos;
}

// Guardar array en CSV
function guardarProductos($archivo, $productos) {
    $handle = fopen($archivo, "w");
    fputcsv($handle, ["id","nombre","precio","descripcion"]); // cabecera
    foreach ($productos as $p) {
        fputcsv($handle, [$p["id"], $p["nombre"], $p["precio"], $p["descripcion"]]);
    }
    fclose($handle);
}

// Generar ID único
function siguienteId($productos) {
    $ids = array_column($productos, "id");
    return empty($ids) ? 1 : max($ids) + 1;
}
?>
