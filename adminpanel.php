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
  <title>Dashboard</title>
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
        <form id="searchbar" method="post" action="adminpanel.php" style="padding: 5%;">
          <input type="text" placeholder="Search by product name/category name..." name="search" style="width: 60%;">
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


    <!-- FILTER ORDERS -->
    <div class="column middle">
      <h1 class="lg-title" style="text-align: center; color:#ff0062;">SALES </h1>
      <form id="searchbar" method="get" action="adminpanel.php">

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
        // big M is for the month number
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
        $searchResult = "SELECT * FROM orders WHERE item_name LIKE '%$search%' OR time LIKE '%$search%' ";
        //execue the query

        $res = mysqli_query($conn, $searchResult);
        //count all the rows with the results
        $queryResults = mysqli_num_rows($res);


        //check for availabilty
        if ($queryResults > 0) {
      ?>
          <!-- get table header -->
          <h1 style="text-align: center; color:#ff0062;">Search Results</h1>
          <table id="orders" style="width: 100% !important; margin-left:0%;">
            <tr>
              <th>PRODUCT</th>
              <th>QUANTITY</th>
              <h1> </h1>
              <th>TOTAL AMOUNT PAID</th>
              <th>TIME ORDERED</th>
            </tr>
            <?php

            // while loop to fetch rows of resulting data
            while ($row = mysqli_fetch_assoc($res)) {
              //fetch all resulting data from the db
              $name = $row['item_name'];
              $quantity = $row['item_quantity'];
              $total = $row['order_total'];
              $time = $row['time'];
            ?>
              <tr>
                <!-- Displaying the resulting data -->
                <td><?php echo $name  ?> </td>
                <td><?php echo $quantity  ?></td>
                <td><?php echo $total ?></td>
                <td><?php echo $time  ?></td>

              </tr>
        <?php
            }
          } else {
            // Display an error Message
            echo "<div class='alert'>
               No records matching your search
               </div>";
          }
        }
        ?>


          </table>

          <?php
          // check if the year field is NOT empty  and the month field is empty
          // get the year that has been input

          if (!empty($_GET["year"]) && empty($_GET["month"])) {
            $searchYear = $_GET['year'];
            //query to get order based on the search keyword
            $searchResult = "SELECT * FROM orders WHERE time LIKE '%$searchYear%'";
            //execute the query
            $res = mysqli_query($conn, $searchResult);
            //count all the rows with the results
            $queryResults = mysqli_num_rows($res);
            //Get sum of column amount in search query
                //query to get order based on the search keyword
                $tAmtQuery = "SELECT SUM(order_total) FROM orders WHERE year(time) = $searchYear";
                $tAmt = mysqli_query($conn, $tAmtQuery);
            //check for availabilty
          ?>
            <!-- <table id="orders" style="width: 100% !important; margin-left:0%;">
  

  </tr> -->
            <?php
            if ($queryResults > 0) {
              $tAmt = 0;
           ?>
             <!-- get table header -->
             <h1 style="text-align: center; color:#ff0062;">Search Results</h1>
             <table id="orders" style="width: 100% !important; margin-left:0%;">
               <tr>
                 <th>PRODUCT</th>
                 <th>PRODUCT PRICE</th>
                 <th>QUANTITY</th>
                 <th>TOTAL AMOUNT PAID</th>
                 <th>TIME ORDERED</th>
               </tr>
               <?php
               // while loop to fetch rows of resulting data
               while ($row = mysqli_fetch_assoc($res)) {
                 //fetch all resulting data from the db
                 $email = $row['item_name'];
                 $amount = $row['item_price'];
                 $pickup = $row['item_quantity'];
                 $paymentCode = $row['order_total'];
                 $time = $row['time'];

                 $tAmt = $tAmt + (float) $paymentCode ;
                 // $status = $row['status'];
               ?>
                 <tr>
                   <td><?php echo $email  ?> </td>
                   <td><?php echo $amount  ?></td>
                   <td><?php echo $pickup ?></td>
                   <td><?php echo $paymentCode  ?></td>
                   <td><?php echo $time  ?></td>
                   
                 </tr>
                 
           <?php
               }
              
             } 
           //}
            
           ?>
          </br>
             <tr>
               <td colspan="5" style="font-weight: bolder;">
             Total: Ksh <?php echo $tAmt  ?>
           </td>
           </tr> 
           <?php
           }
  //           else {
  //            echo "<div class='alert'>
  // No records matching your search
  // </div>";
  //          }
           ?>
            </br>
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

                //Get sum of column amount in search query
                //query to get order based on the search keyword
                $tAmtQuery = "SELECT SUM(order_total) FROM orders WHERE  month(time) = $searchMonth and year(time) = $searchYear";
                $tAmt = mysqli_query($conn, $tAmtQuery);
              ?>

                <?php
                if ($queryResults > 0) {
                   $tAmt = 0;
                ?>
                  <!-- get table header -->
                  <h1 style="text-align: center; color:#ff0062;">Search Results</h1>
                  <table id="orders" style="width: 100% !important; margin-left:0%;">
                    <tr>
                      <th>PRODUCT</th>
                      <th>PRODUCT PRICE</th>
                      <th>QUANTITY</th>
                      <th>TOTAL AMOUNT PAID</th>
                      <th>TIME ORDERED</th>
                    </tr>
                    <?php
                    // while loop to fetch rows of resulting data
                    while ($row = mysqli_fetch_assoc($res)) {
                      //fetch all resulting data from the db
                      $email = $row['item_name'];
                      $amount = $row['item_price'];
                      $pickup = $row['item_quantity'];
                      $paymentCode = $row['order_total'];
                      $time = $row['time'];

                      $tAmt = $tAmt + (float) $paymentCode ;
                      // $status = $row['status'];
                    ?>
                      <tr>
                        <td><?php echo $email  ?> </td>
                        <td><?php echo $amount  ?></td>
                        <td><?php echo $pickup ?></td>
                        <td><?php echo $paymentCode  ?></td>
                        <td><?php echo $time  ?></td>
                        
                      </tr>
                      
                <?php
                    }
                   
                  } 
                //}
                 
                ?>
               </br>
                  <tr>
                    <td colspan="5" style="font-weight: bolder;">
                  Total: Ksh <?php echo $tAmt  ?>
                </td>
                </tr> 
                <?php
                }
      //            else {
      //             echo "<div class='alert'>
      //  No records matching your search
      //  </div>";
      //           }
                ?>
                
                  </table>
                  <h1 style="text-align: center; color:#ff0062;">All Records</h1>
                  <?php
                  $all = mysqli_num_rows($result);
                  echo ("Total Number of orders made: $all");
                  echo "</br>"
                  ?>
                  <table id="orders" style="width: 100% !important; margin-left:0%;">
                    <tr>
                      <th>PRODUCT NAME</th>
                      <th>QUANTITY</th>
                      <th>TOTAL AMOUNT</th>
                      <th>DATE</th>
                    </tr>
                    <?php
                    while ($rows = mysqli_fetch_assoc($result)) {
                      $name = $rows['item_name'];
                      $quantity = $rows['item_quantity'];
                      $total = $rows['order_total'];
                      $ordertime = $rows['time'];
                      // $email = $row['email'];
                    ?>
                      <tr>
                        <td><?php echo $name  ?> </td>
                        <td><?php echo $quantity  ?></td>
                        <td><?php echo $total  ?></td>
                        <td><?php echo $ordertime  ?></td>
                        <!-- <td><?php
                                  //echo $email  
                                  ?></td> -->
                      </tr>
                    <?php
                    }
                    ?>
                  </table>
    </div>


</body>
<!--  GET is used for viewing something, without changing it, while POST is used for changing something.  -->

</html>