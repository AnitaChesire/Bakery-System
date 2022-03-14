<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

//calls the function
$data = checkLogIn($conn);

$query = "SELECT * FROM supplier";
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
    <li><a href="cart.php">Cart</a></li>

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
        <!-- FILTER FOR USERS -->
        <form id="searchbar" method="post" action="supplierview.php" style="margin: 5%;">
          <input type="text" placeholder="Search by first name/email/role..." name="search" style="width: 60%;">
          <button type="submit" style="width: 30%;">Submit</button>
        </form>
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
    <!-- overflow specifies what should happen to elements if they dont fit into the specified area auto addsa scrollbar
          if neccessary -->
    <div class="column middle" style="overflow: auto !important">
      <h1 style="text-align: center; color:#ff0062;">SUPPLIERS</h1>
      <?php
      // display total suppliers in the system
      $all = mysqli_num_rows($result);
      echo ("Total supply items records: $all");

      if (isset($_POST["search"])) {
        $search = $_POST['search'];

        //query to get order based on the search keyword
        $searchResult = "SELECT * FROM supplier WHERE sup_email LIKE '%$search%' OR item_name LIKE '%$search%' ";
        //execute the query

        $res = mysqli_query($conn, $searchResult);
        //count all the rows with the results
        $queryResults = mysqli_num_rows($res);
        //check for availabilty
        if ($queryResults > 0) {
?>
<h1 style="text-align: center; color:#ff0062;">Search Results</h1>
<table id="orders" style="width: 100% !important; margin-left:0%;">
              <tr>
              <th>EMAIL</th>
          <th>ITEM</th>
          <th>PRICE</th>
          <?php
          while ($row = mysqli_fetch_assoc($res)) {
            //fetch all resulting data from the db
            $email = $row['sup_email'];
            $name = $row['item_name'] ;
            $price = $row['item_price'] ;
      ?>
            
              </tr>
<!-- dispaly search results -->
              <tr>
                <td><?php echo $email  ?></td>
                  <td><?php echo $name  ?>"</td>
                <td><?php echo $price ?></td>
              </tr>
            
      <?php
          }
        } else {
          echo "<div class='alert'>
                      No records matching your search
                      </div>";
        }
      }
      ?>
      </table>
      <h1 style="text-align: center; color:#ff0062;">All records</h1>
      <table id="orders" style="width: 100% !important; margin-left:0%;">
        <tr>
          <th>EMAIL</th>
          <th>ITEM</th>
          <th>PRICE</th>
        </tr>

        <?php
        while ($rows = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $rows['sup_email']  ?></td>
            <td><?php echo $rows['item_name']  ?> </td>
            <td><?php echo $rows['item_price']  ?></td>
            
          </tr>
        <?php
        }
        ?>

      </table>
    </div>
</body>

</html>