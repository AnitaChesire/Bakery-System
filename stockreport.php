<?php
  session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
$data = checkLogIn($conn);

        $query = "SELECT * FROM stock ";
        $result = mysqli_query($conn, $query);
        
        // Making a stock request

        if(isset($_POST['requestIng'])){

            // fetch input fields from the form 
          $name = $_POST['ingrd'];
          $ingrdAmt = $_POST['ingrdAmt'];
          $quantityIng = $_POST['quantityIng'];
          $ingrdMeas = $_POST['ingrdMeas'];
          
          
          $totalStock = ($ingrdAmt + $quantityIng);

          // insert nto the the database 
          $sql = "INSERT INTO `request`(`name`, `amount`, `quantity`, `meas`, `total`) 
          VALUES('$name', '$ingrdAmt', '$quantityIng', '$ingrdMeas', '$totalStock');";

          mysqli_query($conn, $sql);
          header("location: stock.php?request=successful");
          
        }
        
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Baking Essentials</title>
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
      <li class="cart"><a href="mycart.php">Cart </a></li>

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



    <body>

      <!--Admin panel side bar--->
      <div class="row">
        <div class="column side ">
          <div class="sidenav">
          <div>
              <!-- search form  -->
          <form id="searchbar" method="post" action="stockreport.php" style="margin: 5%;">
            <input type="text" placeholder="Enter type/name ..." name="search" style="width: 60%;">
            <button type="submit" style="width: 30%;">Submit</button>
          </form>
        </div>
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

        <div class="column middle" style="overflow: auto !important">
          <!-- <div id="myingredients" class="tabcontent"> -->
            <h1 class="lg-title" style="text-align: center; color:#ff0062;"> BAKING ESSENTIALS REPORT </h1>
            <div id="productImage">
           
        </div>
     
            <div id="reportTable2">
            <?php

            if(isset ($_POST["search"])){
            $search = $_POST['search'];

            //query to get order based on the search keyword
            $searchResult = "SELECT * FROM stock WHERE type LIKE '%$search%' OR name LIKE '%$search%' ";
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
                  <th style="font-weight:bolder; text-align:left;">ITEM</th>
                  <th style="font-weight:bolder; text-align:left;">TYPE</th>
                  <th style="font-weight:bolder; color:red; text-align:right;">AVAILABLE STOCK</th>
                  <th style="font-weight:bolder; text-align:left;">STANDARDS OF MEASURE</th>
                  <th style="font-weight:bolder; text-align:center;">UPDATE</th>
                </tr>
                <?php
              while ($row = mysqli_fetch_assoc($res)) {
                //fetch all resulting data from the db
                $name = $row['name'];
                $type = $row['type'];
                $amount = $row['amount'];
                $meas = $row['measure'];
            
            ?>
        <!-- display the search results -->
        <tr>
          <td><?php echo $name  ?> </td>
          <td><?php echo $type ?></td>
          <td><?php echo $amount  ?></td>
          <td><?php echo $meas ?></td>
          <td><?php //echo $email ?></td>
          <!-- UPDATING AN ORDER IS TO PROGRESS ITS TRACKING  -->
          <td><button style="margin-left: 5%;" type="submit"
           onclick="document.location='stockRequest.php?id=<?php echo $rows['stock_id']; ?>'">REQUEST</button></td>
                  
                    </tr>
            
                    
        <?php
}

       }
      else {
        echo "<div class='alert'>
               No records matching your search
               </div>";
       }
    }
    ?>
    </table>
      <br><br>
                        
              <table>
                <tr>
                  <th style="font-weight:bolder; text-align:left;">ITEM</th>
                  <th style="font-weight:bolder; text-align:left;">TYPE</th>
                  <th style="font-weight:bolder; color:red; text-align:right;">AVAILABLE STOCK</th>
                  <th style="font-weight:bolder; text-align:left;">STANDARDS OF MEASURE</th>
                  <th style="font-weight:bolder; text-align:center;">UPDATE</th>
                </tr>
                <?php
                while ($rows = mysqli_fetch_assoc($result))
                    {
                ?>
                <tr>
                    <td style="text-align:left;" name ="ingrd"><?php echo $rows['name']  ?></td>
                    <td style="text-align:left;" ><?php echo $rows['type']  ?></td>
                    <td style="font-weight:bolder; color:red; text-align:right;" name ="ingrdAmt"><?php echo $rows['amount']  ?></td>
                     <td style="font-weight:bolder; color:green; text-align:left;" name ="ingrdMeas"><?php echo $rows['measure']  ?></td>
                     <td><button style="margin-left: 5%;" type="submit"
                      onclick="document.location='stockRequest.php?id=<?php echo $rows['stock_id']; ?>'">REQUEST</button></td>
                  
                </tr>
                <?php
                    }
                    ?>
                
              </table>
            </div>
          </div>

          
          </div>
        </div>
        <div class="column side">
          <!-- <button style="width:100% !important" class="tablink" onclick="openPage('myingredients', this, '#ff0062')" id="defaultOpen">INGREDIENTS
          <button style="width:100% !important" class="tablink" onclick="openPage('myflavours', this, '#ff0062')">FLAVOURS
             -->
        </div>
    </body>

  </html>
  

