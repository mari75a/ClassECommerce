<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $total=$_GET["id"];
    $umail = $_SESSION["u"]["email"];

    $array=array();
    $order_id = uniqid();

    $course_rs = Database::search("SELECT * FROM `course` INNER JOIN `cart` ON `cart`.`course_id`=`course`.`course_id`  WHERE `user_email`='".$umail."' AND `pay_status`='0'");
    $course_num=$course_rs->num_rows;
    

    
for($x=0;$x<$course_num;$x++){
    $course_data = $course_rs->fetch_assoc();

    $phpObject=new stdClass();
    $item = $course_data["title"];
    $amount = (int)$total/360 ;
    $d=round($amount, 0);
$price=$course_data["price"];
    $fname = $_SESSION["u"]["fname"];
    $lname = $_SESSION["u"]["lname"];
    $mobile = $_SESSION["u"]["mobile_no"];
    $cid=$course_data["course_id"];

    $array["id"] = $order_id;
    $array["item"] = $item;
    $array["amount"] = $d;
    $array["price"]=$price;
    $array["fname"] = $fname;
    $array["lname"] = $lname;
    $array["mobile"]= $mobile;
    $array["mail"]= $umail;
    $array["c_id"] = $cid;

   
}
    

        

        echo json_encode($array);
        
        

}else{
    echo ("1");
   
}

?>