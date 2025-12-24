<?php 

class Database {
    private $host = "localhost";
    private $db = "blog";
    private $user = "root";
    private $pw = "";   
    private $conn; // เพื่อเอาไปเรียกใช้

    public function getDB() {
        $this->conn = null; // สร้างไว้เพื่อให้รู้ว่ายังไม่เชื่อม
        
        try {
            $this->conn = new PDO("mysql:host=".$this->host . ";dbname=" . $this->db, $this->user, $this->pw);
            // echo "connect successFully!!";
        } catch(Exception $error) {
            echo "connect Error Message:". $error->getMessage();
            exit;
        }

        return $this->conn;
    }
}

?>