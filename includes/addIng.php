
<?php

session_start();
include_once('connection.php');
// fetch input fields from the form
    $ing = $_POST['ingredient'];
    $stock = $_POST['stock'];
    $ingName = $_POST['ingName'];
    $measure = $_POST['measure'];
   
    // when you click the add ingredient flavour
    
        $sql="INSERT INTO stock(`name`, `amount`, `type`, `measure`)
        VALUES('$ing', '$stock', '$ingName', '$measure');";
// query to insert values into the database
        mysqli_query($conn, $sql);
        header("Location: ../stock.php?upload=success");
    
?>
