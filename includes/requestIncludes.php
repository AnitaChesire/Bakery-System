<?php

//connection to the file that makes the db connection 
include_once 'connection.php';

//variables for the sign up form inputs 

// get the specific stock id
    // $stock_id= $_GET['id'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $measure = $_POST['measure'];
    $quant = $_POST['quant'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    

    $query = "INSERT INTO `request`(`name`, `amount`, `quantity`, `meas`, `email`) 
    VALUES ('$name', '$amount','$quant', '$measure', '$status', '$email'); ";

$res = mysqli_query($conn, $query);

//   header("Location: ../stock.php?request=success");
  echo '<script>alert("Item Requested Successfully")</script>';
  echo '<script>window.location="../stock.php"</script>';

  
?>
