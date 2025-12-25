<?php
    session_start(); 
    include_once './config/db.php';
    include_once './class/auth.php';

    $database = new Database();
    $db = $database->getDB();
    $user = new auth($db);

    $errorMsg = "";

    if (isset($_POST['signin'])) {
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];

        if ($user->login()) {
            header("Location: ./view/blog.php");
            exit();
        } else {
            $errorMsg = "ไม่พบชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง";
        }
    }
?>

<!DOCTYPE html>
<html lang="th" data-bs-theme="dark"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            color: #e0e0e0;
            background: linear-gradient(-45deg, #000000, #1a1a1a, #0f0f0f, #2b2b2b);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            height: 100vh;
            overflow: hidden;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card-custom {
            background: rgba(18, 18, 18, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        .form-control {
            background-color: rgba(10, 10, 10, 0.8);
            border: 1px solid #333;
            color: #fff;
            border-radius: 8px;
            padding: 10px;
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            background-color: #000;
            border-color: #fff;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
            color: #fff;
            transform: scale(1.02);
        }
        
        .input-group-text {
            background-color: rgba(10, 10, 10, 0.8);
            border: 1px solid #333;
            border-right: none;
            color: #888;
        }

        .btn-white {
            background-color: #ffffff;
            color: #000000;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 12px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.15);
            background-color: #f0f0f0;
            color: #000;
        }

        a {
            color: #aaa;
            transition: color 0.3s;
            position: relative;
        }
        
        a:hover {
            color: #fff;
            text-shadow: 0 0 5px rgba(255,255,255,0.5);
        }

        .brand-title {
            letter-spacing: 2px;
            font-weight: bold;
            color: #fff;
            text-shadow: 0 0 10px rgba(255,255,255,0.3);
        }
    </style>
</head>
<body>

    <div class="login-container">
        
        <div class="mb-4 text-center animate__animated animate__fadeInDown">
            <h3 class="brand-title">LOGIN</h3>
        </div>

        <div class="card card-custom p-4 animate__animated animate__fadeInUp">
            <div class="card-body">
                
                <h4 class="mb-1 fw-bold text-white">ยินดีต้อนรับ</h4>
                <p class="text-secondary small mb-4">กรอกข้อมูลเพื่อเข้าสู่ระบบ</p>

                <?php if ($errorMsg): ?>
                    <div class="alert alert-dark border-danger d-flex align-items-center mb-3 py-2 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-circle-fill text-danger me-2"></i>
                        <small class="text-danger"><?php echo $errorMsg; ?></small>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label text-secondary small">USERNAME</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Enter username" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label text-secondary small">PASSWORD</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                        </div>
                        <div class="text-end mt-2">
                             <a href="signup.php" class="small text-decoration-none">สมัครสมาชิกใหม่?</a>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-white" name="signin">
                            เข้าสู่ระบบ <i class="bi bi-arrow-right-short"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <footer class="mt-5 text-center text-secondary small animate__animated animate__fadeIn" style="opacity: 0.5; animation-delay: 0.5s;">
            <p>By. Thxpakorn Khambo</p>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>