<?php
  require "connection.php";
  //admin login
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $name = $_POST['name'];
  $location = $_POST['location'];

  $sql = "INSERT INTO user VALUES ('','".$email."', '".$pass."', '".$location."', '".$name."')";
  // use exec() because no results are returned
  $conn->exec($sql);
  //echo "New record created successfully";


  $URL = "user sign in and sign up.php?status=account_created";
  header('Location: '.$URL); 

?>