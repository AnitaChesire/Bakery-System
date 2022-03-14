 <?php
  session_start();
include_once 'connection.php';
    //variables for the sign up form inputs 

$first = $_POST['fname'];
$last = $_POST['lname'];
$email = $_POST['email'];
$user_role_id = $_POST['user_role_id'];
$password = $_POST['paswrd'];
$orgz = $_POST['orgz'];

$s = "SELECT * FROM users WHERE email = '$email' ";

$res = mysqli_query($conn, $s);

$num = mysqli_num_rows($res);

if($num == 1){
  echo("The Email Address has been taken");
}
 else{
    // insert data
$sql = "INSERT INTO users (`fname`, `lname`, `email`,`user_role_id`, `password`,`organization`)
VALUES ('$first', '$last', '$email', '$user_role_id', '$password','$orgz');";
  //query the above "insert" statement 
        mysqli_query($conn, $sql);
        
    header("Location: ../home.php?login=success");
 }
  
?>


