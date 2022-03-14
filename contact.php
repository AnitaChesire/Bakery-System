<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
$data = checkLogIn($conn);

?>

<!DOCTYPE html>
<html>
  <head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
<title>ABC abc_bakery</title>
<link rel="stylesheet" href="navbar.css">
<link rel="stylesheet" href="stylewelcome.css">
<script defer src="js/cart.js"></script>
</head>
<body>
<ul>
  <li><a href="home.php" class="active">Home</a></li>
  <li><a href="about.php">About Us</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="suggestions.php">Product Suggestion</a></li>
  <li class="cart"><a href="mycart.php">Cart <span>0</span></a></li>
  
  
  <li class="dropdown" style="float:right">
      <a href="javascript:void(0)" class="dropbtn"><?php
    echo $_SESSION['fname'];
    ?></a>
      <div class="dropdown-content" style="right: 2%;;">
      <!-- If the logged in user is an administrator, provide a link to to take them to the admin side  -->
      <?php
    if($_SESSION['user_id'] == 1){
      ?>
      <a href="adminpanel.php">Dashboard</a>
      <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
        <?php
    }
  //  <!-- If the logged in user is an supplier, provide a link to to take them to the supplier side  -->
    elseif($_SESSION['user_id'] == 3){
      ?>
      <a href="suppliers.php">Supplier</a>
      <a href="profile.php">Profile</a>
      <a href="logout.php">Logout</a>
      <?php
  }
   else{
    //   if not an admin display the drop down button without a link to the admin side 
      ?>
      <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
      <?php
    }

?>
      </div>
    </li>
  </ul>
<img src="logo.png" alt="Girl in a jacket" style="width:30%;display:block;margin-left: auto;margin-right: auto;">
<!--nav abar section-->
<div class="row">
  <div class="column side">
    <h1 style="text-align: center; color:#ff0062;">Contacts</h1>
    <hr>
    <h4>abc@gmail.com</h4>
    <hr>
    <h4>2nd Floor, Josem Trust House,Bunyala Rd.
    <hr>
    <h4>0743000000</h4>
    <hr>
    <h4>074300000</h4>
    
  </div>
  
  <div class="column middle">
    <h1 style="text-align: center; color:#ff0062;">Location</h1>
    <h4 style="text-align: center; color:#f8abc9;">Find us</h4>
    <h2 style="color:#f8abc9;">Order Online</h2>
    <p>Now order our fresh products online. The bakery provides freshly prepared bakery and pastry products at all times during business operations. Bavarian Bakery also offers a broad range of savory Deli products, all from high quality Boar’s Head meats and vegetables. The Bavarian bakery caters to all of its customers by providing each customer products made to suit the customer, down to the smallest detail. </p>
    <h2 style="text-align: right; color:#f8abc9;">Custom Cakes</h2>
    <p>Make sure everyone gets a taste of cake when you know how many guests each tier will serve. Our guide removes the guesswork. Deciding on the configuration of your wedding cake largely depends on the number of guests you plan to serve.</p>
    
  </div>
  
  <div class="column side">
  
</div>


  </div>
</body>
</html>