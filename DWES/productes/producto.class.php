<?php
//Clase Producto
class Producto
{
    private $id;
    private $name;
    private $price;
    private $description;
    private $family_id;

    //Constructor de la clase
    public function __construct($id, $name, $price, $description, $family_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->family_id = $family_id;
    }


    //Getters
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getFamilyId()
    {
        return $this->family_id;
    }

    //Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setFamilyId($family_id)
    {
        $this->family_id = $family_id;
    }


    //Métodos
    public function guardarProducto($conexion)
    {
        $sql = "INSERT INTO Product (name, price, description, family_id)
                VALUES (:name, :price, :description, :family_id)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':name' => $this->name,
            ':price' => $this->price,
            ':description' => $this->description,
            ':family_id' => $this->family_id
        ]);

    }

    public function actualizarProducto($conexion)
    {
        $sql = "UPDATE Product
                SET name = :name, price = :price, description = :description, family_id = :family_id
                WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':name' => $this->name,
            ':price' => $this->price,
            ':description' => $this->description,
            ':family_id' => $this->family_id,
            ':id' => $this->id
        ]);
    }

    public static function eliminarProducto($conexion, $id)
    {
        $sql = "DELETE FROM Product WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    //Función estática --ver apunte

    public static function buscarporId($conexion, $id)
    {
        $sql = "SELECT * FROM Product WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Producto(
                $row['id'],
                $row['name'],
                $row['price'],
                $row['description'],
                $row['family_id']
            );
        }
        return null;
    }
}



?>