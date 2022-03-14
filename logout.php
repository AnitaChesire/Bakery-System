<?php
   session_start();
   // if(isset($_SESSION["email"]))
   // {
      unset($_SESSION["email"]);


      session_destroy();
      header('location: index.php?logout=successful');
   // }
   
   
   // after destroying session it will be redirected to the index page

   
?>