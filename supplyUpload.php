<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
$data = checkLogIn($conn);

$queryIng = "SELECT * FROM stock WHERE type = 'ingredient' ";
        $resultIng = mysqli_query($conn, $queryIng);
        $queryFla =  "SELECT * FROM stock WHERE type = 'flavour' ";
        $resultFla = mysqli_query($conn, $queryFla);
        

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
      <h1 class="lg-title"> ADD A PRODUCT YOU SUPPLY </h1>
      <form id="uploadProduct" onsubmit=" return validateProductUpload()" method="post" action="supplyUpload.php" >
        <div id="productUploadForm"></div>
        <div id="productImage">
        <h2> Supply categories are either an Ingredient or Flavour </h2>
        <h3 style="text-align: center; color:green;">An ingredient is an Essential for baking</h3>
        <h3 style="text-align: center; color:green;">A flavour is used to give a flavour to the product</h3>

          <p>Item Name</p>
          <input id="itemName" name="itemName" type="text" />

            <p>Category</p>
            <select id="itemCategory" name="itemCategory">
            <option value="">Select</option></br>
              <option value="ingredient">Ingredient</option></br>
              <option value="flavour ">Flavour</option></br>
                </select>
            <br>
            <p>Price per standard measure</p>
            <input id="itemPrice" name="itemPrice" type="text" placeholder="Enter your proposed pricing of the item"/>
            <br>
            <input type="submit" name="supplyUp" value="Upload">
        </div>
      </form>
    </div>

    <div class="column side" style="overflow: auto !important">
    <h1 class="lg-title" style="text-align: center; color:green; font-style:italic"> BAKERY SUPPLY GUIDE </h1>
    <!-- FILTER FOR USERS -->
    <form id="searchbar" method="post" action="supplyUpload.php" style="margin: 5%;">
          <input type="text" placeholder="Search by product name ..." name="search" style="width: 60%;">
          <button type="submit" style="width: 30%;">Submit</button>
        </form>
        <?php
        if(!empty ($_POST["search"])){
          $search = $_POST['search'];

          //query to get order based on the search keyword
          $searchResult = "SELECT * FROM stock WHERE name LIKE '%$search%' OR type LIKE '%$search%'  ";
          //execute the query

          $res = mysqli_query($conn, $searchResult);
          //count all the rows with the results
          $queryResults = mysqli_num_rows($res);
          //check for availabilty
          if ($queryResults > 0) {
          
            while ($row = mysqli_fetch_assoc($res)) {
              //fetch all resulting data from the db
              $name = $row['name'];
              $type = $row['type'];
                            
      
  ?>
  <table id="orders" style="width: 100% !important; margin-left:0%;">
    <tr>
      <th>NAMES</th>
      <th>TYPE</th>
       </tr>
    
    <tr>
      <td><?php echo $name  ?></td>
      <td><?php echo $type ?></td>
    </tr>
  </table>
      <?php
          }
          }else {
            echo "<div class='alert'>
                  No records matching your search
                  </div>";
          }
        }
      ?>
        <table>
            <tr>
                <th>INGREDIENTS</th>
                <th>MEASURE</th>
                <tr>
                <?php
                while ($rows = mysqli_fetch_assoc($resultIng))
                    {
                ?>
                <tr>
                    <td><?php echo $rows['name']  ?></td>
                    <td><?php echo $rows['measure']  ?></td>
                </tr>
                <?php
                    }
                    ?>
        </table>
        <br><br>
        <table>
            <tr>
                <th>FLAVOURS</th>
                <th>MEASURE</th>
            </tr>
            <?php
                while ($rowsFla = mysqli_fetch_assoc($resultFla))
                    {
                ?>
                <tr>
                    <td><?php echo $rowsFla['name']  ?></td>
                    <td><?php echo $rowsFla['measure']  ?></td>
                </tr>
                <?php
                    }
                    ?>
              </table>
        </table>
    </div>
  </div>

  <?php

//connection to the file that makes the db connection 
if(isset($_POST['supplyUp'])){
//variables for the sign up form inputs 

// get the specific stock id
    // $stock_id= $_GET['id'];
    $itemName = $_POST['itemName'];
    $itemCategory = $_POST['itemCategory'];
    $itemPrice = $_POST['itemPrice'];
    // $quant = $_POST['quant'];
    

    $query = "INSERT INTO `supplier`(`item_name`, `item_category`, `item_price`, `sup_email`)
    VALUES ('$itemName', '$itemCategory', '$itemPrice', '".$_SESSION['email']."'); ";

 mysqli_query($conn, $query);

//   header("Location: ../stock.php?request=success");
echo '<script>alert("Item Added Successfully")</script>';
  // echo '<script>window.location="supplyUpload.php"</script>';
            }
?>


</body>

</html>