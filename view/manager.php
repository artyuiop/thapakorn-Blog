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
<html lang="th" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการบทความ</title>
    
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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        /* Input Fields Style */
        .form-control {
            background-color: rgba(10, 10, 10, 0.8);
            border: 1px solid #333;
            color: #fff;
            border-radius: 8px;
            padding: 10px;
        }

        .form-control:focus {
            background-color: #000;
            border-color: #fff;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        /* ปุ่มสีขาว */
        .btn-white {
            background-color: #ffffff;
            color: #000000;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .btn-white:hover {
            background-color: #dcdcdc;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255,255,255,0.1);
        }

        /* Table Styling */
        .table {
            color: #e0e0e0;
            margin-bottom: 0;
        }
        .table th, .table td {
            background-color: transparent;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            vertical-align: middle;
        }
        .table tr:last-child td {
            border-bottom: none;
        }
        
        .action-btn {
            text-decoration: none;
            margin-left: 5px;
            transition: transform 0.2s;
            display: inline-block;
        }
        .action-btn:hover {
            transform: scale(1.1);
        }

        /* ปุ่มย้อนกลับ (Custom Style) */
        .btn-back-custom {
            color: #aaa;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(0,0,0,0.2);
            border-radius: 30px; /* ทรงแคปซูล */
            padding: 8px 20px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .btn-back-custom:hover {
            color: #fff;
            border-color: #fff;
            background: rgba(255,255,255,0.1);
            transform: translateX(-5px); /* ขยับซ้ายนิดนึงตอนชี้ */
        }
    </style>
</head>
<body>

    <div class="container py-5">
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="mb-3 animate__animated animate__fadeInDown">
                    <a href="blog.php" class="btn-back-custom">
                        <i class="bi bi-arrow-left me-2"></i> กลับหน้าหลัก
                    </a>
                </div>

                <div class="mb-4 text-center animate__animated animate__fadeInDown">
                    <h2 class="fw-bold text-white">DASHBOARD</h2>
                    <p class="text-secondary small">จัดการเนื้อหาเว็บไซต์ของคุณ</p>
                </div>

                <div class="card card-custom p-4 mb-5 animate__animated animate__fadeInUp">
                    <h4 class="mb-3 text-white"><i class="bi bi-pencil-square me-2"></i>สร้างบทความใหม่</h4>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label text-secondary small">TITLE</label>
                            <input type="text" name="title" class="form-control" placeholder="ระบุหัวข้อบทความ" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label text-secondary small">DESCRIPTION</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="ระบุรายละเอียดเนื้อหา..." required></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" name="AddBlog" class="btn btn-white">
                                <i class="bi bi-save me-1"></i> บันทึกข้อมูล
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card card-custom p-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0 text-white"><i class="bi bi-list-ul me-2"></i>รายการบทความของฉัน</h4>
                        <span class="badge bg-secondary bg-opacity-25 border border-secondary border-opacity-25 text-white">
                            Total: <?= count($blogs) ?>
                        </span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-secondary small">
                                    <th style="width: 70%;">TITLE</th>
                                    <th style="width: 30%;" class="text-end">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($blogs)): ?>
                                    <?php foreach ($blogs as $b): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-medium text-white"><?= htmlspecialchars($b['title']) ?></div>
                                            </td>
                                        <td class="text-end">
                                            <a href="edit.php?id=<?= $b['id'] ?>" class="btn btn-sm btn-outline-warning action-btn" title="แก้ไข">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            
                                            <a href="manager.php?id=<?= $b['id'] ?>" 
                                               onclick="return confirm('ยืนยันที่จะลบบทความนี้ใช่หรือไม่? การกระทำนี้ไม่สามารถย้อนกลับได้')" 
                                               class="btn btn-sm btn-outline-danger action-btn" title="ลบ">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2" class="text-center py-4 text-secondary">
                                            ยังไม่มีข้อมูลบทความ
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>