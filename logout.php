<?php
    // 1. เรียกใช้ไฟล์ config และ class
    include_once './config/db.php';
    include_once './class/auth.php';

    // 2. เชื่อมต่อฐานข้อมูล (จำเป็นต้องส่ง db เข้าไปตอน new class ตามโครงสร้าง __construct)
    $database = new Database();
    $db = $database->getDB();

    // 3. เรียก Class auth
    $user = new auth($db);

    // 4. สั่งให้ logout
    $user->logout();
?>