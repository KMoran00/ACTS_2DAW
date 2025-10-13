<?php
$ref = $_GET['ref'] ?? null; //Recoger la referencia del producto a añadir al carrito

if($ref){
    //Si la cookie 'carrito' existe, la deserializamos. Si no, creamos un array vacío
    if(isset($_COOKIE['carrito'])){
        $arrayCarrito = unserialize($_COOKIE['carrito']);
    }
    else{
        $arrayCarrito = [];
    }

    //Si el producto ya está en el carrito, incrementamos su cantidad
    if(isset($arrayCarrito[$ref])){
        $arrayCarrito[$ref]++; 
    }
    else{
        $arrayCarrito[$ref] = 1;  //Si no, lo añadimos con cantidad 1
    }


    //Actualizamos la cookie 'carrito' con el nuevo array serializado
    setcookie('carrito', serialize($arrayCarrito), time() + 3600); 
}

//Redirigimos a la página de la tienda
header("Location: tienda.php"); 
exit();
 
?>