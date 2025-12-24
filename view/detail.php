<?php 
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php"); exit;
}
include_once '../class/blog.php';
include_once '../config/db.php';

$database = new Database();
$db = $database->getDB();

$blog = new blog($db);
$data = $blog->getDetailBlog($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?= $data['title'] ?></h1>
    <h2><?= $data['description'] ?></h2>
    <p>by.<?= $data['username'] ?></p>
</body>
</html>