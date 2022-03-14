<?php

include_once 'connection.php';


    //variables for the sign up form inputs 

$productSuggestName = $_POST['productSuggestName'];
$suggestionDescription = $_POST['suggestionDescription'];
$suggestionImage = $_POST['suggestionImage'];


  // insert data

$sql = "INSERT INTO suggestions (`product_name`, `description`,`image`)
VALUES ('$productSuggestName', '$suggestionDescription', '$suggestionImage');";

//query the above sql statement 
 mysqli_query($conn, $sql);
 
 header("Location: ../suggestions.php?suggestionupload=success");



?>