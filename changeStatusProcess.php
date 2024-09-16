<?php
require "connection.php";
$cid=$_GET["id"];

$course_rs=Database::search("SELECT * FROM `course` WHERE `course_id`='".$cid."'");
$course_data=$course_rs->fetch_assoc();


if($course_data["status_id"]==1){
    Database::search("UPDATE `course` SET `status_id`=2 WHERE `course_id`='".$cid."' ");
    echo("success");
}else{
    Database::search("UPDATE `course` SET `status_id`=1 WHERE `course_id`='".$cid."' "); 
    echo("success");
}

?>