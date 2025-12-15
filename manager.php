<?php
// error_reporting(0); เอาไว้ปิดeror
ob_start();
if(!isset($_SESSION)){
    session_start();
}
try 
{
    $db = new PDO("mysql:host=localhost;dbname=blog;charset=utf8;", "root", ""); //ต่อฐานข้อมูล
}
catch(PDOException $dberror)
{
    echo "ลองใหม่อีกครั้งเชื่อมฐานไม่ได้ " . $dberror->getMessage(); // ถ้าไม่ได้จะขึ้นอันนี้
    exit();
}

// เช็คผู้ใช้งาน
if(isset($_SESSION["email"]))
{
    $query = $db->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute(array($_SESSION["email"]));
    $usernumber = $query->rowCount();
    $usersinfo = $query->fetch(PDO::FETCH_ASSOC);
    if($usernumber > 0)
    {
        $username = $usersinfo["username"];
        $email= $usersinfo["email"];
        $password= $usersinfo["password"];
        $authority= $usersinfo["authority"];
    }
}

$query = $db->prepare("SELECT * FROM blog order by blogid desc");
$query->execute();
$blognumber = $query->rowCount();
$bloginfo = $query->fetchAll(PDO::FETCH_ASSOC);

$info = null;

if($_GET)
{
    $blogid = intval($_GET["blogid"]);
    $query = $db->prepare("SELECT * FROM blog WHERE blogid=?");
    $query-> execute(array($_GET["blogid"]));
    $info = $query->fetch(PDO::FETCH_ASSOC);
}
?>


