<?php
require_once "../manager.php";

if(!isset($_SESSION["email"]))
{
    header("Location:../index.php");
    exit;
}

if($_POST)
{
    $title = $_POST["title"];
    $text = $_POST["text"];
    $titlenumber = strlen($title);
    if($titlenumber > 80)
    {
        $errormsg = "ชื่อยาวเกินไป";
    }
    else
    {
        if($title!="" && $text!="")
        {
            $query = $db->prepare("INSERT INTO blog SET blogtitle=?, blogtext=?, user=?, time=? ");
            $addblog = $query->execute(array($title, $text, $username, date("Y-m-d H:i:s")));
            if($addblog)
            {
                $errormsg = "เพิ่มข้อความแล้ว";
            }
            else
            {
                $errormsg = "ไม่สามารถเพิ่มข้อความได้";
            }
        }
            else
            {
                $errormsg = "อย่าเว้นที่ว่าง";
            }

    }
}
?>