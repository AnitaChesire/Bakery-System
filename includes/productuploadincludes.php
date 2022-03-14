<?php

include_once 'connection.php';


    //variables for the sign up form inputs 

$productName = $_POST['productName'];
$productCategory = $_POST['productCategory'];
$productDescription = $_POST['productDescription'];
$productPrice = $_POST['productPrice'];
$productImage = $_POST['productImage'];



  // insert data

$sql = "INSERT INTO products (`product_name`, `product_category`,`product_description`, `product_price`, `product_image`)
VALUES ('$productName', '$productCategory', '$productDescription', '$productPrice', '$productImage');";

//query the above sql statement 
 mysqli_query($conn, $sql);
 
 header("Location: ../productupload.php?upload=success");



?>