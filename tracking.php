<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');
 //calls the function
 $data = checkLogIn($conn);

//get the id from the link
$req_id= $_GET['id'];
$query = "SELECT * from request where req_id = '$req_id'";
// query the Db
$req = mysqli_query($conn, $query);

// fetch row selected for update from the DB
while($rows = mysqli_fetch_assoc($req)){

  // get data from the data base 
  $name = $rows['name'];
  $quant = $rows['quantity'];
  $email = $rows['email'];
  $amount = $rows['amount'];
  $meas = $rows['meas'];
  
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="..\images\icon.png" type="image/gif" sizes="16x16">
  <title>Request Update</title>
  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" href="stylewelcome.css">
  <script>

  </script>

</head>

<body>


  <!--nav abar section-->

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

      <body>

        <div class="column middle">
          <h1 class="lg-title" style="text-align: center; color:#ff0062;">UPDATE </h1>
          <form method="post" action="includes/requestUpdate.php">
          <input type="hidden" id="id" name="id" value="<?php echo $req_id ?> " />
            <label style="font-weight: bolder;  font-size:20px">Item</label>
            <input type="text" id="name" name="name" value="<?php echo $name ?> "
              style="font-weight: bolder; font-style:italic; font-size:15px" >
            <label style="font-weight: bolder;  font-size:20px">Quantity Delivered</label>
            <input type="text" id="qty" name="qty" value="<?php echo $quant ?> "
              style="font-weight: bolder; font-style:italic; font-size:15px" >
            <label style="font-weight: bolder;  font-size:20px">Supplier</label>
            <input type="text" id="sup" name="sup" value="<?php echo $email ?> "
              style="font-weight: bolder; font-style:italic; font-size:15px" >
              <input type="hidden" id="amount" name="amount" value="<?php echo $amount ?> "
              style="font-weight: bolder; font-style:italic; font-size:15px" >
              <input type="hidden" id="meas" name="meas" value="<?php echo $meas ?> "
              style="font-weight: bolder; font-style:italic; font-size:15px" >
          <label style="font-weight: bolder;  font-size:20px">Confirm Delivery</label>
            <select name="delv" id="delv" style="font-weight: bolder; font-style:italic; font-size:15px">
            <option value="">Choose Status</option>
              <option value="ordered">Ordered</option>
              <option value="recieved">Received</option>
            </select>
            <input type="submit" id="reqUp" name="reqUp" value="UPDATE" >
          </form>
        </div>
    </div>
  </body>

</html>