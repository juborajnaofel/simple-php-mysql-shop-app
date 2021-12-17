<?php
  require "connection.php";
  //admin login
  $name = $_POST['name'];
  $unitprice = $_POST['unitprice'];
  $location = $_POST['location'];

  $sql = "INSERT INTO product VALUES ('','".$name."', '".$unitprice."', '".$location."')";
  // use exec() because no results are returned
  $conn->exec($sql);
  //echo "New record created successfully";

  $URL = "admindashboard.php";
  header('Location: '.$URL);
?>