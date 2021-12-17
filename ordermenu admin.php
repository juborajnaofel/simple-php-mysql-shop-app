<?php

  session_start();

  if (isset($_SESSION["email"]) && isset($_SESSION["id"])){
    //echo $_SESSION["email"]." ".$_SESSION["id"];
    if( isset($_SESSION['logtype']) && $_SESSION['logtype'] == "user"){
      $URL = "userdashboard.php";
      header('Location: '.$URL); 
    }elseif(isset($_SESSION['logtype']) && $_SESSION['logtype'] == "admin"){

    //loading all orders in ordermenu
    require "connection.php";
    $stmt = $conn->prepare("SELECT * FROM product_order");
    $stmt -> execute();
    $products = $stmt->fetchAll();

    }
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
    <a class="navbar-brand" href="#">JuborajNaofel's shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="admindashboard.php">Admin dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order count.php">Check each product has how many orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adminlogout.php">Log out</a>
        </li>
      </ul>
    </div>
  </nav>
  <br>

  <div class="container" align="center">
 
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Order ID</th>
          <th scope="col">User ID</th>
          <th scope="col">Product ID</th>
          <th scope="col">Final Price</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($products as $r) { ?>
        <tr>
          <td><?php echo $r['id']; ?></td>
          <td><?php echo $r['uid']; ?></td>
          <td><?php echo $r['pid']; ?></td>
          <td><?php echo $r['final_price']; ?></td>
          <td><?php echo $r['status']; ?></td>
          <td>
          <form method="post" action="editorderstatus.php">
            <div class="input-group">
              <input type="hidden" value="<?php echo $r['id']; ?>" name="id" />
              <select class="custom-select" id="inputGroupSelect04" name="status">
                <option selected>Choose...</option>
                <option value="submitted">submitted</option>
                <option value="in transit">in transit</option>
                <option value="delivered">delivered</option>
              </select>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Change status</button>
              </div>
            </div>
          </form>
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>

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