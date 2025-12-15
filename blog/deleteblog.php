<?php 
require_once "../manager.php";

// เช็คสิท
if($authority == "User")
{
    header("Location: ../index.php");
    exit;
}
//เช็คว่าล้อคอินหรือยัง
if(!isset($_SESSION["email"]))
{
    header("Location: ../index.php");
    exit;
}

if($_GET)
{
    $blogid = intval($_GET["blogid"]);
    $query = $db->prepare("DELETE FROM blog WHERE blogid=?");
    $query->execute(array($_GET["blogid"]));
    header("Location: ../index.php");
    exit;
}
?>