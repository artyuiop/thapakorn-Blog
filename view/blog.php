<?php
include_once '../class/blog.php';
include_once '../config/db.php';
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php"); exit;
}

$database = new Database();
$db = $database->getDB();

$blog = new blog($db);
$blogs = $blog->getBlogAll();
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

<?php include '../components/navbar.php'; ?>

<?php foreach ($blogs as $b): ?>
    <div class="border p-3">
        <h3><?= $b['title'] ?></h3>
        <p>โดย: <?= $b['username'] ?></p>

        <a href="detail.php?id=<?= $b['id'] ?>">ดูรายละเอียด</a>
    </div>
<?php endforeach; ?>

<footer class=" py-3 border-top mt-5 ">
    <p class="text-center">By.Thxpakorn Khambo</p>
</footer>

</body>
</html>

