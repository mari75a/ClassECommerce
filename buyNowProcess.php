<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $cid = $_GET["id"];
    $umail = $_SESSION["u"]["email"];

    $array;
    $order_id = uniqid();

    $course_rs = Database::search("SELECT * FROM `course` WHERE `course_id`='".$cid."'");
    $course_data = $course_rs->fetch_assoc();

    

    

        $item = $course_data["title"];
        $amount = (int)$course_data["price"]/360 ;
        $d=round($amount, 0);

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile_no"];
        

        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $d;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["mail"] = $umail;
        $array["c_id"] = $cid;

        echo json_encode($array);
        
        

}else{
    echo ("1");
   
}

?>