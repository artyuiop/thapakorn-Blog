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
<html lang="th" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขบทความ</title>
    
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center; /* จัดให้อยู่กลางจอแนวตั้ง */
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Glassmorphism Card Style */
        .card-custom {
            background: rgba(18, 18, 18, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        /* Input Fields Style */
        .form-control {
            background-color: rgba(10, 10, 10, 0.8);
            border: 1px solid #333;
            color: #fff;
            border-radius: 8px;
            padding: 12px;
            transition: all 0.3s;
        }

        .form-control:focus {
            background-color: #000;
            border-color: #fff;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        /* ปุ่มบันทึก (สีขาว) */
        .btn-white {
            background-color: #ffffff;
            color: #000000;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            transition: all 0.3s;
        }

        .btn-white:hover {
            background-color: #dcdcdc;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255,255,255,0.1);
        }

        /* ปุ่มยกเลิก (เส้นขอบ) */
        .btn-outline-custom {
            border: 1px solid #555;
            color: #aaa;
            border-radius: 8px;
            padding: 10px 25px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-outline-custom:hover {
            border-color: #fff;
            color: #fff;
            background-color: transparent;
        }

        .page-header {
            margin-bottom: 30px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                
                <div class="page-header animate__animated animate__fadeInDown">
                    <h2 class="fw-bold text-white">EDIT CONTENT</h2>
                    <p class="text-secondary small">แก้ไขรายละเอียดบทความของคุณ</p>
                </div>

                <div class="card card-custom p-4 p-md-5 animate__animated animate__fadeInUp">
                    
                    <form method="POST">
                        
                        <div class="mb-4">
                            <label class="form-label text-secondary small fw-bold">TITLE</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-secondary border-opacity-25 text-secondary">
                                    <i class="bi bi-type-h1"></i>
                                </span>
                                <input type="text" name="title" class="form-control border-secondary border-opacity-25" 
                                       value="<?= htmlspecialchars($post['title']) ?>" placeholder="ระบุหัวข้อบทความ" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-secondary small fw-bold">DESCRIPTION</label>
                            <textarea name="description" class="form-control border-secondary border-opacity-25" 
                                      rows="6" placeholder="ระบุรายละเอียดเนื้อหา..." required><?= htmlspecialchars($post['description']) ?></textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="manager.php" class="btn-outline-custom">
                                <i class="bi bi-arrow-left"></i> ยกเลิก
                            </a>

                            <button type="submit" name="update" class="btn btn-white">
                                <i class="bi bi-save me-2"></i>บันทึกการแก้ไข
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsde   livr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>