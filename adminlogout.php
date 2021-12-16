<?php
    session_start();
    if (isset($_SESSION["email"]) && isset($_SESSION["id"])){
        session_destroy();
        $URL = "admin login.php";
        header('Location: '.$URL);
    }else{
        $URL = "admin login.php";
        header('Location: '.$URL);
    }

?>