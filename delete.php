<?php
include("includes/connection.php");
error_reporting(0);

$product_id=$_GET['id'];
$query = "delete from products where product_id = '$product_id'";
 
$data = mysqli_query($conn, $query);

if($data)
{
    echo "Record Deleted Successfully";
    header("Location: ../project/categories.php");
}else{
    echo "Record Not Deleted";
}
?>