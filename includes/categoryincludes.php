<?php

include_once 'connection.php';


    //variables for the sign up form inputs 

$productName = $_POST['categoryName'];
$productDescription = $_POST['categoryDescription'];

  // insert data
$sql = "INSERT INTO `categories`( `category_name`, `category_description`) VALUES ('$productName','$productDescription');";

//query the above sql statement 
 mysqli_query($conn, $sql);
 header("Location: ../categoryupload.php?upload=success");
?>