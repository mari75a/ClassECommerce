<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $email = $_POST["e"];
    $mobile = $_POST["m"];
    $line1 = $_POST["l1"];
    

    if (isset($_FILES["image"])) {
        $image = $_FILES["image"];

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
        $file_ex = $image["type"];

        if (!in_array($file_ex, $allowed_image_extentions)) {
            echo ("Please select a valid image.");
        } else {

            $new_file_extention;

            if ($file_ex == "image/jpg") {
                $new_file_extention = ".jpg";
            } else if ($file_ex == "image/jpeg") {
                $new_file_extention = ".jpeg";
            } else if ($file_ex == "image/png") {
                $new_file_extention = ".png";
            } else if ($file_ex == "image/svg+xml") {
                $new_file_extention = ".svg";
            }

            $file_name = "resource/profile_img/" . $_SESSION["u"]["fname"] . "_" . uniqid() . $new_file_extention;

            move_uploaded_file($image["tmp_name"], $file_name);

            $image_rs = Database::search("SELECT * FROM `users` WHERE 
            `email`='" . $_SESSION["u"]["email"] . "'");
            $image_num = $image_rs->num_rows;

            if ($image_num == 1) {

                Database::iud("UPDATE `users` SET `image`='" . $file_name . "' WHERE 
                `email`='" . $_SESSION["u"]["email"] . "'");
            } 
        }
    }

    Database::iud("UPDATE `users` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`email`='" . $email . "',`mobile_no`='" . $mobile . "',`address`='" . $line1 . "' 
    WHERE `email`='" . $_SESSION["u"]["email"] . "'");

    echo ("success");
} else {
    echo (" login first");
}
