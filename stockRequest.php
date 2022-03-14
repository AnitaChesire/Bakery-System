<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');
//calls the function
$data = checkLogIn($conn);

//get the id from the link
$stock_id = $_GET['id'];
$query = "select * from stock where stock_id = '$stock_id'";
//  query the database
$stock = mysqli_query($conn, $query);

while ($rowStock = mysqli_fetch_assoc($stock)) {

  // get data from the data base 
  $name = $rowStock['name'];
  $amount = $rowStock['amount'];
  $measure = $rowStock['measure'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
  <title>Stock Request</title>
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
      <a href="javascript:void(0)" class="dropbtn"><?php
   echo $_SESSION['fname'];  ?></a>
      <div class="dropdown-content" style="right: 2%;;">
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
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

    <div class="column middle" style="width: 40%;">
      <div class="report">
        <h1 class="lg-title"> REQUEST STOCK</h1>

        <div class="selectReport">
          <!-- ?id=<?php //echo $stock_id;
                    ?> -->
          <form method="post" action="includes/requestIncludes.php">
            <?php

            // while ($s_prod = mysqli_fetch_assoc($s_product))
            //{
            ?>
            <p> Name</p>
            <input id="name" name="name" type="text" value="<?php echo $name; ?>" />
            <br>
            <p>Available Amount</p>
            <input id="amount" name="amount" type="text" value="<?php echo $amount; ?>" />
            <p>Quantity Request</p>
            <input type="number" name="quant" value="1" min="1" max="100">
            <br>
            <p>Measure</p>
            <input id="measure" name="measure" type="text" value="<?php echo $measure; ?>" />
            <br>
            <p>Supplier Email</p>
            <input id="email" name="email" type="text" />
            <br>
            <input id="status" name="status" type="hidden" value="ordered"/>
            <input id="reqStock" type="submit" name="reqStock" value="REQUEST">
            <?php
            // } 
            ?>
          </form>
        </div>
      </div>
    </div>
    <!-- display suppliers and their emails -->
    <div class="column side ">
      
<!--    
    <div class="column middle" style="width: 100%;"> -->
    <h1 class="lg-title" style="text-align: center; color:#ff0062;"> SUPPLIER INFORMATION </h1>
      <!-- search bar -->
      <!-- <form id="searchbar" method="post" action="stockRequest.php" style="margin: 5%;">
            <input type="text" placeholder="Search by item name/ type/supplier ..." name="search" style="width: 60%;">
            <button type="submit" name="searchO" style="width: 30%;">Submit</button>
          </form> -->
          
      <?php

      $query = "SELECT * FROM `supplier`";
      $res = mysqli_query($conn, $query);

      ?>

      <table>
        <tr>
          <th style="font-weight:bolder; text-align:left;">EMAIL</th>
          <th style="font-weight:bolder; text-align:left;">PRODUCTS</th>
          <th style="font-weight:bolder; color:crimson; text-align:center;">PRICE</th>
          <th style="font-weight:bolder; text-align:left;">TYPE</th>
        </tr>
        <?php
        while ($rows = mysqli_fetch_assoc($res)) {

        ?>
          <tr>
            <td><?php echo $rows['sup_email'] ?></td>
            <td><?php echo $rows['item_name'] ?></td>
            <td style="font-weight:bolder; color:crimson; text-align:center;"><?php echo $rows['item_price'] ?></td>
            <td><?php echo $rows['item_category'] ?></td>
          </tr>
        <?php
        }
        ?>

      </table>
      </div>
      </div>
      </div>
</body>

</html>