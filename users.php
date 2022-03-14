<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

//calls the function
$data = checkLogIn($conn);

$query = "SELECT * FROM orderscustom ORDER BY `order_id` DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
  <title>Users</title>
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
        <div>
          <form id="searchbar" method="post" action="users.php" style="margin: 5%;">
            <input type="text" placeholder="Search by upload time/product name ..." name="search" style="width: 60%;">
            <button type="submit" name="searchO" style="width: 30%;">Submit</button>
          </form>
        </div>
        <br></br></br>
        <a href="adminpanel.php">Dashboard</a><br>
        <a href="categories.php">Categories</a><br>
        <a href="categoryupload.php">Add Category</a><br>
        <a href="productupload.php">Add Product </a><br>
        <a href="orders.php">Orders</a><br>
        <a href="reports.php">Users' Report</a><br>
        <a href="suggestionview.php">Suggestions</a><br>
        <a href="users.php">Custom Orders</a><br>
        <a href="stock.php">Stock</a><br>
        <a href="supplierview.php">Suppliers</a><br>
        <a href="requestview.php">Requests</a><br>
        <a href="stockreport.php">Baking Essentials</a><br>

      </div>
    </div>

    <body>

      <!-- FILTER ORDERS -->
      <!-- overflow specifies what should happen to elements if they dont fit into the specified area
      auto adds a scrollbar if neccessary -->
      <div class="column middle" style="overflow: auto !important">
        <h1 style="text-align: center; color:#ff0062;">CUSTOM ORDERS</h1>
        <form id="searchbar" method="get" action="users.php">

          <?php
          // current year variable
          $year = date("Y");
          echo '<select name="year" id="year" style="width: 30%;">';
          echo '<option value="year">Choose Year</option>';
          // variable for the first year in the range 
          $new = 2018;
          // while loop where while 2018 is less than or equal to the current year..
          while ($new <= $year) {
            // in the dropdown create an option value 
            echo "<option value='$new'>" . $new . "</option>";
            // this option value is a +1 of the 2018 variable
            $new++;
          }
          // close select
          echo '</select>';
          ?>

          <?php
          // current year variable
          //  small m is for the month name
          // big Mis for the month number
          $month = date("m");
          echo '<select name="month" id="month" style="width: 30%;">';
          echo '<option value="">Choose month</option>';
          // variable for the first month in the range 
          $neww = 1;
          // while loop where while 1 is less than or equal to the current month..
          while ($neww <= $month) {
            // in the dropdown create an option value 
            echo "<option value='$neww'>" . $neww . "</option>";
            // this option value is a +1 of the $neww variable
            $neww++;
          }
          // close select
          echo '</select>';
          ?>

          <button type="submit" style="width: 30%;">Submit</button>
        </form>
        <?php
        // date() function will return the current Year 
        // y returns the last two digits of that year 
        //  Y returns all digits of the year
        $dtNow = date("Y");
        /**
         * Validation
         */

        //Year shouldnt be past the current year
        if (!empty($_GET["year"])) {
          if ($_GET["year"] > $dtNow) {
            echo "Year should be less than or equal to $dtNow";
          }
        }

        if (isset($_POST["search"])) {
          $search = $_POST['search'];
          //query to get order based on the search keyword
          $searchResult = "SELECT * FROM orderscustom WHERE email LIKE '%$search%' OR product_name LIKE '%$search%' 
            OR quantity LIKE '%$search%' OR payment_code LIKE '%$search%'";
          //execue the query
          $res = mysqli_query($conn, $searchResult);
          //count all the rows with the results
          $queryResults = mysqli_num_rows($res);
          //check for availabilty
          if ($queryResults > 0) {
            // create table headers
        ?>
            <table id="orders" style="width: 100% !important; margin-left:0%;">
              <tr>
                <th>EMAIL</th>
                <th>PRODUCT </th>
                <th>QUANTITY</th>
                <th>DESCRIPTION</th>
                <th>PICK-UP </th>
                <th> AMOUNT</th>
                <th>PAYMENT CODE</th>
                <th>TIME ORDERED</th>

              </tr>
              <?php
              while ($row = mysqli_fetch_assoc($res)) {
                //fetch all resulting data from the db
                $email = $row['email'];
                $product = $row['product_name'];
                $quant = $row['quantity'];
                // $cust = $row['product_customization']; 
                $desc = $row['product_description'];
                $pickup = $row['pickup_location'];
                $totalAmount = $row['total_amount'];
                $paymentCode = $row['payment_code'];
                $time = $row['time'];
                // $status = $row['status'];

              ?>
                <!-- display the search results -->
                <tr>
                  <td><?php echo $email  ?> </td>
                  <td><?php echo $product  ?></td>
                  <td><?php echo $quant ?></td>
                  <td><?php echo $desc  ?> </td>
                  <td><?php echo $pickup ?></td>
                  <td><?php echo $totalAmount  ?></td>
                  <td><?php echo $paymentCode  ?></td>
                  <td><?php echo $time  ?></td>
                  <!-- <td><input id="text" type="text" name="text" /></td> -->
                  <!-- UPDATING AN ORDER IS TO PROGRESS ITS TRACKING  -->
                  <!-- <td><button type="submit" onclick="document.location='tracking.php'">Update</button> -->
                  <!-- <a href="orders.php?action=delete&id=<?php echo $values["product_id"]; ?>" <span
                    class="text-danger">Delete</span></a></td> -->
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
          </br>
            </table>
            <?php

            // check if the year field is NOT empty  and the month field is empty
            // get the year that has been input

            if (!empty($_GET["year"]) && empty($_GET["month"])) {
              $searchYear = $_GET['year'];
              //query to get order based on the search keyword
              $searchResult = "SELECT * FROM orderscustom WHERE time LIKE '%$searchYear%'";
              //execute the query
              $res = mysqli_query($conn, $searchResult);
              //count all the rows with the results
              $queryResults = mysqli_num_rows($res);
              //check for availabilty
            ?>
              <!-- <table id="orders" style="width: 100% !important; margin-left:0%;">
  

  </tr> -->
              <?php
              if ($queryResults > 0) {
              ?>
                <!-- get table header -->
                <h1 style="text-align: center; color:#ff0062;">Search Results</h1>

                <table id="orders" style="width: 100% !important; margin-left:0%;">
                  <tr>
                    <th>EMAIL</th>
                    <th>PRODUCT </th>
                    <th>QUANTITY</th>
                    <th>DESCRIPTION</th>
                    <th>PICK-UP </th>
                    <th> AMOUNT</th>
                    <th>PAYMENT CODE</th>
                    <th>TIME ORDERED</th>

                  </tr>
                  <?php
                  // while loop to fetch rows of resulting data
                  while ($row = mysqli_fetch_assoc($res)) {
                    //fetch all resulting data from the db
                    $email = $row['email'];
                    $product = $row['product_name'];
                    $quant = $row['quantity'];
                    // $cust = $row['product_customization']; 
                    $desc = $row['product_description'];
                    $pickup = $row['pickup_location'];
                    $totalAmount = $row['total_amount'];
                    $paymentCode = $row['payment_code'];
                    $time = $row['time'];
                    // $status = $row['status'];

                  ?>
                    <!-- display the search results -->
                    <tr>
                      <td><?php echo $email  ?> </td>
                      <td><?php echo $product  ?></td>
                      <td><?php echo $quant ?></td>
                      <td><?php echo $desc  ?> </td>
                      <td><?php echo $pickup ?></td>
                      <td><?php echo $totalAmount  ?></td>
                      <td><?php echo $paymentCode  ?></td>
                      <td><?php echo $time  ?></td>
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
              </br>
                </table>

                <?php

                if (!empty($_GET["month"]) && !empty($_GET["year"])) {
                  $searchYear = $_GET['year'];
                  $searchMonth = $_GET['month'];
                  //query to get order based on the search keyword
                  $searchResult = "SELECT * FROM orderscustom WHERE  month(time) = $searchMonth and year(time) = $searchYear";
                  //execute the query

                  $res = mysqli_query($conn, $searchResult);

                  //count all the rows with the results
                  $queryResults = mysqli_num_rows($res);
                  //check for availabilty
                ?>

                  <?php
                  if ($queryResults > 0) {
                  ?>
                    <!-- get table header -->
                    <h1 style="text-align: center; color:#ff0062;">Search Results</h1>
                    <table id="orders" style="width: 100% !important; margin-left:0%;">
                      <tr>
                    <th>EMAIL</th>
                    <th>PRODUCT </th>
                    <th>QUANTITY</th>
                    <th>DESCRIPTION</th>
                    <th>PICK-UP </th>
                    <th> AMOUNT</th>
                    <th>PAYMENT CODE</th>
                    <th>TIME ORDERED</th>
                      </tr>
                      <?php
                      // while loop to fetch rows of resulting data
                      while ($row = mysqli_fetch_assoc($res)) {
                        //fetch all resulting data from the db
                        $email = $row['email'];
                        $product = $row['product_name'];
                        $quant = $row['quantity'];
                        // $cust = $row['product_customization']; 
                        $desc = $row['product_description'];
                        $pickup = $row['pickup_location'];  
                        $totalAmount = $row['total_amount'];
                        $paymentCode = $row['payment_code'];     
                        $time = $row['time'];   
                        // $status = $row['status'];
                    
                    ?>
                <!-- display the search results -->
                <tr>
                  <td><?php echo $email  ?> </td>
                  <td><?php echo $product  ?></td>
                  <td><?php echo $quant ?></td>
                  <td><?php echo $desc  ?> </td>
                  <td><?php echo $pickup ?></td>
                  <td><?php echo $totalAmount  ?></td>
                  <td><?php echo $paymentCode  ?></td>
                  <td><?php echo $time  ?></td>
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
                  </br>
                    </table>
                    <h1 style="text-align: center; color:#ff0062;">All Records</h1>
                    <table id="orders" style="width: 100% !important; margin-left:0%;">
                      <tr>
                        <th>EMAIL</th>
                        <th>PRODUCT </th>
                        <th>QUANTITY</th>
                        <th>DESCRIPTION</th>
                        <th>PICK-UP </th>
                        <th> AMOUNT</th>
                        <th>PAYMENT CODE</th>
                        <th>TIME ORDERED</th>
                      </tr>
                      <?php
                      while ($rows = mysqli_fetch_assoc($result)) {
                      ?>
                        <tr>
                          <td><?php echo $rows['email']  ?> </td>
                          <td><?php echo $rows['product_name']  ?></td>
                          <td><?php echo $rows['quantity']  ?></td>
                          <!-- <td><?php
                                    // echo $rows['product_customization']  
                                    ?></td> -->
                          <td><?php echo $rows['product_description']  ?> </td>
                          <td><?php echo $rows['pickup_location']  ?></td>
                          <td><?php echo $rows['total_amount']  ?></td>
                          <td><?php echo $rows['payment_code']  ?></td>
                          <td><?php echo $rows['time']  ?></td>
                          <!-- <td><input id="text" type="text" name="text" /></td> -->
                          <!-- UPDATING AN ORDER IS TO PROGRESS ITS TRACKING  -->
                          <!-- <td><button type="submit">Update</button><button type="submit">Delete</button></td> -->
                        </tr>
                      <?php
                      }
                      ?>
                      <?php
                      if (isset($_POST["year"])) {
                        $searchYear = $_POST['year'];
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
                            <th>EMAIL</th>
                            <th>PRODUCT </th>
                            <th>QUANTITY</th>
                            <th>DESCRIPTION</th>
                            <th>PICK-UP </th>
                            <th> AMOUNT</th>
                            <th>PAYMENT CODE</th>
                            <th>TIME ORDERED</th>

                          </tr>
                          <?php
                          if ($queryResults > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                              //fetch all resulting data from the db
                              $email = $row['email'];
                              $product = $row['product_name'];
                              $quant = $row['quantity'];
                              // $cust = $row['product_customization']; 
                              $desc = $row['product_description'];
                              $pickup = $row['pickup_location'];
                              $totalAmount = $row['total_amount'];
                              $paymentCode = $row['payment_code'];
                              $time = $row['time'];

                          ?>
                              <!-- display the search results -->
                              <tr>
                                <td><?php echo $email  ?> </td>
                                <td><?php echo $product  ?></td>
                                <td><?php echo $quant ?></td>
                                <td><?php echo $desc  ?> </td>
                                <td><?php echo $pickup ?></td>
                                <td><?php echo $totalAmount  ?></td>
                                <td><?php echo $paymentCode  ?></td>
                                <td><?php echo $time  ?></td>
                              </tr><br>
                            <?php
                            } ?>
                        </table>
                    <?php
                          } else {
                            echo "<div class='alert'>
            No records matching your search
            </div>";
                          }
                        }

                    ?>
                    <?php
                    if (isset($_POST["month"])) {
                      $searchYear = $_POST['year'];
                      $searchMonth = $_POST['month'];
                      //query to get order based on the search keyword
                      $searchResult = "SELECT * FROM orders WHERE  month(time) = $searchMonth and year(time) = $searchYear";
                      //execute the query

                      $res = mysqli_query($conn, $searchResult);
                      //count all the rows with the results
                      $queryResults = mysqli_num_rows($res);
                      //check for availabilty
                    ?>
                      </br>
                      <table id="orders" style="width: 100% !important; margin-left:0%;">
                        <tr>
                          <th>PRODUCT NAME</th>
                          <th>QUANTITY</th>
                          <th>TOTAL AMOUNT</th>
                          <th>DATE</th>
                          <!-- <th>EMAIL</th> -->
                        </tr>
                        <?php
                        if ($queryResults > 0) {
                          while ($row = mysqli_fetch_assoc($res)) {
                            //fetch all resulting data from the db
                            $name = $row['item_name'];
                            $totalAmount = $row['item_quantity'];
                            $paymentCode = $row['item_price'];
                            $ordertime = $row['time'];
                            // $email = $row['email'];
                        ?>
                            <tr>
                              <td><?php echo $name  ?> </td>
                              <td><?php echo $totalAmount  ?></td>
                              <td><?php echo $paymentCode  ?></td>
                              <td><?php echo $ordertime  ?></td>
                              <!-- <td><?php
                                        // echo $email  
                                        ?></td> -->
                            </tr><br>
                          <?php
                          } ?>
                      </table>
                  <?php
                        } else {
                          echo "<div class='alert'>
            No records matching your search
            </div>";
                        }
                      }
                  ?>
                  <table id="orders" style="width: 100% !important; margin-left:0%;">
                    <tr>
                      <th>PRODUCT NAME</th>
                      <th>QUANTITY</th>
                      <th>TOTAL AMOUNT</th>
                      <th>DATE</th>
                      <!-- <th>EMAIL</th> -->
                    </tr>
                    <?php
                    while ($rows = mysqli_fetch_assoc($result)) {
                      $name = $rows['item_name'];
                      $totalAmount = $rows['item_quantity'];
                      $paymentCode = $rows['item_price'];
                      $ordertime = $rows['time'];
                      // $email = $row['email'];
                    ?>
                      <tr>
                        <td><?php echo $name  ?> </td>
                        <td><?php echo $totalAmount  ?></td>
                        <td><?php echo $paymentCode  ?></td>
                        <td><?php echo $ordertime  ?></td>
                        <!-- <td><?php
                                  //echo $email  
                                  ?></td> -->
                      </tr>
                      </br>
                    <?php
                    }
                    ?>
                  </table>
      </div>
      <div class="column side">
      </div>
  </div>
</body>

</html>