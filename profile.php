<?php
session_start(); //เปิดระบบจดจำผู้ใช้งาน
require_once "manager.php"; //เรียกใช้

if(!isset($_SESSION["email"])) //ตรวจสอบเงือนไข ! = คือไม่
{
    header("Location: index.php"); // เอาไว้ป้องกันคนยังไม่เข้าสุ่ระบบ
    exit();
}
?>