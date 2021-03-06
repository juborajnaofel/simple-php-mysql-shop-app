<?php 
  session_start();
  if (isset($_SESSION["email"]) && isset($_SESSION["id"])){
    if($_SESSION["logtype"]=="admin"){
      $URL = "admindashboard.php";
      header('Location: '.$URL);
    }elseif($_SESSION['logtype'] == "user"){
      $URL = "userdashboard.php";
      echo $URL;
      header('Location: '.$URL);
    }
  }

  require "connection.php";
  //loading all products in homepage
  $stmt = $conn->prepare("SELECT * FROM product");
  $stmt -> execute();
  $products = $stmt->fetchAll();



?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="#">JuborajNaofel's shop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin login.php">Admin Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user sign in and sign up.php">User Signup/Sign in</a>


      </li>
    </ul>
  </div>
</nav>      

<div class="container" align="center">
 
  <?php
  $count = 0;
  foreach ($products as $r) {
    if($count%2==0){
      ?>          
     <!-- row starts for products -->
     <div class="row my-3">     
      <?php
      $count +=1;

    }

  ?>

      <div class="col-sm my-3">

        <div class="card" style="height:15rem; width: 30rem;">
          <div class="card-body">
            <h5 class="card-title"><?php echo $r['name'] ?></h5>
            <p class="card-text">Price: <?php echo $r['unit_price'] ?> bdt</p>
            <p class="card-text">Location: <?php echo $r['location'] ?></p>
            <a href="user sign in and sign up.php" class="btn btn-primary">Sign-up or Sign-in to Buy this</a>
          </div>
        </div>

      </div>



  <?php 
    if($count%2==0){
      ?>              
      </div>
      <!-- row ends for products -->
      <?php

    }
  } 
  ?>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>