<?php

session_start();

if(isset($_SESSION["u"])){

    $_SESSION["s"] = null;
    session_destroy();

    echo ("success");

}else if(isset($_SESSION["t"])){

    $_SESSION["t"] = null;
    session_destroy();

    echo ("success");

}else if(isset($_SESSION["a"])){

    $_SESSION["a"] = null;
    session_destroy();

    echo ("success");

}else if(isset($_SESSION["au"])){

    $_SESSION["a"] = null;
    session_destroy();

    echo ("success");

}

?>