<?php

session_start();

require "connection.php";

$email = $_SESSION["t"]["email"];
$pid = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `course` INNER JOIN `teacher_has_course` ON   `teacher_has_course`.`course_course_id`=`course`.`course_id` 
INNER JOIN `teacher` ON `teacher`.`id`=`teacher_has_course`.`teacher_id` WHERE `course_id`='".$pid."' ");
$product_num = $product_rs->num_rows;

if($product_num == 1){

    $product_data = $product_rs->fetch_assoc();
    $_SESSION["p"] = $product_data;
    echo ("success");

}else{

    echo "Something went wrong";

}

?>