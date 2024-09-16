<?php
include "connection.php";
session_start();

if(isset($_GET["v"])){
    $vcode=$_GET["v"];

    $v_rs=Database::search("SELECT * FROM `admin` WHERE `verification_code`='".$vcode."' ");
    $v_num = $v_rs->num_rows;

    if($v_num==1){
        $v_data =$v_rs->fetch_assoc();
        $_SESSION["au"]=$v_data;
        echo("Success");
    }else{
        echo("Invalid verification code");
    }

}else{
    echo("Please Enter your verifiction code");
}
?>