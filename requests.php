<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
$data = checkLogIn($conn);

        $query = "SELECT * FROM `supplier` WHERE sup_email ='".$_SESSION['email']."' ";
        $result = mysqli_query($conn, $query);
       
        

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
  <title>Products upload</title>
  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" href="stylewelcome.css">
  <!-- <link rel ="stylesheet" href="style.css"/> -->

  <script defer src="js/cart.js"></script>

  <script>
    function validateProductUpload() {

          //   fetch input fields from the form 
      productName = document.getElementById("productName").value;
      productDescription = document.getElementById("productDescription").value;
      productPrice = document.getElementById("productPrice").value;
      uploadProduct = document.getElementById("uploadProduct");

      //Check for Empty Fields

      if (productUploadForm == "" || productName == "" || productDescription == "" || productPrice == "") {
        alert("You must fill all fields");

        return false;
      } else {
        return true;
        uploadProduct.submit();
      }
    }
  </script>
</head>

<body>
<p>Welcome 
    <?php
   echo $_SESSION['fname'];  ?>
   </p>

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

  <!--Admin panel side bar--->

  <div class="row">
    <div class="column side ">
    <div class="sidenav" style="height: 30%; padding: 18px; text-align:center; background-color: #808080">
    <a href="requests.php">Supplies</a><br>
        <a href="suppliers.php">Requests</a><br>
        <a href="supplyUpload.php">+ Supply Item</a><br>
        
        
      </div>
    </div>

    <!--End Admin panel side bar--->

    <div class="column middle ">
      <h1 class="lg-title"> SUPPLIES </h1>
        <table>
            <tr>
                <th>INGREDIENTS</th>
                <th>CATEGORY</th>
                <th>PRICE</th>
                <tr>
                <?php
                while ($rows = mysqli_fetch_assoc($result))
                    {
                ?>
                <tr>
                    <td><?php echo $rows['item_name']  ?></td>
                    <td><?php echo $rows['item_category']  ?></td>
                    <td><?php echo $rows['item_price']  ?></td>
                </tr>
                <?php
                    }
                   
                    ?>
        </table>
        
    </div>

    <div class="column side">
    
        
    
  </div>




</body>

</html>