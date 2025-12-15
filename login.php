<?php
session_start();
require_once "manager.php";
if($_POST)
{
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    if($email!="" && $password!="") 
    {
        $query = $db->prepare("SELECT * FROM users WHERE email=? and password=?");
        $query->execute(array($email, $password));
        $login = $query->rowCount();
        
        if($login > 0)
        {
            $errormsg = "เข้าสู่ระบบสำเร็จ";
            $_SESSION["email"] = $email;
            header("Refresh: 2; url=index.php");
        }
        else
        {
            $errormsg = "เข้าสู่ระบบไม่สำเร็จ (รหัสผิด)";
        }
    }
    else
    {
        $errormsg = "Login failed กรอกข้อมูลไม่ครบ";
    }
} 
?>

<?php
if(isset($_SESSION["email"]))
{
    include "navbar.php";
    echo "เข้าสู่ระแบบแล้ว";
}
