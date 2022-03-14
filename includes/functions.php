<?php

include_once('connection.php');
// a fn to check if the user is actualy logged into the system.
// it checks if the users email is saved to the session

    function checkLogIn($conn)
    {
        if (isset($_SESSION['email'])){
        //    this is getting the email saved to the session and saving ot to the email variable
            $email = $_SESSION['email'];
            //this gets one result from the db that matches the email saved in the session
            $query = "SELECT * FROM users WHERE email= '$email' limit 1";

            $result = mysqli_query($conn, $query);
            // if the result is positive and greater than 0 i.e it actually exists in the db 
            // save the users data in the db back to the array
            if($result && mysqli_num_rows($result) > 0){
// fetch array
                $data = mysqli_fetch_array($result);
                return $data;
            }
            
            }
            else{
                // else user isnt logged in and redirected to log in page.
                header("Location: ../index.php");
        }
    }

?>