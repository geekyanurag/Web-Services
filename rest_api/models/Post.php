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
}