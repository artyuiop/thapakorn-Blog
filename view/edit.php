<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php"); exit;
}

require '../config/db.php';
require '../class/blog.php';

$db = (new Database())->getDB();
$blog = new Blog($db);

$id = $_GET['id'] ?? null;
$post = $blog->getBlogForChange($id, $_SESSION['userid']);

if (!$post) die('ไม่มีสิทธิ์แก้ไข');

if (isset($_POST['update'])) {
    $blog->updateBlog(
        $id,
        $_SESSION['userid'],
        trim($_POST['title']),
        trim($_POST['description'])
    );
    header("Location: manager.php"); exit;
}
?>
<!DOCTYPE html>
<html>
<body>

<h2>แก้ไขบทความ</h2>

<form method="POST">
    <input name="title" value="<?= $post['title'] ?>" required><br>
    <textarea name="description" required><?= $post['description'] ?></textarea><br>
    <button name="update">บันทึก</button>
</form>

</body>
</html>
