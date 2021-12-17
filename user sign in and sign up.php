<?php
  // if(isset($_COOKIE["email"])){
  //   $URL = "admindashboard.php";
  //   header('Location: '.$URL);
  // }
  if(isset($_GET['status'])){
    if($_GET['status']=='invalid'){
      echo "<script> alert('Wrong password or email!');  </script>";
    }elseif($_GET['status']=='account_created'){
      echo "<script> alert('Account created! You can now login using your credentials');  </script>";
    }
  }
  session_start();
  if (isset($_SESSION["email"]) && isset($_SESSION["id"])){

      $URL = "userdashboard.php";
      header('Location: '.$URL);
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
  
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php"> ❮ Go back to homepage <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </nav>
  <br>
  <div class="container">
    <h1>User Log in </h1>
    <form method="post" action="userdashboard.php">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
          placeholder="Enter email" name="email">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
      </div>
      <!-- <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div> -->
      <button type="submit" class="btn btn-primary">Log in</button>
    </form>
    <br>
    <br>
    <hr>
    <br>
    <br>
    <h1> Create an account </h1>
    <form method="post" action="userReg.php">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter your fullname" name="name">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
          placeholder="Enter email" name="email">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
      </div>
      <label for="locOption">Location</label>
      <select class="form-control" id="locOption" name="location">
        <option>Dhaka</option>
        <option>Rajshahi</option>
        <option>Chittagong</option>
      </select>
      <!-- <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div> -->
      <br>
      <button type="submit" class="btn btn-primary">Create an account</button>
    </form>
    <br>
    <br>


  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>

</html>