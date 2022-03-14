<?php

include_once 'connection.php';

    //variables for the sign up form inputs 

    $orderEmail = $_POST['orderE'];
    $product = $_POST['product'];
    $amount = $_POST['amountKg'];
    $quantity = $_POST['quantityKg'];
    $productDescription = $_POST['productDescription'];
    $customization = $_POST['customization'];
    $pickupLocation = $_POST['pickupLocation'];
    $result = $amount * $quantity;
    $code = $_POST['code'];

  // insert data

      $sql = "INSERT INTO ordersCustom (`email`, `product_name`, `quantity`, `amount`, `product_customization`, `product_description`, `pickup_location`, `total_amount`, `payment_code`)
      VALUES ('$orderEmail', '$product', '$quantity', '$amount', '$customization', '$productDescription',  '$pickupLocation', '$result', '$code');";

//query the above sql statement 
 mysqli_query($conn, $sql);
 
 header("Location: ../orderform.php?order=success");
