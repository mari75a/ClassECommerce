<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){
if(isset($_GET["id"])){
    
    $email = $_SESSION["u"]["email"];
    $pid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `course_id`='".$pid."' AND `user_email`='".$email."'");
    $cart_num = $cart_rs->num_rows;

    $product_rs = Database::search("SELECT * FROM `course` WHERE `course_id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();
    

    if($cart_num == 1){

        echo("You have already Added ");

    }else{

        Database::iud("INSERT INTO `cart`(`course_id`,`user_email`,`status`) VALUES ('".$pid."','".$email."','0')");
        echo ("Product added successfully");

    }

}else{
    echo ("Something went wrong");
}
}else{
    echo ("Please Sign In or Register.");
}
?>