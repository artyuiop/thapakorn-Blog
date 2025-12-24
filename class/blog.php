<?php 

class blog {
    private $conn;
    private $table_name = "blog";

    public $user_id;
    public $title;
    public $description;

    public function __construct($db) {
        $this->conn = $db;
    }
 

    public function CreateBlog() {
        $query = "INSERT INTO {$this->table_name} (user_id , title , description) VALUES (:user_id , :title , :description)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ":user_id" => $this->user_id,
            ":title" => $this->title,
            ":description" => $this->description
        ]);
    }

    public function getBlogAll() {
        $query = "SELECT b.* , u.username FROM blog b JOIN users u ON b.user_id = u.id ORDER BY b.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getDetailBlog($id) {
        $query = "SELECT b.* , u.username FROM blog b JOIN users u ON b.user_id =  u.id WHERE b.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMyBlogs($user_id) {
        $query = "SELECT * FROM {$this->table_name} WHERE user_id = :uid ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':uid' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function deleteMyBlog($id, $user_id) {
        $sql = "DELETE FROM blog WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id, $user_id]);
    }

    public function getBlogForChange($id, $user_id) {
        $sql = "SELECT * FROM blog WHERE id=? AND user_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id, $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateBlog($id, $user_id, $title, $description) {
        $sql = "UPDATE blog SET title=?, description=? WHERE id=? AND user_id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$title, $description, $id, $user_id]);
    }

}
?>