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
<html lang="th" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บทความทั้งหมด</title>
    
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
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .blog-card {
            background: rgba(18, 18, 18, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .blog-card:hover {
            background: rgba(25, 25, 25, 0.8);
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .blog-title {
            color: #fff;
            font-weight: 600;
            margin-bottom: 10px;
            text-decoration: none;
            display: block;
        }
        
        .blog-title:hover {
            color: #ccc;
        }

        .meta-text {
            color: #888;
            font-size: 0.9rem;
        }

        .btn-read-more {
            color: #fff;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-read-more:hover {
            background: #fff;
            color: #000;
        }


        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.1), transparent);
            margin: 15px 0;
        }
    </style>
</head>
<body>

    <?php include '../components/navbar.php'; ?>

    <main class="container py-5 flex-grow-1">
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="d-flex justify-content-between align-items-end mb-5 animate__animated animate__fadeInDown">
                    <div>
                        <h2 class="fw-bold text-white mb-0">BLOG</h2>
                        <p class="text-secondary small mb-0">เรื่องราวและความคิดเห็นที่น่าสนใจ</p>
                    </div>
                </div>

                <?php if (isset($blogs) && !empty($blogs)): ?>
                    <?php $delay = 0; ?>
                    <?php foreach ($blogs as $b): ?>
                        
                        <div class="blog-card mb-4 animate__animated animate__fadeInUp" style="animation-delay: <?= $delay ?>s;">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h4">
                                        <a href="detail.php?id=<?= $b['id'] ?>" class="blog-title"><?= htmlspecialchars($b['title']) ?></a>
                                    </h3>
                                    
                                    <div class="meta-text mb-3">
                                        <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($b['username']) ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="divider"></div>

                            <div class="d-flex justify-content-end">
                                <a href="detail.php?id=<?= $b['id'] ?>" class="btn-read-more">
                                    อ่านต่อ <i class="bi bi-arrow-right-short"></i>
                                </a>
                            </div>
                        </div>

                        <?php $delay += 0.1;?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center text-secondary py-5">
                        <i class="bi bi-journal-x display-4 d-block mb-3"></i>
                        <p>ยังไม่มีบทความในขณะนี้</p>
                    </div>
                <?php endif; ?>

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