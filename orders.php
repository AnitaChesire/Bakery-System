<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

//calls the function
$data = checkLogIn($conn);

$query = "SELECT * FROM orders ORDER BY `order_id` ASC";
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
  <p>Welcome
    <?php
    echo $_SESSION['fname'];  ?>
  </p>
  <h1></h1>
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
        <form id="searchbar" method="post" action="orders.php" style="padding:5%;">
          <input type="text" placeholder="Search by upload time/product name ..." name="search" style="width: 65%;">
          <button type="submit" style="width: 30%;">Submit</button>
        </form>
        <a href="adminpanel.php">Dashboard</a><br>
        <a href="categories.php">Categories</a><br>
        <a href="categoryupload.php">Add Category</a><br>
        <a href="productupload.php">Add Product</a><br>
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



    <body>
      <!-- FILTER ORDERS -->
      <div class="column middle" style="overflow: auto !important; width: 70% !important;">
        <h1 style="text-align: center; color:#ff0062;">ORDERS </h1>
        <form id="searchbar" method="get" action="orders.php">
        <?php 
        // current year variable
        // y returns the last two digits of that year 
        //  Y returns all digits of the year
        $year = date("Y");
        echo '<select name="year" id="year" style="width: 30%;">';
        echo '<option value="year">Choose Year</option>';
        // variable for the first year in the range 
          $new = 2018;
          // while loop where while 2018 is less than or equal to the current year..
          While($new <= $year){
            // in the dropdown create an option value 
            echo "<option value='$new'>". $new ."</option>";
            // this option value is a +1 of the 2018 variable
            $new++;
          }
          // close select
        echo '</select>';
        ?>

        <?php 
         // current year variable
        //  small m is for the month name
        // big M is for the month number
        $month = date("m");
        echo '<select name="month" id="month" style="width: 30%;">';
        echo '<option value="">Choose month</option>';
        // variable for the first month in the range 
          $neww = 1;
           // while loop where while 1 is less than or equal to the current month..
          While($neww <= $month){
            // in the dropdown create an option value 
            echo "<option value='$neww'>". $neww ."</option>";
             // this option value is a +1 of the $neww variable
            $neww++;
          }
          // close select
        echo '</select>';
        ?>

        <button type="submit" style="width: 30%;">Submit</button>
        </form>
        <?php
        // date() function will return the current Year of the server
        // y returns the last two digits of that year 
        //  Y returns all digits of the year
        $dtNow = date("Y");
        //Year should be past the current year
        if (!empty($_GET["year"])) {
          if ($_GET["year"] > $dtNow) {
            echo "Year should be less than or equal to $dtNow";
          }
        }
        //else{
        //echo "Year  is required.";
        // }
        if (isset($_POST["search"])) {
          $search = $_POST['search'];
          //query to get order based on the search keyword
          $searchResult = "SELECT * FROM orders WHERE item_name LIKE '%$search%' OR email LIKE '%$search%' ";
          //execue the query
          $res = mysqli_query($conn, $searchResult);
          //count all the rows with the results
          $queryResults = mysqli_num_rows($res);
          //check for availabilty
          if ($queryResults > 0) {
        ?>
        <table id="orders" style="width: 100% !important; margin-left:0%;">
          <tr>
            <th style="font-weight:bolder; text-align:center;">PRODUCT NAME</th>
            <th style="font-weight:bolder; text-align:right;">QUANTITY</th>
            <th style="font-weight:bolder; text-align:right;">TOTAL AMOUNT</th>
            <th style="font-weight:bolder; text-align:left;">EMAIL</th>
            <th style="font-weight:bolder; text-align:left;">DATE</th>
            <!-- <th>EMAIL</th> -->
          </tr>
          <?php
              while ($row = mysqli_fetch_assoc($res)) {
                //fetch all resulting data from the db
                $itemName = $row['item_name'];
                $amount = $row['item_price'];
                $quantity = $row['item_quantity'];
                $total = $row['order_total'];
                $time = $row['time'];
                $email = $row['email'];
              ?>
          <tr>
            <td style="font-weight:bolder; text-align:center;"><?php echo $itemName  ?> </td>
            <td style="font-weight:bolder; color:red; text-align:right;"><?php echo $quantity ?></td>
            <td style="font-weight:bolder; color:red; text-align:right;"><?php echo $amount  ?></td>
            <td style="font-weight:normal; text-align:left;"><?php echo $email  ?></td>
            <td style="font-weight:bolder; text-align:left;"><?php echo $time  ?></td>
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
        <?php
            // GET is used for viewing something, without changing it, while POST is used for changing something. 
            if (!empty($_GET["year"]) && empty($_GET["month"])) {
              $searchYear = $_GET['year'];
              //query to get order based on the search keyword
              $searchResult = "SELECT * FROM orders WHERE time LIKE '%$searchYear%'";
              //execute the query
              $res = mysqli_query($conn, $searchResult);
              //count all the rows with the results
              $queryResults = mysqli_num_rows($res);
              //check for availabilty
            ?>
        <table id="orders" style="width: 100% !important; margin-left:0%;">
          <tr>
            <th>PRODUCT NAME</th>
            <th>QUANTITY</th>
            <th>TOTAL AMOUNT</th>
            <th>DATE</th>
            <th>EMAIL</th>
          </tr>
          <?php
                if ($queryResults > 0) {
                  while ($row = mysqli_fetch_assoc($res)) {
                    //fetch all resulting data from the db
                $itemName = $row['item_name'];
                $amount = $row['item_price'];
                $quantity = $row['item_quantity'];
                $total = $row['order_total'];
                $time = $row['time'];
                $email = $row['email'];
              ?>
          <tr>
            <td style="font-weight:bolder; text-align:center;"><?php echo $itemName  ?> </td>
            <td style="font-weight:bolder; color:red; text-align:right;"><?php echo $quantity ?></td>
            <td style="font-weight:bolder; color:red; text-align:right;"><?php echo $amount  ?></td>
            <td style="font-weight:normal; text-align:left;"><?php echo $email  ?></td>
            <td style="font-weight:bolder; text-align:left;"><?php echo $time  ?></td>
          </tr>
          <?php
                  } ?>
          <?php
                } else {
                  echo "<div class='alert'>
            No records matching your search
            </div>";
                }
              }
              ?>
        </table>
        <?php
              if (!empty($_GET["month"]) && !empty($_GET["year"])) {
                $searchYear = $_GET['year'];
                $searchMonth = $_GET['month'];
                //query to get order based on the search keyword
                $searchResult = "SELECT * FROM orders WHERE  month(time) = $searchMonth and year(time) = $searchYear";
                //execute the query
                $res = mysqli_query($conn, $searchResult);
                //count all the rows with the results
                $queryResults = mysqli_num_rows($res);
                //check for availabilty
              ?>
        <table id="orders" style="width: 100% !important; margin-left:0%;">
          <tr>
            <th style="font-weight:bolder; text-align:center;">PRODUCT NAME</th>
            <th style="font-weight:bolder; text-align:right;">QUANTITY</th>
            <th style="font-weight:bolder; text-align:right;">TOTAL AMOUNT</th>
            <th style="font-weight:bolder; text-align:left;">EMAIL</th>
            <th style="font-weight:bolder; text-align:left;">DATE</th>
            <!-- <th>EMAIL</th> -->
          </tr>
          <?php
                  if ($queryResults > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                      //fetch all resulting data from the db
                      $itemName = $row['item_name'];
                $amount = $row['item_price'];
                $quantity = $row['item_quantity'];
                $total = $row['order_total'];
                $time = $row['time'];
                $email = $row['email'];
              ?>
          <tr>
            <td style="font-weight:bolder; text-align:center;"><?php echo $itemName  ?> </td>
            <td style="font-weight:bolder; color:red; text-align:right;"><?php echo $quantity ?></td>
            <td style="font-weight:bolder; color:red; text-align:right;"><?php echo $amount  ?></td>
            <td style="font-weight:normal; text-align:left;"><?php echo $email  ?></td>
            <td style="font-weight:bolder; text-align:left;"><?php echo $time  ?></td>
          </tr>
          <?php
                    }
                  } ?>
          <!-- </table> -->
          <?php
              }
              //else {
              //   echo "<div class='alert'>
              //         No records matching your search
              //         </div>";
              // }
              ?>
        </table>
        <table id="orders" style="width: 100% !important; margin-left:0%;">
          <tr>
            <th style="font-weight:bolder; text-align:center;">PRODUCT NAME</th>
            <th style="font-weight:bolder; text-align:right;">QUANTITY</th>
            <th style="font-weight:bolder; text-align:right;">TOTAL AMOUNT</th>
            <th style="font-weight:bolder; text-align:left;">EMAIL</th>
            <th style="font-weight:bolder; text-align:left;">DATE</th>
            <!-- <th>EMAIL</th> -->
          </tr>
          <?php
                while ($rows = mysqli_fetch_assoc($result)) {
                  $name = $rows['item_name'];
                  $totalAmount = $rows['item_quantity'];
                  $paymentCode = $rows['order_total'];
                  $ordertime = $rows['time'];
                  $email = $rows['email'];
                ?>
          <tr>
            <td style="font-weight:bolder; text-align:center;"><?php echo $name  ?> </td>
            <td style="font-weight:bolder; color:red; text-align:right;"><?php echo $totalAmount  ?></td>
            <td style="font-weight:bolder; color:red; text-align:right;"><?php echo $paymentCode  ?></td>
            <td style="font-weight:normal; text-align:left;"><?php echo $email  ?></td>
            <td style="font-weight:bolder; text-align:left;"><?php echo $ordertime  ?></td>
          </tr>
          <?php
                }
                ?>
        </table>
      </div>
    </body>