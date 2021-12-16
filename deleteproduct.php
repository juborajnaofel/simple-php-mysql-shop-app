<?php
require "connection.php";
// sql to delete a record
$sql = "DELETE FROM product WHERE id=".$_GET['id']."";

// use exec() because no results are returned
$conn->exec($sql);
echo "Record deleted successfully";
?>