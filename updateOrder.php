<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
$data = checkLogIn($conn);

$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
  <title>Orders</title>
  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" href="stylewelcome.css">


</head>


<body>
  <!--- Nav bar-->
  <ul>
    <li><a href="home.php" class="active">Home</a></li>
    <li><a href="about.php">About Us</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="suggestions.php">Product Suggestion</a></li>
    <li class="cart"><a href="cart.php">Cart <span>0</span></a></li>

    <li class="dropdown" style="float:right">
      <a href="javascript:void(0)" class="dropbtn">User</a>
      <div class="dropdown-content" style="right: 2%;;">
        <a href="profile.php">Profile</a>
        <a href="../php/logout.php">Logout</a>
      </div>
    </li>
  </ul>

  <!---end of Nav bar-->


  <!--Admin panel side bar--->
  <div class="row">
    <div class="column side ">
      <div class="sidenav">
        <a href="adminpanel.php">Dashboard</a><br>
        <a href="categories.php">Categories</a><br>
        <a href="categoryupload.php">Add Category</a><br>
        <a href="productupload.php">Add Product </a><br>
        <a href="orders.php">Orders</a><br>
        <a href="reports.php">Reports</a><br>
        <a href="suggestionview.php">Suggestions</a><br>
        <a href="users.php">Custom Orders</a><br>
      </div>
    </div>

    <body>

      <!-- FILTER ORDERS -->
      <div class="column middle">
        <form id="searchbar" method="post" action="includes/orderUpdate.php">
        <h1 class="lg-title">INPUT ORDER STATUS </h1>
        <h2>Paid/preparing/Ready/Complete</h2>
          <input type="text" placeholder="paid" name="paid">
          <input type="text" placeholder="preparing" name="preparing">
          <input type="text" placeholder="ready" name="ready">
          <input type="text" placeholder="complete" name="complete">
          <button type="submit" >Submit</button>

        </form>
        <!-- <div class= "search field">
          
        </div> -->
      </div>
      
    </body>

</html>