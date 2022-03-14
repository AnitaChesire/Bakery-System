<?php

include_once 'connection.php';


    //variables for the sign up form inputs 

$nameProf = $_POST['nameProf'];
$lastNameProf = $_POST['lastNameProf'];
$emailProf = $_POST['emailProf'];
$passwordProf = $_POST['passwordProf'];
$emailProfile = $_POST['emailProfile'];

  // Update data

$sql = "UPDATE products SET `fname` = '$nameProf', `lname` = '$lastNameProf', `email` = '$emailProf', 
`password` = '$passwordProf' WHERE email='".$_SESSION['email']."' ;";

//query the above sql statement 
 mysqli_query($conn, $sql);
 
 header("Location: ../profile.php?upload=success");
