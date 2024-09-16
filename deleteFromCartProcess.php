<?php

require "connection.php";
session_start();
if(isset($_GET["id"])){

    $cid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `id`='".$cid."' AND `user_email`='".$_SESSION["u"]["email"]."' ");
    $cart_data = $cart_rs->fetch_assoc();

    $user = $cart_data["user_email"];
   

    
    Database::iud("DELETE FROM `cart` WHERE `id`='".$cid."' AND `user_email`='".$_SESSION["u"]["email"]."'");

    echo ("success");

}else{
    echo ("Something went wrong");
}

?>