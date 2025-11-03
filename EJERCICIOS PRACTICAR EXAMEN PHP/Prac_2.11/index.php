<?php
define("PRECIO_JUDIAS", 3.50);
define("PRECIO_PATATAS", 0.40);
define("PRECIO_TOMATES", 1.00);
define("PRECIO_MANZANAS", 1.20);
define("PRECIO_UVAS", 2.50);

$fruta = "Patatas";
switch ($fruta) {
    case "Judías":
        echo PRECIO_JUDIAS;
        break;

    case "Patatas":
        echo PRECIO_PATATAS;
        break;
    case "Tomates":
        echo PRECIO_TOMATES;
        break;
    case "Manzanas":
        echo PRECIO_MANZANAS;
        break;
    case "Uvas":
        echo PRECIO_UVAS;
        break;

}
?>