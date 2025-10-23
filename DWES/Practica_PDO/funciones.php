<?php
require_once 'conexion.php'; // Incluye el archivo de conexión a la base de datos
require_once 'cliente.php';  // Incluye el archivo con la clase Cliente

// Función para obtener todos los clientes
function obtenerClientes()
{
    try {
        $conexion = conectarBD();
        $consulta = "SELECT * FROM clientes";
        $stmt = $conexion->query($consulta);
        $stmt -> execute();
        $clientes = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cliente = new Cliente(
                $row['dni'],
                $row['nombre'],
                $row['direccion'],
                $row['localidad'],
                $row['provincia'],
                $row['telefono'],
                $row['email']
            );
            $clientes[] = $cliente;
        }
        return $clientes;
    } catch (PDOException $e) {
        echo "Error al obtener clientes: " . $e->getMessage();
        return [];
    }
}

// Función para insertar un nuevo cliente
function insertarCliente($dni, $nombre, $direccion, $localidad, $provincia, $telefono, $email)
{
    try {
        $pdo = conectarBD();
        $sql = "INSERT INTO clientes (dni, nombre, direccion, localidad, provincia, telefono, email) 
                VALUES (:dni, :nombre, :direccion, :localidad, :provincia, :telefono, :email)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':localidad', $localidad);
        $stmt->bindParam(':provincia', $provincia);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        
        if ($stmt->execute()) {
            return true;
        } else {
            echo "No se pudo insertar el cliente";
            return false;
        }
    } catch (PDOException $e) {
        echo "Error al insertar cliente: " . $e->getMessage();
        return false;

    }

}

// Función para obtener un cliente por su DNI
function obtenerClientePorDni($dni)
{
    try {
        $conexion = conectarBD();
        $consulta = "SELECT * FROM clientes WHERE dni = '$dni'";
        $stmt = $conexion->query($consulta);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new Cliente(
                $fila['dni'],
                $fila['nombre'],
                $fila['direccion'],
                $fila['localidad'],
                $fila['provincia'],
                $fila['telefono'],
                $fila['email']
            );
        }
        return null;
    } catch (Exception $e) {
        die("Error al obtener cliente: " . $e->getMessage());
    }

}


// Función para actualizar un cliente existente
function actualizarCliente($dni, $nombre, $direccion, $localidad, $provincia, $telefono, $email)
{
    try {
        $conexion = conectarBD();
        $consulta = "UPDATE clientes SET 
        nombre = '$nombre', 
        direccion = '$direccion', 
        localidad = '$localidad', 
        provincia = '$provincia', 
        telefono = '$telefono', 
        email = '$email' 
        WHERE dni = '$dni'";

        if ($conexion->exec($consulta)) {
            return true;
        } else {
            return false;
        }
    }
    catch (Exception $e) {
        die("Error al obtener cliente: " . $e->getMessage());
    }
}


// Función para borrar un cliente por su DNI
function borrarCliente($dni)
{
    try {
        $conexion = conectarBD();
        $consulta = "DELETE FROM clientes WHERE dni = '$dni'";

        if ($conexion->exec($consulta)) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error al borrar cliente: " . $e->getMessage();
        return false;
    }
}
    
?>