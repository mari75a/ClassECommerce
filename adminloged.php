<?php
session_start();
if(isset($_SESSION["au"])){
    echo("success");
}else{
    echo("login");
}
?>