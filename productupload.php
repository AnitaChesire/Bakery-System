<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

//calls the function
$data = checkLogIn($conn);

$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
  <title>Products upload</title>
  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" href="stylewelcome.css">
  <!-- <link rel ="stylesheet" href="style.css"/> -->

  <script defer src="js/cart.js"></script>

  <script>
    function validateProductUpload() {

      //   fetch input fields from the form 
      productName = document.getElementById("productName").value;
      productDescription = document.getElementById("productDescription").value;
      productPrice = document.getElementById("productPrice").value;
      uploadProduct = document.getElementById("uploadProduct");

      //Check for Empty Fields

      if (productUploadForm == "" || productName == "" || productDescription == "" || productPrice == "") {
        alert("You must fill all fields");

        return false;
      } else {
        return true;
        uploadProduct.submit();
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
    <li class="cart"><a href="cart.php">Cart</a></li>


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

    <div class="column middle ">
      <h1 class="lg-title"> ADD A PRODUCT </h1>
      <form id="uploadProduct" onsubmit=" return validateProductUpload()" method="post" action="includes/productuploadincludes.php" enctype="fmultipart/form-data">
        <div id="productUploadForm"></div>
        <div id="productImage">
          <p>Product Name</p>
          <input id="productName" name="productName" type="text" />

          <p>Product Category</p>
          <select id="category" name="productCategory">
            <option value="">Select</option></br>
            <option value="Cakes">Cakes</option></br>
            <option value="Bread & Buns ">Bread & Buns</option></br>
            <option value="Cookies">Cookies</option></br>
          </select>
          <!--             
             <p>Product Category</p>
            <select id="category" name="productCategory">
      <option value="cakes">Cakes</option>
      <option value="Bread&Buns">Bread & Buns</option>
      <option value="Cookies">Cookies</option>
    </select> -->
          <br>
          <p>Product Description</p>
          <input id="productDescription" name="productDescription" type="text" />
          <br>
          <p>Product Price</p>
          <input id="productPrice" name="productPrice" type="text" />
          <br>
          <p>Product Image
            <!-------select Image to upload--->
            <input type="file" name="productImage" id="fileToUpload">
          </p>
          <br>
          </br>
          <input type="submit" value="Upload">
        </div>
      </form>
    </div>
  </div>




</body>

</html>