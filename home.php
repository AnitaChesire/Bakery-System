<?php
 session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
$data = checkLogIn($conn);
$queryCat = "SELECT * FROM categories ";
$resultCat = mysqli_query($conn, $queryCat);
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="..\images\icon.png" type="image/gif" sizes="16x16">
  <title>ABC abc_bakery</title>
  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" href="stylewelcome.css">
  <script defer src="js/cart.js"></script>

</head>

<body>
  <p>Welcome 
    <?php
   echo $_SESSION['fname'];  ?>
   </p>
  <h1></h1>
  <ul>
    <li><a href="home.php" class="active">Home</a></li>
    <li><a href="about.php">About Us</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="suggestions.php">Product Suggestion</a></li>
    <li class="cart"><a href="cart.php">Cart</a></li>

    <!---dropdown button--->

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
    //  <!-- If the logged in user is an supplier, provide a link to to take them to the supplier side  -->
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
  
  <img src="logo.png" alt="Girl in a jacket" style="width:30%;display:block;margin-left: auto;margin-right: auto;">
  <!--nav abar section-->
  <div class="row">
    <div class="column side">

      <h1 style="text-align: center; color:#ff0062;">Categories</h1>
      <ul style="list-style-type: none;margin: 0;padding: 0;width: 100%;">
        <?php
              while ($rowsCat = mysqli_fetch_assoc($resultCat)){
                 //$href="SELECT * FROM `products`p JOIN categories c where p.`category_id`=c.category_id && category_name="
              ?>
        <li style="width:100%;"><a href="cakeproducts.php?catid=<?php echo $rowsCat['category_id'];?>"
            style="width:100%;"><?php echo $rowsCat['category_name'];?></a></li>
        <?php
              }
              ?>
      </ul>
    </div>

    <div class="column middle">
      <h1 style="text-align: center; color:#ff0062;">ABC Bakery</h1>
      <h4 style="text-align: center; color:#f8abc9;">Not Your Usual Bakery</h4>
      <h2 style="color:#f8abc9;">Order Online</h2>
      <p>Now order our fresh products online. The bakery provides freshly prepared bakery and pastry products at all times during business operations. ABC Bakery also offers a broad range of savory Deli products. Our bakery caters to all of its customers by providing each customer products made to suit the customer, down to the smallest detail. </p>
      <h2 style="text-align: right; color:#f8abc9;">Custom Products</h2>
      <p>You can order custom made bakery products from our bakery. All you need is to provide a description of the products and we'll be sure to prepare its for you.</p>

    </div>

    <div class="column side">
      <h1 style="text-align: center; color:#ff0062;">Product Gallery</h1>
      <div class="responsive">
        <div class="gallery">
          <!-- <a target="_blank" href="about.php"> -->
          <img src="gallary/cupcake.jpg" alt="cupcake" width="600" height="400">
          </a>
          <div class="desc">Soft and Tasty Cupcakes</div>
        </div>
      </div>


      <div class="responsive">
        <div class="gallery">
          <!-- <a target="_blank" href="img_forest.jpg"> -->
          <img src="gallary/cake.jpg" alt="cake" width="600" height="400">
          </a>
          <div class="desc">A Cake for every occation</div>
        </div>
      </div>

      <div class="responsive">
        <div class="gallery">
          <!-- <a target="_blank" href="img_lights.jpg"> -->
          <img src="gallary/aboutimage.jpg" alt="donut" width="600" height="400">
          </a>
          <div class="desc">Big yummy cookies with toppings of your choice</div>
        </div>
      </div>

      <div class="responsive">
        <div class="gallery">
          <!-- <a target="_blank" href="img_mountains.jpg"> -->
          <img src="gallary/bread.jpg" alt="bread" width="600" height="400">
          </a>
          <div class="desc">The Best bread to serve for breakfast</div>
        </div>
      </div>


    </div>
  </div>
</body>

</html>