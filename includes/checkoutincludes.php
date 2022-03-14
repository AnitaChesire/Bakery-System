<?php

include_once 'connection.php';


//variables for the sign up form inputs 
$user = $_POST['user'];
$totalAmount = $_POST['totalAmount'];
$pickUpLocation = $_POST['pickUpLocation'];
$paymentCode = $_POST['paymentCode'];


// insert data

$sql = "INSERT INTO ordersubmit (`email`, `amount`, `pickup`, `payment_code`)
VALUES ('$user', '$totalAmount', '$pickUpLocation', '$paymentCode');";

//query the above sql statement 
mysqli_query($conn, $sql);

header("Location: ../cart.php?order=success");
