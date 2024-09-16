<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

$o_id = $_POST["o"];
$p_id = $_POST["i"];
$mail = $_POST["m"];
$amount = $_POST["a"];
$damount=$amount*360;

$product_rs = Database::search("SELECT * FROM `course` WHERE `course_id`='".$p_id."'");
$product_data = $product_rs->fetch_assoc();



Database::iud("INSERT INTO `users_has_course` (`course_course_id`,`users_email`) VALUES('".$p_id."','".$mail."')");


$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`status`,`course_course_id`,`users_email`,`qty`) VALUES 
('".$o_id."','".$date."','".$damount."','0','".$p_id."','".$mail."','1')");

echo ("1");

}

?>