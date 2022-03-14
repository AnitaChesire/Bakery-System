<?php

//to initialize a session 
session_start();
echo ("welcome");


//connection to the file that makes the db connection 
include_once 'connection.php';


//variables for the sign up form inputs 

$loginemail = $_POST['email'];
$loginpaswrd = $_POST['paswrd'];


$query = ("SELECT * FROM users WHERE email = '$loginemail' and password ='$loginpaswrd' ");
$result = mysqli_query($conn, $query);
//get the number of rows in the result
$row = mysqli_num_rows($result);
//fetch array of result
$data=mysqli_fetch_assoc($result);
if ($row == 1 && $data['user_role_id'] == 2) {
        $_SESSION['email'] =$data['email'];
        $_SESSION['fname'] =$data['fname'];
        $_SESSION['user_id'] =$data['user_id'];
     header("Location: ../home.php?login=success");
 }
 elseif ($row == 1 && $data['user_role_id'] == 1){
        $_SESSION['email']=$data['email'];
        $_SESSION['fname']=$data['fname'];
        $_SESSION['user_id']=$data['user_id'];
    header("Location: ../adminpanel.php?login=success");
 }
 elseif ($row == 1 && $data['user_role_id'] == 3){
    $_SESSION['email']=$data['email'];
    $_SESSION['fname']=$data['fname'];
    $_SESSION['user_id']=$data['user_id'];
header("Location: ../suppliers.php?login=success");
}
else {
    echo ("Account info doesnt Exist");
}
