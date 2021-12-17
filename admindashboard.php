<?php

  session_start();
  
  // if ($user==FALSE && !isset($_COOKIE["email"]) && !isset($_COOKIE["id"])){
  //   echo "Wrong Input";
  //   $URL = "admin login.php?status=invalid";
  //   header('Location: '.$URL);
    
  // }else{
  //   // $exp_minutes = 6;
  //   // setcookie("email", $user['email'], time() + (60*$exp_minutes));
  //   // echo "<br>C:".$_COOKIE["email"];

  //   //loading all products in homepage
  //   $stmt = $conn->prepare("SELECT * FROM product");
  //   $stmt -> execute();
  //   $products = $stmt->fetchAll();
  // }
  

  if (isset($_SESSION["email"]) && isset($_SESSION["id"])){
    echo $_SESSION["email"]." ".$_SESSION["id"];
    if( isset($_SESSION['logtype']) && $_SESSION['logtype'] == "user"){
      $URL = "userdashboard.php";
      header('Location: '.$URL); 
    }
    //loading all products
    require "connection.php";
    $stmt = $conn->prepare("SELECT * FROM product");
    $stmt -> execute();
    $products = $stmt->fetchAll();
  }else{
    require "connection.php";
    //admin login
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM admin WHERE (email=:email and password=:pass)");
    $stmt->execute(['email' => $email, 'pass' => $pass]); 
    $user = $stmt->fetch();
    if ($user==FALSE){
      echo "Wrong password or email!";
      $URL = "admin login.php?status=invalid";
      header('Location: '.$URL);
      
    }else{
      $_SESSION["email"] = $user['email'];
      $_SESSION['id'] = $user['id'];
      $_SESSION['logtype'] = "admin";
      $URL = "admindashboard.php";
      header('Location: '.$URL); 
    }
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
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
          <a class="nav-link" href="adminlogout.php">Log out</a>
        </li>
      </ul>
    </div>
  </nav>
  <br>
  <div class="container" align="center">

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    [+] Add a product
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create a product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="create product.php">
              <div class="form-group">
                <label for="exampleInputEmail1">Product name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  placeholder="Enter a product name" name="name">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Unit price</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter a unit price" name="unitprice">
              </div>
              <label for="locOption">Location</label>
              <select class="form-control" id="locOption" name="location">
                <option>Dhaka</option>
                <option>Rajshahi</option>
                <option>Chittagong</option>
              </select>
              <br>
              <br>
              <button type="submit" class="btn btn-primary">Create Product</button>
            </form>
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div> -->
        </div>
      </div>
    </div>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" onclick="location.href = 'ordermenu admin.php';">
      Manage Orders
    </button>

  </div>


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
              <p class="card-text"><?php echo $r['unit_price'] ?> bdt</p>
              <p class="card-text"><?php echo $r['location'] ?></p>
              <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeProd<?php echo $r['id'] ?>">Remove this product</a>
              <!-- Modal -->
              <div class="modal fade" id="<?php echo "removeProd".$r['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Confirmation about product removal</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <h5>Name: <?php echo $r['name'] ?></h5>
                    <p>Unit Price: <?php echo $r['unit_price'] ?> bdt</p>
                    <p>Location: <?php echo $r['location'] ?></p>
                    <p>ID: <?php echo $r['id'] ?></p>
                    </div>
                    <div class="modal-footer">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure about removing this product?</h5>
                    <button type="button" onclick="location.href = 'deleteproduct.php?id=<?php echo $r['id'] ?>';" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    </div>
                  </div>
                </div>
              </div>


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