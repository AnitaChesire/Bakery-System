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
<link rel="icon" href="..\images\icon.png" type="image/gif" sizes="16x16">
<title>ABC abc_bakery</title>
<link rel="stylesheet" href="navbar.css">
<link rel="stylesheet" href="stylewelcome.css">
<script defer src="js/cart.js"></script>
</head>
<body>
<p>Welcome
    <?php
    echo $_SESSION['fname'];
    ?>
  </p>
<ul>
  <li><a href="home.php" class="active">Home</a></li>
  <li><a href="about.php">About Us</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="suggestions.php">Product Suggestion</a></li>
  <li class="cart"><a href="cart.php">Cart</a></li>
  <li class="dropdown" style="float:right">
      <!-- void 0 so the browser returns nothing  -->
      <!-- void(0) means, do nothing - don't reload, don't navigate, do not run any code. -->
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
    elseif($_SESSION['user_id'] == 3){
      ?>
      <a href="suppliers.php">Supplier</a>
      <a href="profile.php">Profile</a>
      <a href="logout.php">Logout</a>
      <?php
  }
    else{
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
  </div>
  
  <div class="column middle">
    <h1 style="text-align: center; color:#ff0062;">About Us</h1>
    <h4 style="text-align: center; color:#f8abc9;">Our Story</h4>
    <h2 style="color:#f8abc9;">Our Story</h2>
    <p>ABC Bakery is a 1st generation family owned and Deli shop located in the capital city of Kenya. We offer the broadest selection of authentic baked goods. Our motto is, “Because you deserve only the best”. It means that we wake up each day thinking of how we can delight our customers by putting a smile on your face! And we make everything right here from scratch every day. While enjoying one of our great pastries or signature cakes, don’t forget to bring home a loaf of our house-made bread; Bavarian Rye, Sourdough, and fresh sandwich rolls.

</p>
    <h2 style="text-align: right; color:#f8abc9;">Our Team
</h2>
<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="img_forest.jpg">
      <img src="andreas.jpg" alt="cake" width="600" height="400">
    </a>
    <div class="desc">Andreas Janke trained for years to become a baker. Andreas started his career at the age of 16 as a baker’s apprentice in Giessen. He subsequently attended pastry school in Regensburg which was immediately followed by an additional year of study for fine patries in Neu Stadt, both located in Bavaria. Andreas brings extensive experience running bakery operations in the local Dover area. He has been the recipient of numerous awards for his creative skills by the Dover Post and most notably he was recognized by the Delaware Today in its 2008 Savor addition. Andreas is a veteran of the German bundeswehr, and he achieved the rank of 1st Sargent.</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="img_lights.jpg">
      <img src="monika.jpg" alt="donut" width="600" height="400">
    </a>
    <div class="desc">Monika Urquhart has extensive experience in sales, marketing, and management, of food service operations. She has over 30 years of experience working with large retail, grocery, and specialty food operations. Moreover, she played an instrumental role with the U.S. startup of BP’s Wild Bean Café operations in 2005 and Chick-fil-A operations in the Atlanta area. Monika is a graduate from the Alisan Culinary & Hotel management school based in Giessen Germany.</div>
  </div>
</div>
  </div>
  
  <div class="column side">
  
</div>

  </div>
</body>
</html>