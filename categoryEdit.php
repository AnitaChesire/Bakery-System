<?php

session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
$data = checkLogIn($conn);


if (isset($_POST['updateCat'])) {

    $catName = $_POST['catName'];
    $catDesc = $_POST['catDesc'];

    $query = "UPDATE categories SET category_name = '$catName', category_decription = '$catDesc' ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script type="text/javascript" alert("Data Updated") </script>';
    } else {
        echo '<script type="text/javascript" alert("Data Has NOT been Updated") </script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
    <title>ABC abc_bakery</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="stylewelcome.css">
    <!-- <link rel ="stylesheet" href="style.css"/> -->
    <script defer src="js/cart.js"></script>

</head>


<body>

    <!--- Nav bar-->
    <ul>
        <li><a href="home.php" class="active">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="suggestions.php">Product Suggestion</a></li>
        <li class="cart"><a href="mycart.php">Cart <span>0</span></a></li>

        
    <li class="dropdown" style="float:right">
      <a href="javascript:void(0)" class="dropbtn">User</a>
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
                <a href="users.php">Users</a><br>
            </div>
        </div>



        <div class="column middle ">
            <div class="report">
                <form method="POST" action="includes/categoryEdit.php">
                <h1 class="lg-title"> UPDATE CATEGORY </h1>

                <div class="selectReport">
               
                    <p>Category Name</p>
                    <input id="catName" name="catName" type="text" />
                    <input id="catName" name="catName" type="text" />
                    <br>
                    <p>Category Description</p>
                    <input id="catDescription" name="catDesc" type="text" />
                    <br>

                    <input id="productEdit" name="updateCat" type="submit" value="UPDATE">
</form>


</body>

</html>