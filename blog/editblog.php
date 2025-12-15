<?php
require_once "../manager.php";

//เช็คว่าล้อคอินหรือยัง
if(!isset($_SESSION["email"]))
{
    header("Location: ../index.php");
    exit();
}
// เช็คสิทถ้าไม่adminเตะถิ่ม
if($authority == "User")
{
    header("Location: ../index.php");
    exit();
}

if($_POST)
{
    $blogid = $_POST["glogid"];
    
    $edittitle = $_POST["edittitle"];
    $edittext = $_POST["edittext"];
    $titlenumber = mb_strlen($edittitle, 'UTF-8');
    //เก็บ url ปัจจุบัน
    $url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    if($titlenumber > 80)
    {
        $errormsg = "ข้อความยาวเกินไป";
    }
    else
    {
        $query = $db->prepare("UPDATE blog SET blogtitle=?, blogtext=? WHERE blogid=?");
        $update = $query->execute(array($edittitle, $edittext, $info["blogid"]));
        if($update)
        {
            $errormsg = "แก้ไขข้อความเรียบร้อยแล้ว";
            header("Refresh: 1; url=$url");
        }
        else
        {
            $errormsg = "ไม่สามารถเพิ่มข้อความได้";
        }
    }
}
?>

