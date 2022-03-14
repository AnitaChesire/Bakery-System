<?php
 session_start();

 include_once('includes/connection.php');
 include_once('includes/functions.php');

   //calls the function
 $data = checkLogIn($conn);

// display the requests of a particular supplier 
$query = "SELECT * FROM `request` WHERE email ='".$_SESSION['email']."' ";
$res = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
  <title>Suppliers</title>
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

      <!-- void 0 so the browser returns nothing  -->
      <!-- void(0) means, do nothing - don't reload, don't navigate, do not run any code. -->
    <li class="dropdown" style="float:right">
      <a href="javascript:void(0)" class="dropbtn"><?php
   echo $_SESSION['fname'];  ?></a>
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
    elseif($_SESSION['user_id'] == 3){
        ?>
        <a href="suppliers.php">Supplier</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
        <?php
    }
    else{
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
      <div class="sidenav" style="height: 30%; padding: 18px; text-align:center; background-color: #808080">
        <!-- <form id="searchbar" method="post" action="adminpanel.php" style="padding: 5%;">
          <input type="text" placeholder="Search by product name/category name..." name="search" style="width: 60%;">
          <button type="submit" style="width: 30%;">Submit</button>
        </form> -->
        <a href="requests.php">Supplies</a><br>
        <a href="suppliers.php">Requests</a><br>
        <a href="supplyUpload.php">+ Supply Item</a><br>
        
      </div>
    </div>


    <!-- FILTER ORDERS -->
    <div class="column middle">
      <h1 class="lg-title" style="text-align: center; color:#ff0062;">SUPPLIER PORTAL </h1>
      <h1 style="text-align: center; color:indianred; font-size:28px">Requests</h1>
      <!-- <form id="searchbar" method="get" action="adminpanel.php">
        <input type="text" placeholder="Enter year ..." name="year" style="width: 30%;">
        <input type="text" placeholder="Search by month..." name="month" style="width: 30%;">
        <button type="submit" style="width: 30%;">Submit</button>
      </form> -->
      <?php


      ?>
      <table>
       <tr>
         <th>ITEM</th>
         <th>QUANTITY</th>
         <!-- <th>ITEM</th> -->
       </tr>
       <?php
      //  while loop to fetch the rows from the database
      while($rows = mysqli_fetch_assoc($res)){

      ?>
       <tr>
         <td><?php echo $rows['name'] ?></td>
         <td><?php echo $rows['quantity'] ?><?php echo $rows['meas'] ?></td>
         <td></td>
         
       </tr>
        <?php
      }
      ?>
      </table>
      <?php

// $all = mysqli_num_rows($result);
//       echo("Total Number of orders made: $all");

// // date() function will return the current Year 
// // Y? y?
//       $dtNow = date("Y");
//       /**
//        * Validation
//        */

//       //Year should be past the current year
//       if(!empty($_GET["year"])){
//           if($_GET["year"] > $dtNow){
//             echo "Year should be less than or equal to $dtNow";
            
//           }
//         }
      
//       if(isset ($_POST["search"])){
//        $search = $_POST['search'];

//         //query to get order based on the search keyword
//         $searchResult = "SELECT * FROM orders WHERE item_name LIKE '%$search%' OR time LIKE '%$search%' ";
//         //execue the query

//         $res = mysqli_query($conn, $searchResult);
//         //count all the rows with the results
//         $queryResults = mysqli_num_rows($res);
        
//         //check for availabilty
//         if ($queryResults > 0) {
//           ?>
           <!-- get table header -->
<!-- //     <table id="orders" style="width: 100% !important; margin-left:0%;">
//       <tr>
//         <th>PRODUCT</th>
//         <th>QUANTITY</th>
//         <th>TOTAL AMOUNT PAID</th>
//         <th>TIME ORDERED</th>
//       </tr> -->
      <?php
//       // while loop to fetch rows of resulting data
//       while ($row = mysqli_fetch_assoc($res)) {
//         //fetch all resulting data from the db
//         $name = $row['item_name'];
//         $quantity = $row['item_quantity'];
//         $total = $row['order_total'];    
//         $time = $row['time'];   
//         // $status = $row['status'];
//     ?>
       <tr>
         <!-- Displaying the resulting data -->
         <td><?php //echo $name  ?> </td>
        <td><?php //echo $quantity  ?></td>
         <td><?php //echo $total ?></td>
        <td><?php //echo $time  ?></td>
        
       </tr>
         <?php
// }

//        }
//       else {
//         // Display an error Message
//         echo "<div class='alert'>
//                No records matching your search
//                </div>";
//        }
//     }
// //     ?>
<!-- // //       </br>
// /     </table>
               -->
 <?php
// // check if the year field is NOT empty  and the month field is empty
// // get the year that has been input

// if(!empty($_GET["year"]) && empty($_GET["month"])){
//   $searchYear = $_GET['year'];
//   //query to get order based on the search keyword
//   $searchResult = "SELECT * FROM orders WHERE time LIKE '%$searchYear%'";
//   //execute the query
//   $res = mysqli_query($conn, $searchResult);
//   //count all the rows with the results
//   $queryResults = mysqli_num_rows($res);
//   //check for availabilty?>
    <!-- <table id="orders" style="width: 100% !important; margin-left:0%;">
  

//   </tr> -->
   <?php
//    if ($queryResults > 0) {
//     ?>
     <!-- get table header -->
<!-- // <table id="orders" style="width: 100% !important; margin-left:0%;">
// <tr>
//   <th>PRODUCT</th>
//   <th>PRODUCT PRICE</th>
//   <th>QUANTITY</th>
//   <th>TOTAL AMOUNT PAID</th>
//   <th>TIME ORDERED</th>
// </tr> -->
 <?php
// // while loop to fetch rows of resulting data
// while ($row = mysqli_fetch_assoc($res)) {
//   //fetch all resulting data from the db
//   $email = $row['item_name'];
//   $amount = $row['item_price'];
//   $pickup = $row['item_quantity'];
//   $paymentCode = $row['order_total'];    
//   $time = $row['time'];   
//   // $status = $row['status'];
// ?>
 <tr>
   <td><?php //echo $email  ?> </td>
   <td><?php //echo $amount  ?></td>
   <td><?php //echo $pickup ?></td>
   <td><?php //echo $paymentCode  ?></td>
   <td><?php //echo $time  ?></td>
  
 </tr>
   <?php
// }

//  }
// else {
//   echo "<div class='alert'>
//          No records matching your search
//          </div>";
//  }
// }
// ?>
<!-- // </br>
// </table>
        
// <?php 

// if(!empty($_GET["month"]) && !empty($_GET["year"])){
//   $searchYear = $_GET['year']; 
//   $searchMonth = $_GET['month'];
//   //query to get order based on the search keyword
//   $searchResult = "SELECT * FROM orders WHERE  month(time) = $searchMonth and year(time) = $searchYear";
//   //execute the query

//   $res = mysqli_query($conn, $searchResult);

//   //count all the rows with the results
//   $queryResults = mysqli_num_rows($res);
//   //check for availabilty?>
  
   <?php
//    if ($queryResults > 0) {
//     ?>
      get table header -->
<!-- // <table id="orders" style="width: 100% !important; margin-left:0%;">
// <tr>
//   <th>PRODUCT</th>
//   <th>PRODUCT PRICE</th>
//   <th>QUANTITY</th>
//   <th>TOTAL AMOUNT PAID</th>
//   <th>TIME ORDERED</th>
// </tr> -->
 <?php
// // while loop to fetch rows of resulting data
// while ($row = mysqli_fetch_assoc($res)) {
//   //fetch all resulting data from the db
//   $email = $row['item_name'];
//   $amount = $row['item_price'];
//   $pickup = $row['item_quantity'];
//   $paymentCode = $row['order_total'];    
//   $time = $row['time'];   
//   // $status = $row['status'];
// ?>
 <tr>
   <td><?php //echo $email  ?> </td>
   <td><?php //echo $amount  ?></td>
   <td><?php //echo $pickup ?></td>
   <td><?php //echo $paymentCode  ?></td>
   <td><?php //echo $time  ?></td>
  
 </tr>
   <?php
// }

//  }
// else {
//   echo "<div class='alert'>
//          No records matching your search
//          </div>";
//  }
// }
// ?>
 </br>
<!-- // </table>

//       <table id="orders" style="width: 100% !important; margin-left:0%;">
//         <tr>
//           <th>PRODUCT NAME</th>
//           <th>QUANTITY</th>
//           <th>TOTAL AMOUNT</th>
//           <th>DATE</th>
         <th>EMAIL</th> -->


         </tr>

         <?php
//         while ($rows = mysqli_fetch_assoc($result)) {
//            $name = $rows['item_name'];
//             $quantity = $rows['item_quantity'];
//             $total = $rows['order_total'];
//             $ordertime = $rows['time'];
//             // $email = $row['email'];
          
//         ?>

<tr>
           <td><?php //echo $name  ?> </td>
           <td><?php // echo $quantity  ?></td>
           <td><?php //echo $total  ?></td>
           <td><?php //echo $ordertime  ?></td>
           <!-- <td><?php 
               //echo $email  ?></td> -->
         </tr>
        </br>
         <?php
       // }
     
      
//         ?>


      </table>

    </div>


</body>
<!--  GET is used for viewing something, without changing it, while POST is used for changing something.  -->
</html>
