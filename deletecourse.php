<?php
require "connection.php";
$cid= $_POST["cid"];

Database::iud("DELETE FROM `users_has_course` WHERE `course_course_id`='".$cid."'");




?>