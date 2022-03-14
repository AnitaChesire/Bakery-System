<?php
session_start();

include_once('connection.php');

//variables for the sign up form inputs 
if(isset($_POST['reqUp']))
{
// get the specific request id
    $req_id= $_POST['id'];
    $name= $_POST['name'];
    $qty= $_POST['qty'];
    $sup= $_POST['sup'];
    $delv= $_POST['delv'];
    $meas = $_POST['meas'];
    $amount= $_POST['amount'];
    $total = $amount + $qty;

    // update the status 

    $query= "UPDATE request SET name = '$name', amount = '$amount', quantity = '$qty', meas = '$meas', status = '$delv', email = '$sup', total ='$total'  WHERE req_id = '$req_id'";

   $result = mysqli_query($conn, $query);

   if ($result) {
        header("Location: ../requestview.php?update=successful");
        echo '<script type="text/javascript" alert("Data Updated") </script>';
    } 
    else {
        header("Location: ../requestview.php?update=successful");
        echo '<script type="text/javascript" alert("Data Has NOT been Updated") </script>';
    }
}

?>