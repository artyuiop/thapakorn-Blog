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
<html lang="th" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['title']) ?>Blog</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">

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
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* กล่องเนื้อหา */
        .article-container {
            background: rgba(18, 18, 18, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }

        /* หัวข้อบทความ */
        .article-title {
            font-weight: 600;
            color: #fff;
            line-height: 1.4;
            margin-bottom: 20px;
        }

        /* ข้อมูลผู้เขียน/วันที่ */
        .article-meta {
            color: #888;
            font-size: 0.95rem;
            border-left: 3px solid #fff;
            padding-left: 15px;
            margin-bottom: 30px;
        }

        /* เนื้อหาบทความ */
        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #d0d0d0;
            white-space: pre-line; /* รักษาย่อหน้าและการเว้นบรรทัดจาก Database */
        }

        .divider {
            height: 1px;
            background: rgba(255,255,255,0.1);
            margin: 30px 0;
        }

        /* ปุ่มย้อนกลับ */
        .btn-back {
            color: #aaa;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
        }
        .btn-back:hover {
            color: #fff;
            transform: translateX(-5px);
        }
        
        /* Breadcrumb สไตล์ Dark */
        .breadcrumb-item a {
            color: #aaa;
            text-decoration: none;
        }
        .breadcrumb-item.active {
            color: #fff;
        }
    </style>
</head>
<body>

    <?php include '../components/navbar.php'; ?>

    <main class="container py-5 flex-grow-1">
        
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                
                <nav aria-label="breadcrumb" class="mb-4 animate__animated animate__fadeInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="blog.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Articles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>

                <div class="article-container animate__animated animate__fadeInUp">
                    
                    <h1 class="display-5 article-title"><?= htmlspecialchars($data['title']) ?></h1>

                    <div class="article-meta d-flex align-items-center flex-wrap gap-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-circle fs-4 me-2"></i>
                            <div>
                                <span class="d-block text-white small fw-bold">Author</span>
                                <span><?= htmlspecialchars($data['username']) ?></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center ms-md-4">
                            <i class="bi bi-calendar3 fs-5 me-2"></i>
                            <div>
                                <span class="d-block text-white small fw-bold">Published</span>
                                <span><?php echo date("d M Y"); // หรือใช้วันที่จริงจาก DB ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="article-content">
                        <?= nl2br(htmlspecialchars($data['description'])) ?>
                    </div>

                    <div class="divider"></div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="blog.php" class="btn-back">
                            <i class="bi bi-arrow-left me-2"></i> กลับหน้าหลัก
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </main>

    <footer class="mt-auto py-4 border-top border-secondary border-opacity-10">
        <p class="text-center text-secondary small m-0">
            © <?php echo date("Y"); ?> By. Thxpakorn Khambo
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>