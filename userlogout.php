<?php
    session_start();
    if (isset($_SESSION["email"]) && isset($_SESSION["id"])){
        session_destroy();
        $URL = "user sign in and sign up.php";
        header('Location: '.$URL);
    }else{
        $URL = "user sign in and sign up.php";
        header('Location: '.$URL);
    }

?>