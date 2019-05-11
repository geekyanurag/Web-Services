<?php
class Post{
    private $conn;
    private $table = 'student';
    
    public $id;
    public $name;
    public $branch;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT * FROM student';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT * FROM student WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->branch = $row['branch'];
    }

    public function create(){
        $query = 'INSERT INTO student SET
        name = :name,
        branch = :branch';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->branch = htmlspecialchars(strip_tags($this->branch));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':branch', $this->branch);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;
    }

    public function update(){
        $query = 'UPDATE student SET
        name = :name,
        branch = :branch
        WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->branch = htmlspecialchars(strip_tags($this->branch));
        $this->id = htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':branch', $this->branch);
        $stmt->bindParam(':id', $this->id);


        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;
    }

    public function delete(){
        $query = 'DELETE FROM student where id = :id';

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