<?php

class auth {
    private $conn;
    private $table_name = "users";

    public $fname;
    public $lname;
    public $username;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // สมัครสมาชิก
    public function register() {
        $query = "INSERT INTO {$this->table_name}(fname, lname, username, password)VALUES (:fname, :lname, :username, :password)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':fname' => trim($this->fname),
            ':lname' => trim($this->lname),
            ':username' => trim($this->username),
            ':password' => trim($this->password)
        ]);
    }

    // เช็คชื่อผู้ใช้ซํ้า
    public function checkUsername() {
        $query = "SELECT id FROM {$this->table_name} WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }   
    }

    // ล็อกอิน
    public function login() {
        $query = "SELECT id, password FROM {$this->table_name} WHERE username = :username LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($this->password === $row['password']) {
                $_SESSION['userid'] = $row['id'];
                return true; // ล็อกอินสำเร็จ            
            }

        }
        return false; // ไม่พบชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง
    }

    public function logout() {
        session_start();
        unset($_SESSION['userid']);
        header("location: ../index.php");
        exit;
    }

}
