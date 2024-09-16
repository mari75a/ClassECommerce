<?php

session_start();
require "connection.php";

if (isset($_SESSION["p"])) {

    $pid = $_SESSION["p"]["course_id"];

    $title = $_POST["t"];


    
    Database::iud("UPDATE `course` SET `title`='" . $title . "' WHERE `course_id`='" . $pid . "'");

    echo ("Product has been Updated!");


    






    if (isset($_FILES["i"])) {

        $img_file = $_FILES["i"];
        $file_type = $img_file["type"];

        

           

            $file_name = "resource/course_images/" . $title . uniqid() .".png";
            move_uploaded_file($img_file["tmp_name"], $file_name);

            Database::iud("UPDATE `course` SET `title`='" . $title . "',`image`='" . $file_name . "' WHERE `course_id`='" . $pid . "'");

            echo ("Product has been Updated!");
        
    }
}else{
    echo("something went wrong");
}
