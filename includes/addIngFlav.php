
<?php

include_once('connection.php');
// fetch input fields from the form
    
    $flav = $_POST['flav'];
    $stockFlav = $_POST['stockFlav'];
    $flavour = $_POST['flavour'];
    $meas = $_POST['meas'];
   
    // when you click the add flavour    
    
        $query="INSERT INTO stock(`name`, `amount`, `type`, `measure`)
        VALUES('$flav', '$stockFlav', '$flavour', '$meas');";
// query to insert values into the database
         mysqli_query($conn, $query);
         header("Location: ../stock.php?upload=success");
  

?>
