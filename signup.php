
<?php 
    session_start(); 
    include_once './config/db.php';
    include_once './class/auth.php';


    $database = new Database();
    $db = $database->getDB();

    $user = new auth($db);

    if(isset($_POST['signup'])) {
        $user->fname = $_POST['fname'];
        $user->lname = $_POST['lname'];
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];

        if($user->checkUsername()) {
            die("ซํ้าไอ้สัส");
        }

        if($user->register()) {
            echo "<script>alert('ได้ละควย');</script>";
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
<main class="flex-grow-1">
    <div class="mt-5">
        <div class="text-center pt-5">
            <h1>Registr Form</h1>
        </div>

        <div class="col-md-4 offset-md-4 mt-5">
            <form method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">fname</label>
                    <input type="text" class="form-control" name="fname">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">lname</label>
                    <input type="text" class="form-control" name="lname">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">username</label>
                    <input type="text" class="form-control" name="username">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                    <p>มีบัญชีผู้ใช้อยู่แล้ว?<a href="index.php">ล็อกอิน</a></p>
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary w-50 center" name="signup">Submit</button>
                </div>
            </form>

        </div>

    </div>
</main>

<footer class=" py-3 border-top mt-5 ">
    <p class="text-center">By.Thxpakorn Khambo</p>
</footer>

</body>
</html>