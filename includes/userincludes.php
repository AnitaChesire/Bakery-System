<?php
session_start();

include_once 'connection.php';


    //variables for the input

$role = $_POST['adminUser'];
$fname = $_SESSION['fname'];;

$s = ("SELECT * FROM users WHERE fname = '$fname' ");

$res = mysqli_query($conn, $s);

$num = mysqli_num_rows($res);

if($num == 1){
  // insert data
  $sql = "UPDATE users SET `user_role_id`= '$role' ;";
  
    echo "<div class='alert'>
  Updated Successfuly
  </div>";

   header("Location: ../users.php?role=success");

}
else{
  echo "<div class='alert'>
                  No records matching your search
                  </div>";
}

//query the above sql statement 
//  mysqli_query($conn, $sql);
 
 



?>