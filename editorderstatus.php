<?php
  require "connection.php";
  //admin login
  $s= $_POST['status'];
  $id= $_POST['id'];

  $sql = "UPDATE product_order SET status='".$s."' WHERE id='".$id."'  ";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully";

   $URL = "ordermenu admin.php";
   header('Location: '.$URL); 



?>