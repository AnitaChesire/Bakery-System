<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
$data = checkLogIn($conn);

$queryCat = "SELECT * FROM categories ";
$resultCat = mysqli_query($conn, $queryCat);
$query = "SELECT * FROM products WHERE product_category = 'Bread&Buns' ";
$result = mysqli_query($conn, $query);
$listCat = "SELECT * FROM products WHERE product_category = 'category_name' ";
$resultlist = mysqli_query($conn, $listCat);


// print_r("Post is: ".$_POST["add_to_cart"]);


// when you click add to cart button 
if(isset($_POST["add_to_cart"]))
{
  //check if the sesion variable has data
  // print_r($_SESSION["shopping_cart"]);
  if(isset($_SESSION["shopping_cart"]))
  { //if the session has data in it

    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
      // variable count, counts all elements in the array using the count method
      $count = count($_SESSION["shopping_cart"]);
      // adds the new item into the array ising the following data
      $item_array = array(
        'item_id'       => $_GET["id"],
        'item_name'     => $_POST["hidden_name"],
        'item_price'    => $_POST["hidden_price"],
        'item_quantity' => $_POST["quantity"]
      );
      //shopping cart at index count
      $_SESSION["shopping_cart"] [$count] =$item_array;

      // $stmt = $conn->prepare("INSERT INTO orders (item_name, item_price, item_quantity)
      //  VALUES (?, ?, ?)");
      // $stmt->bind_param( "sss",['item_name'], ['item_price'], ['item_quantity']);
      // $stmt->execute();
      // $stmt->close();
      $totall = ($item_array["item_quantity"] * $item_array["item_price"]);
      $sql = "INSERT INTO orders (`user_id`,`item_name`, `item_price`, `item_quantity`, `order_total`) 
      VALUES ('".$_SESSION['user_id']."','".$item_array['item_name']."','".$item_array['item_price']."','".$item_array['item_quantity']."', '$totall')";
        mysqli_query($conn, $sql);
 
      echo "new record created successfully";
    // else  //if the item is already in the array,
    // {

    //   $count = count($_SESSION["shopping_cart"]);

    //   $item_array = array(
    //     'item_id'       => $_GET["id"],
    //     'item_name'     => $_POST["hidden_name"],
    //     'item_price'    => $_POST["hidden_price"],
    //     'item_quantity' => $_POST["quantity"]
    //   );
    //   //shopping cart at index count
    //   $_SESSION["shopping_cart"] [$count] =$item_array;

    //   $sql = "INSERT INTO orders (item_name, item_price, item_quantity) 
    //   VALUES ('".$item_array['item_name']."','".$item_array['item_price']."','".$item_array['item_quantity']."')";
    //    mysqli_query($conn, $sql);


       
    // }
  }
  else{ 
    //if the array has  no  data in it, declare  variable $item_array and write one item array in it,
    $item_array = array(
      'item_id'       =>$_GET["id"],  //from the url
      'item_name'     =>$_POST["hidden_name"],  //from th form
      'item_price'    =>$_POST["hidden_price"], //from th form
      'item_quantity' =>$_POST["quantity"]      //from th form
    );
    //shopping cart at index 0
    $_SESSION["shopping_cart"] [0] =$item_array;

  }
}
// deleting an item. if action is set in the url
if(isset($_GET["action"]))
{

// if the action is equal to delete
  if($_GET["action"] == "delete")
  {
    // f/for each loop access every value of a key in the session array 
    foreach($_SESSION["shopping_cart"] as $keys => $values)
    { 
      // If the item id is the same am the id in the url
      if($values["item_id"] == $_GET["id"])
      {
        // unset the the shopping cart vriable with index $keys
        unset($_SESSION["shopping_cart"][$keys]);
        echo '<script>alert("Item Removed")</script>';
        echo '<script>window.location="cakeproducts.php"</script>';
      }
    }
  } 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
  <title>ABC abc_bakery</title>
  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" href="stylewelcome.css">
  <!-- <link rel ="stylesheet" href="style.css"/> -->
  <script defer src="js/cart.js"></script>
</head>

<body>
<p>Welcome
    <?php
    echo $_SESSION['fname'];
    ?>
  </p>

  <ul>
    <li><a href="home.php" class="active">Home</a></li>
    <li><a href="about.php">About Us</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="suggestions.php">Product Suggestion</a></li>
    <li class="cart"><a href="cart.php">Cart</a></li>

    <!---dropdown button--->

    
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
  
  <img src="logo.png" alt="Girl in a jacket"
    style="width:30%;height:10%;display:block;margin-left: auto;margin-right: auto;">
  <!--nav abar section-->

  <div class="row">
  <div class="column side">

<h1 style="text-align: center; color:#ff0062;">Categories</h1>
<ul style="list-style-type: none;margin: 0;padding: 0;width: 100%;">
  <li style="width:100%;"><a href="cakeproducts.php" style="width:100%;">CAKES</a></li>
  <li style="width:100%;"><a href="bread.php" style="width:100%;">BREAD AND BUNS</a></li>
  <li style="width:100%;"><a href="cookies.php" style="width:100%;">COOKIES</a></li>
</ul>
</div>
    <!-- <div class="column side">

      <h1 style="text-align: center; color:#ff0062;">CATEGORIES</h1>
      <ul style="list-style-type: none;margin: 0;padding: 0;width: 100%;">
        <?php

            // while ($rowsCat = mysqli_fetch_assoc($resultCat)){

              // $href="SELECT * FROM `products`p JOIN categories c where p.`category_id`=c.category_id && category_name="
            ?>

        <li style="width: 100%;"> <a class="active" href="cakeproducts/<?php echo $rowsCat['category_id'];?> " style="width:100%;">
            <?php echo $rowsCat['category_name']  ?></a></li><br>
        <?php
            //}
            ?>
      </ul>

    </div> -->
    <div class="column middle">
      <h1 style="text-align: center; color:#ff0062;">BREAD AND BUNS </h1>
      <div class="row">
        <?php
        // while($rowsCat['category_id'] == ){
          ?>
        <?php
        
          while ($rows = mysqli_fetch_assoc($result))
          {
          ?>
        <div class="responsive">
        <div class="gallery">
          <!-- !important increases its priority of the style . -->
          <!-- justify-content property defines how the browser distributes space between and around
           content items along the main-axis of a flex container -->
        <div class="card" style="justify-content: center !important; padding-top: 5%; padding-bottom:5% !important;">
            <!-- <form method="post" action="orderform.php">  -->
            <!-- Fetching the Images from the db -->
            <!-- action of this form is to add products from the database product table using the product id -->
            <form method="post" action="bread.php?action=add&id=<?php echo $rows["product_id"];?> ">
              <!-- Fetch image of product from db -->
              <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['product_image']); ?>" />
              <!-- Fetching the Name of the product fro the db -->
              <h1 class="itemName"><?php echo $rows['product_name']  ?></h1>
              <!-- hidden fields are to used in the cart -->
              <input type="hidden" name="hidden_name" class="form-control"
                value="<?php echo $rows['product_name']  ?>" />
              <input type="hidden" name="hidden_price" class="form-control"
                value="<?php echo $rows['product_price']  ?>" />
              Quantity: <input type="text" name="quantity" class="form-control" value="1" />
              <!-- Fetching the price of the product fro the db -->
              Price: Ksh <p class="price"><?php echo $rows['product_price']  ?></p>
              <!-- Fetching the Description of the product fro the db -->
              <p class="description"><?php echo $rows['product_description']  ?></p><br>
              <!-- the add to cart button -->
              <input type="submit" name="add_to_cart" style="margin-top:5px;" class="orderItem" value="Add to Cart" />
              <!-- <p><button class="orderItem" type="submit" ></button></p> -->
            </form>
          </div>
        </div>
        </div>

        <!-- </div> -->
        <?php
          }
        
          ?>
      </div>


      <!---PAGINATION--->
      <div class="pagination">
        <a href="#">&laquo;</a>
        <a class="active" href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">&raquo;</a>
      </div>
    </div>

    <div class="column side">
      <h1 style="text-align: center; color:#ff0062;">CUSTOM PRODUCT</h1>
      <h4 style="text-align: center; color:#f8abc9;">You can now customize and order a product with US!</h4>
      <div class="containerx" style="width:100%">
        <form method="post" action="orderform.php">
          <label>Enter Category of product</label><br>
          <p>Customize your product for 2000/= a kg</p>
          <input type="submit" value="ORDER">
        </form>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- Display the Items that have been added  to the cart -->
    <div class="column single">
      <h1 style="text-align: center; color:#ff0062;">MY CART </h1>
      <table>
        <thead>
          <tr>
            <th>PRODUCT NAME</th>
            <th>QUANTITY</th>
            <th>AMOUNT</th>
            <th>TOTAL</th>
            <th>ACTION</th>
          </tr>
          <!-- Display Items in the Cart -->
          <?php
            // check if the session is not empty
            if(!empty($_SESSION["shopping_cart"]))
            {
              $total = 0;
              //for each loop access every value of a key in the session array 
              foreach($_SESSION["shopping_cart"] as $keys => $values)
              {
                ?>
          <tr>
            <td><?php echo $values["item_name"]; ?> </td>
            <td><?php echo $values["item_quantity"]; ?> </td>
            <td>Ksh<?php echo $values["item_price"]; ?> </td>
            <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2) ?> </td>>
            <!-- to delete an item -->
            <td><a href="cakeproducts.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span
                  class="text-danger">Remove</span></a></td>
          </tr>
          <?php

              $total = $total + ($values["item_quantity"] * $values["item_price"]);
              }
              ?>
          <tr>
            <b>
              <td colspan="3" align="right">Total</td>
            </b>
            <!-- two decimal points -->
            <td align="right">Ksh <?php echo number_format($total, 2); ?></td>

            <td></td>
          </tr>
          <?php
              }
            ?>
        </thead>

        <tfoot>
          <tr>
            <th>PRODUCT NAME</th>
            <th>QUANTITY</th>
            <th>AMOUNT</th>
            <th>TOTAL</th>
            <th>ACTION</th>
          </tr>
        </tfoot>
      </table>
    </div>
    </section>

  </div>
</body>

</html>