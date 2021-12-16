<?php
require "connection.php";
$productid = $_GET['productid'];
$userid=$_GET['userid'];

$stmt = $conn->prepare("SELECT * FROM user WHERE (id=:userid)");
$stmt->execute(['userid' => $userid]); 
$user = $stmt->fetch();

$stmt = $conn->prepare("SELECT * FROM product WHERE (id=:productid)");
$stmt->execute(['productid' => $productid]); 
$product = $stmt->fetch();

echo var_dump($user);
echo var_dump($product);


?>