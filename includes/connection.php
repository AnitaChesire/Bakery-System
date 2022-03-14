<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword ="";
$dbName = "abc_bakery";

//create connection 

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

// super global variable which can access global variables from anywhere
$GLOBALS['conn'] = $GLOBALS['conn'];
// Checking for connection  

echo("connection Created Succesfully")


?>