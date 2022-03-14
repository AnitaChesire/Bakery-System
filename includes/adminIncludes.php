<?php

session_start();
//connection to the file that makes the db connection 
include_once 'connection.php';


    //variables for the  form inputs 
$adminemail= $_POST['email'];
$adminpaswrd = $_POST['paswrd'];


$query = ("SELECT * FROM users WHERE email = '$adminemail' and password ='$adminpaswrd' ");
$result =mysqli_query($conn, $query);
//get the number of rows in the result
$row = mysqli_num_rows($result);

if ($row == 1){
    header("Location: ../adminpanel.php?login=success");
}
else{
    echo("Account info doesnt Exist");
}

?>