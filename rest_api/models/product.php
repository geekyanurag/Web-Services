<?php
class Product{
    private $conn;
    private $table = 'product';
    
    public $id;
    public $name;
    public $price;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT * FROM product';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT * FROM product WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->price = $row['price'];
    }

    public function create(){
        $query = 'INSERT INTO product SET
        name = :name,
        price = :price';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;
    }

    public function update(){
        $query = 'UPDATE product SET
        name = :name,
        price = :price
        WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->id = htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':id', $this->id);


        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;
    }

    public function delete(){
        $query = 'DELETE FROM product where id = :id';

        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;

    }
}