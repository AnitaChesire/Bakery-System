<?php

  session_start();

//connection to the file that makes the db connection 
include_once 'connection.php';


    //variables for the sign up form inputs 

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$email = $_POST['emailSupplier'];
$user_role_id = $_POST['user_role_id'];
$passwordSup = $_POST['paswrdSup'];
$org = $_POST['org'];


$s = "SELECT * FROM users WHERE email = '$email' ";

$res = mysqli_query($conn, $s);

$num = mysqli_num_rows($res);

if($num == 1){
  echo("The Email Address has been taken");
  
}
 else{
    // insert data

$sql = "INSERT INTO users (`fname`, `lname`, `email`,`user_role_id`, `password`,`organization`)
VALUES ('$firstName', '$lastName', '$email','$user_role_id', '$passwordSup', '$org');";
  //query the above "insert" statement 
        mysqli_query($conn, $sql);
        
        header("Location: ../suppliers.php?login=success");

 }
  
?>
