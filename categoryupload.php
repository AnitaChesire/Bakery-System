<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

//calls the function
$data = checkLogIn($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Category upload</title>
  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" href="stylewelcome.css">



  <script>
    function validateCategoryUpload() {

      categoryName = document.getElementById("categoryName").value;
      categoryDescription = document.getElementById("categoryDescription").value;
      uploadCategory = document.getElementById("uploadCategory");

      //Check for Empty Fields

      if (categoryName == "" || categoryDescription == "") {
        alert("You must fill all fields");
        // because the conditions have not been met
        return false;
      } else {
        //  submit the form because conditions have been met..  value returned is true
        uploadCategory.submit();
        alert("submitted succesfully");
      }
    }
  </script>

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
        if ($_SESSION['user_id'] == 1) {
        ?>
          <a href="adminpanel.php">Dashboard</a>
          <a href="profile.php">Profile</a>
          <a href="logout.php">Logout</a>
        <?php
        } else {
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
        <a href="reports.php">Users' Report</a><br>
        <a href="suggestionview.php">Suggestions</a><br>
        <a href="users.php">Custom Orders</a><br>
        <a href="stock.php">Baking Essentials</a><br>
        <a href="supplierview.php">Suppliers</a><br>
        <a href="requestview.php">Requests</a><br>
        <a href="stockreport.php">Baking Essentials Report</a><br>
      </div>
    </div>
    <!--End Admin panel side bar--->

    <br></br>
    <h1 class="lg-title"> ADD CATEGORY </h1>


    <div class="column middle ">
      <form id="uploadCategory" onsubmit="return validateCategoryUpload()" method="post" action="includes/categoryincludes.php">
        <div id="categoryUploaderror"></div>
        <div id="productImage">
          <p>Category Name</p>
          <input id="categoryName" name="categoryName" type="text" />
          <br></br>
          <p>Category Description</p>
          <input id="categoryDescription" name="categoryDescription" type="text" />
          <br></br>
          <input type="submit" value="Upload Category" name="submitCat">
        </div>
      </form>
      <div>

</body>

</html>