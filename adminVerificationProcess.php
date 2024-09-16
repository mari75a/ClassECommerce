<?php

include "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["e"])){
    $email =$_POST["e"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
    $admin_num = $admin_rs->num_rows;

    if($admin_num> 0){
        $code = uniqid();

        Database::search("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'woofychutte123@gmail.com';
    $mail->Password = 'k d t j s m f v q h v n l h h y';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('woofychutte123@gmail.com', 'Admin Verification');
        $mail->addReplyTo('woofychutte123@gmail.com', 'Admin Verification');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'eShop Admin Login Verification Code';
        $bodyContent = '<h1 style="color:green">Your Verification code is '.$code.'</h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Verification code sending failed';
        } else {
            echo 'Success';
        }


    }else{
        echo("you are not valid user ");
    }


}else{
    echo("Email field should not be empty");
}
?>