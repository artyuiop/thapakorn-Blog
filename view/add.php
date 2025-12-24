
<?php
    session_start(); 
    include_once '../config/db.php';
    include_once '../class/blog.php';

    $database = new Database();
    $db = $database->getDB();

    $blog = new blog($db);


    if (isset($_POST['AddBlog'])) {
        $blog->user_id = $_SESSION['userid'];
        $blog->title = trim($_POST['title']);
        $blog->description = trim($_POST['description']);

        if ($blog->CreateBlog()) {
            echo "เพิ่มละ";
        }
    }
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

<main class="flex-grow-1">
    <div class="container mt-5">

        <div class="text-center mb-4">
            <h2>สร้าง blog</h2>
        </div>

        <div class="card col-md-6 mx-auto shadow-sm">
            <div class="card-body">
                <form action="../action/add" method="POST">
                    <div class="mb-3">
                        <label class="form-label">หัวข้อ</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">รายละเอียด</label>
                        <textarea class="form-control" name="description" rows="4" required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="AddBlog" class="btn btn-primary px-4">
                            บันทึกบทความ
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>
<footer class=" py-3 border-top mt-5 ">
    <p class="text-center">By.Thxpakorn Khambo</p>
</footer>

</body>
</html>