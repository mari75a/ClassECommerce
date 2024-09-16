<?php

session_start();
require "connection.php";

$email = $_SESSION["t"]["email"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$cost = $_POST["cost"];
$desc = $_POST["desc"];

if($category == "0"){
    echo ("Please select a Category");
}else if($brand == "0"){
    echo ("Please select a Brand");
}else if($model == "0"){
    echo ("Please select a Model");
}else if(empty($title)){
    echo ("Please Enter a Title");
}else if(strlen($title) >= 100){
    echo ("Title should have lover than 100 characters");
}else if(empty($cost)){
    echo ("Please Enter the Price.");
}else if(!is_numeric($cost)){
    echo ("Invalid input for Cost");
}else if(empty($desc)){
    echo ("Please Enter a Description.");
}else{
    
    $mhb_rs = Database::search("SELECT * FROM `teacher_has_course` WHERE `category_id`='".$category."' AND `class_id`='".$brand."' AND `lectures_id`='".$model."' AND `teacher_id`='".$_SESSION["t"]["id"]."'");

    $model_has_brand_id;

    if($mhb_rs->num_rows == 1){

        echo("You have already added a course ");

    }else{

        
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    

    $length = sizeof($_FILES);

    if($length <= 3 && $length > 0){

        $allowed_img_extentions = array ("image/jpg","image/jpeg","image/png","image/svg+xml");

        for($x = 0; $x < $length;$x++){
            if(isset($_FILES["image".$x])){

                $img_file = $_FILES["image".$x];
                $file_extention = $img_file["type"];

                if(in_array($file_extention,$allowed_img_extentions)){

                    $new_img_extention;

                    if($file_extention == "image/jpg"){
                        $new_img_extention = ".jpg";
                    }else if($file_extention == "image/jpeg"){
                        $new_img_extention = ".jpeg";
                    }else if($file_extention == "image/png"){
                        $new_img_extention = ".png";
                    }else if($file_extention == "image/svg+xml"){
                        $new_img_extention = ".svg";
                    }

                    $file_name = "resource//course_images//".$title."_".$x."_".uniqid().$new_img_extention;
                    move_uploaded_file($img_file["tmp_name"],$file_name);
                    Database::iud("INSERT INTO `course`(`price`,`image`,`title`,`status_id`) VALUES('".$cost."','".$file_name."','".$title."','1')");

                    echo ("Product saved successfully");
                
                    $course_id = Database::$connection->insert_id;

                }else{
                    echo ("Invalid Image type");
                }
                Database::iud("INSERT INTO `teacher_has_course`(`teacher_id`,`course_course_id`,`category_id`,`class_id`,`lectures_id`) VALUES ('".$_SESSION["t"]["id"]."','".$course_id."','".$category."','".$brand."','".$model."')");
        

   


            }
        }

        echo ("Product image saved successfully");

    }else{
        echo ("Invalid image count");
    }
    
}  
    
}

?>