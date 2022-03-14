<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

//calls the function
$data = checkLogIn($conn);

$query = "SELECT * FROM request";
$result = mysqli_query($conn, $query);



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
  <title>Requests</title>
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
    <div class="column side">
      <div class="sidenav">
        <form id="searchbar" method="post" action="requestview.php" style="margin: 5%;">
          <input type="text" placeholder="Enter name or email ..." name="search" style="width: 60%;">
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

    <body>

      <!-- FILTER ORDERS -->
      <!-- overflow specifies what should happen to elements if they dont fit into the specified area
      auto adds a scrollbar if neccessary -->
      <div class="column middle" style="overflow: auto !important">
        <h1 style="text-align: center; color:#ff0062;">REQUESTS</h1>
        <form id="searchbar" method="get" action="requestview.php">

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


        // date() function will return the current Year 
        // Y? gets all the four digits of the current year 
        //  y? gets the last two digits of the current year
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
          $searchResult = "SELECT * FROM request WHERE email LIKE '%$search%' OR name LIKE '%$search%' OR status LIKE '%$search%'";
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
                <th>ITEM</th>
                <th>QUANTITY</th>
                <th>SUPPLIER</th>
                <th>TIME</th>
                <th>UPDATE</th>

              </tr>
              <?php
              while ($row = mysqli_fetch_assoc($res)) {
                //fetch all resulting data from the db
                $name = $row['name'];
                $quant = $row['quantity'];
                $meas = $row['meas'];
                $email = $row['email'];
                $time = $row['time'];

              ?>
                <!-- display the search results -->
                <tr>
                  <td><?php echo $name  ?> </td>
                  <td><?php echo $quant ?><?php echo $meas  ?></td>
                  <td><?php echo $email ?></td>
                  <td><?php echo $time ?></td>
                  <!-- UPDATING AN ORDER IS TO PROGRESS ITS TRACKING  -->
                  </td>
                          <td><button type="submit" onclick="document.location='tracking.php?id=<?php echo $rows['req_id']; ?>'">Update</button>
                  </td>
                </tr>
          <?php
              }
            } else {
              // display an error message
              echo "<div class='alert'>
               No records matching your search
               </div>";
            }
          }
          ?>
</br>
            </table>
            </br>
            <?php
            // check if the year field is NOT empty  and the month field is empty
            // get the year that has been input

            if (!empty($_GET["year"]) && empty($_GET["month"])) {
              $searchYear = $_GET['year'];
              //query to get order based on the search keyword
              $searchResult = "SELECT * FROM request WHERE time LIKE '%$searchYear%'";
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
                    <th>ITEM</th>
                    <th>QUANTITY</th>
                    <th>SUPPLIER</th>
                    <th>TIME</th>
                    <th>UPDATE</th>

                  </tr>
                  <?php
                  while ($row = mysqli_fetch_assoc($res)) {
                    //fetch all resulting data from the db
                    $name = $row['name'];
                    $quant = $row['quantity'];
                    $meas = $row['meas'];
                    $email = $row['email'];
                    $time = $row['time'];

                  ?>
                    <!-- display the search results -->
                    <tr>
                      <td><?php echo $name  ?> </td>
                      <td><?php echo $quant ?><?php echo $meas  ?></td>
                      <td><?php echo $email ?></td>
                      <td><?php echo $time ?></td>
                      <!-- UPDATING AN ORDER IS TO PROGRESS ITS TRACKING  -->
                      </td>
                          <td><button type="submit" onclick="document.location='tracking.php?id=<?php echo $rows['req_id']; ?>'">Update</button>

                      </td>
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

                if (!empty($_GET["month"]) && !empty($_GET["year"])) {
                  $searchYear = $_GET['year'];
                  $searchMonth = $_GET['month'];
                  //query to get order based on the search keyword
                  $searchResult = "SELECT * FROM request WHERE  month(time) = $searchMonth and year(time) = $searchYear";
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
                        <th>ITEM</th>
                        <th>QUANTITY</th>
                        <th>SUPPLIER</th>
                        <th>TIME</th>
                        <th>UPDATE</th>

                      </tr>
                      <?php
                      while ($row = mysqli_fetch_assoc($res)) {
                        //fetch all resulting data from the db
                        $name = $row['name'];
                        $quant = $row['quantity'];
                        $meas = $row['meas'];
                        $email = $row['email'];
                        $time = $row['time'];

                      ?>
                        <!-- display the search results -->
                        <tr>
                          <td><?php echo $name  ?> </td>
                          <td><?php echo $quant ?><?php echo $meas  ?></td>
                          <td><?php echo $email ?></td>
                          <td><?php echo $time ?></td>
                          <!-- UPDATING AN ORDER IS TO PROGRESS ITS TRACKING  -->
                          </td>
                          <td><button type="submit" onclick="document.location='tracking.php?id=<?php echo $rows['req_id']; ?>'">Update</button>

                          </td>
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

                    <!-- table containing the requests -->
                    <h1 style="text-align: center; color:#ff0062;">All Records</h1>
                    <table id="orders" style="width: 100% !important; margin-left:0%; ">
                      <tr>
                        <th>ITEM</th>
                        <th>QUANTITY</th>
                        <th>SUPPLIER</th>
                        <th>TIME</th>
                        <th>STATUS</th>
                        <th>UPDATE</th>

                      </tr>

                      <?php
                      while ($rows = mysqli_fetch_assoc($result)) {

                      ?>

                        <tr>
                          <td><?php echo $rows['name']  ?> </td>
                          <td><?php echo $rows['quantity']  ?><?php echo $rows['meas']  ?></td>
                          <td><?php echo $rows['email']  ?>
                          <td><?php echo $rows['time']  ?>
                          <td><?php echo $rows['status']  ?>
                            <!-- update the state of the request  -->
                          </td>
                          <td><button type="submit" onclick="document.location='tracking.php?id=<?php echo $rows['req_id']; ?>'">Update</button>

                        </tr>
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