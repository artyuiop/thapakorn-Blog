<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    exit;
}

require '../config/db.php';
require '../class/blog.php';

$db = (new Database())->getDB();
$blog = new Blog($db);


if (isset($_GET['id'])) {
    $blog->deleteMyBlog($_GET['id'], $_SESSION['userid']);
    header("Location: manager.php");
    exit;
}


if (isset($_POST['AddBlog'])) {
    $blog->user_id = $_SESSION['userid'];
    $blog->title = trim($_POST['title']);
    $blog->description = trim($_POST['description']);
    $blog->CreateBlog();

    header("Location: manager.php");
    exit;
}



$blogs = $blog->getMyBlogs($_SESSION['userid']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <h2>สร้าง blog</h2>
    <form method="POST">
        <input name="title" placeholder="หัวข้อ" required><br>
        <textarea name="description" placeholder="รายละเอียด" required></textarea><br>
        <button name="AddBlog">บันทึก</button>
    </form>

    <hr>

    <h2>blog ของฉัน</h2>
    <table border="1">
        <?php foreach ($blogs as $b): ?>
        <tr>
            <td><?= $b['title'] ?></td>
            <td>
                <a href="edit.php?id=<?= $b['id'] ?>">แก้ไข</a>
                <a href="manager.php?id=<?= $b['id'] ?>" onclick="return confirm('ลบหรอ?')">
                    ลบ
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>