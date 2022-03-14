<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

//calls the function
$data = checkLogIn($conn);

$query = "SELECT * FROM suggestions";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
  <title>Suggestions</title>
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
    <li class="cart"><a href="cart.php">Cart</a></li>

    <li class="dropdown" style="float:right">
      <!-- void 0 so the browser returns nothing  -->
      <!-- void(0) means, do nothing - don't reload, don't navigate, do not run any code. -->
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

    <div class="column middle ">
      <h1 class="lg-title"> SUGGESTIONS </h1>
      <section>
        <table>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>

          </tr>
          <?php
          while ($rows = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td><img src="images/<?php echo $rows['image']  ?>" /></td>
              <td>
                <h1><?php echo $rows['product_name']  ?></h1>
              </td>

              <!-- <p class="price"><?php echo $rows['product_price']  ?></p> -->
              <td>
                <p class="description"><?php echo $rows['description']  ?></p>
              </td>
              <!-- <p><a href="#"><button>Order</button></a></p> -->
            </tr>

    </div>
    </br>
  <?php
          }
  ?>
  </div>

  <!---PAGINATION--->

  <!-- <div class="pagination"> -->
  <!-- <a href="#">&laquo;</a>
  <a class="active" href="#">1</a>
  <a href="#">2</a>
  <a href="#">3</a>
  <a href="#">4</a>
  <a href="#">5</a>
  <a href="#">6</a>
  <a href="#">&raquo;</a>

</div> -->

</body>

</html>