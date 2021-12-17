<?php
session_start();
require "connection.php";
$productid = $_GET['productid'];
$userid=$_SESSION['id'];

$stmt = $conn->prepare("SELECT * FROM product WHERE (id=:productid)");
$stmt->execute(['productid' => $productid]); 
$product = $stmt->fetch();

if($product['location']==$_SESSION["location"] ){ 
        $price = $product['unit_price']- ($product['unit_price']*0.25);
}else{
    $price = $product['unit_price'];
}
$status = "submitted";
$sql = "INSERT INTO product_order VALUES ('','".$userid."', '".$productid."', '".$price."', '".$status."')";
// use exec() because no results are returned
$conn->exec($sql);
//echo "New record created successfully";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Billing Receipt</title>
</head>
<body>
    <div id="bill" class="container" align="center">
        <h2>Your order have been placed successfully!!</h2>
        <hr>
        <h1>Billing Receipt</h1>
        <hr>
        <p>Buyer name: <?php echo $_SESSION['name'] ?></p>
        <p>Buyer id: <?php echo $_SESSION['id'] ?></p>
        <p>Buyer location:<?php echo $_SESSION['location'] ?></p>
        <p>Product Name: <?php echo $product['name'] ?></p>
        <p>Product ID: <?php echo $product['id'] ?></p>
        <p>Product location: <?php echo $product['location'] ?></p>
        <p>Product Quantity: 1</p>
        <p>Payment method: Cash on delivery</p>
        <?php 
                
        if($product['location']==$_SESSION["location"] ){ 
        
        ?>
            <p>Original price: <?php echo $product['unit_price'] ?></p>
            <p>Discount percentage: 25%</p>
            <hr>
            <p>Amount to be paid: <?php echo $product['unit_price']- ($product['unit_price']*0.25) ?> bdt</p>
            <hr> 
    
        <?php }else{ ?>

            <p>Price: <?php echo $product['unit_price'] ?></p>
            <hr>
            <p>Amount to be paid: <?php echo $product['unit_price'] ?> bdt</p>
            <hr> 

        <?php } ?>
        


    </div>
    <div align="center">
        <button type="button" onclick="location.href = 'userdashboard.php';" class="btn btn-primary">
        Go to dashboard
        </button>
        
        
        
        <button type="button" 
        onclick="
                var contents = document.getElementById('bill').innerHTML;
                var maincontents = document.body.innerHTML;
                document.body.innerHTML = contents;
                window.print();
                document.body.innerHTML = maincontents;
                
                "
        class="btn btn-primary">
        print
        </button>
    </div>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>