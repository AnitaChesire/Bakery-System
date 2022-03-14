<!DOCTYPE html>
<html lang="en">
<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
$data = checkLogIn($conn);
$queryCat = "SELECT * FROM categories ";
$resultCat = mysqli_query($conn, $queryCat);


// when you click add to cart button 
if(isset($_POST["add_to_cart"]))
{
//check if the sesion variable has data
  // print_r($_SESSION["shopping_cart"]);
  if(isset($_SESSION["shopping_cart"]))
  { //if the session has data in it
  // variable count, counts all elements in the array using the count method
  // The count() function returns the number of elements in an array.
        $count = count($_SESSION["shopping_cart"]);
        // create a variable to store data that has been fetched fron the form 
        // The array() function is used to create an array
        $item_array = array(
          'item_id'       => $_GET["id"],
          'item_name'     => $_POST["hidden_name"],
          'item_price'    => $_POST["hidden_price"],
          'item_quantity' => $_POST["quantity"]
        );
        // adds the new item into the array ising the following data
        //shopping cart at index count
        $_SESSION["shopping_cart"] [$count] = $item_array;
        $totall = ($item_array["item_quantity"] * $item_array["item_price"]);
        
        $sql = "INSERT INTO orders (`user_id`,`item_name`, `item_price`, `item_quantity`, `order_total`, `email`) 
        VALUES ('".$_SESSION['user_id']."','".$item_array['item_name']."','".$item_array['item_price']."','".$item_array['item_quantity']."', '$totall', '".$_SESSION['email']."')";
          mysqli_query($conn, $sql);
  
        echo "new record created successfully";
    }
  else{
          $item_array = array(
           'item_id'       => $_GET["id"],
            'item_name'     => $_POST["hidden_name"],
            'item_price'    => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"]
              );
       //   shopping cart at index 0
         $_SESSION["shopping_cart"] [0] =$item_array;
          echo "new record not created";
     }   
 }

// deleting an item. if action is set in the url
if(isset($_GET["action"]))
{

// if the action is equal to delete
if ($_GET["action"] == "delete") {
    // f/for each loop access every value of a key in the session array 
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
      // If the item id is the same am the id in the url
      if ($values["item_id"] == $_GET["id"]) {
        // unset the the shopping cart vriable with index $keys
        unset($_SESSION["shopping_cart"][$keys]);
        echo '<script>alert("Item Removed")</script>';
        echo '<script>window.location="cart.php"</script>';
      }
    }
  } 
}
?>


<head>
  <meta charset="UTF-8">
  <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
  <title>ABC abc_bakery</title>
  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" href="stylewelcome.css">
</head>

<body>

  <ul>
    <li><a href="home.php" class="active">Home</a></li>
    <li><a href="about.php">About Us</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="suggestions.php">Product Suggestion</a></li>
    <li class="cart"><a href="cart.php">Cart</a></li>

    <!---dropdown button--->

    <li class="dropdown" style="float:right">
      <!-- void 0 so the browser returns nothing  -->
      <a href="javascript:void(0)" class="dropbtn"><?php
    echo $_SESSION['fname'];
    ?></a>
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
  <img src="logo.png" alt="Girl in a jacket" style="width:30%;height:10%;display:block;margin-left: auto;margin-right: auto;">
  <!--nav abar section-->

  <div class="row">
    <div class="column side">

      <h1 style="text-align: center; color:#ff0062;">CATEGORIES</h1>
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
    <!----End of navbar--->
    <!---PRODUCTS--->

    <section>

      <div class="column middle">

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
            <?php
            if (!empty($_SESSION["shopping_cart"])) {
              $total = 0;
              foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            ?>
                <tr>
                  <td><?php echo $values["item_name"]; ?> </td>
                  <td><?php echo $values["item_quantity"]; ?> </td>
                  <td>Ksh<?php echo $values["item_price"]; ?> </td>
                  <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2) ?> </td>
                  <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
                </tr>
              <?php

                $total = $total + ($values["item_quantity"] * $values["item_price"]);
              }
              ?>
              <tr>
                <b>
                  <td colspan="3" align="right">Total</td>
                </b>
                <td align="right">Ksh <?php echo number_format($total, 2); ?></td>
                <td></td>
              </tr>
            <?php
            }
            ?>
          </thead>
        </table>
        <br></br>
        <br></br>
        <h1 style="text-align: center; color:#ff0062;">CHECK OUT</h1>
        <!-- Check out -->
        <form method="POST" onsubmit="return validateCheckOut()" action="includes/checkoutincludes.php" id="checkOut">
          <p>Email:<br>
            <input type="hidden" name="user" value=" <?php echo $_SESSION['email'];  ?>" />
            <input type="text" name="userShowing" value=" <?php echo $_SESSION['email'];  ?>" />
          </p>
          <?php
          if (!empty($_SESSION["shopping_cart"])) {
            $total = 0;
            foreach ($_SESSION["shopping_cart"] as $keys => $values) {

              $total = $total + ($values["item_quantity"] * $values["item_price"]);
            }
          ?>
            <label >Total Amount in Ksh</label>
            <!-- display the total -->
            <input type="hidden" name="totalAmount" value="<?php echo number_format($total, 2); ?>">
            <input type="text" name="totalAmountShowing" value="<?php echo number_format($total, 2); ?>">
            <!-- <input type="text" name="cart" value="<?php //echo ($_SESSION["shopping_cart"]); ?>"> -->
          <?php
          }
          ?>

          <label>Pick up location/ Delivery location</label><br>
            <textarea id="pickupLocation" name="pickUpLocation" placeholder="Write something.." style="height:100px" ></textarea><br></br>
          <P>Kindly pay the amount above to:<br></br>
            MPESA PAYBILL 714777.</p>
          <br></br>

          <label>MPESA CODE:</label>
          <input id="code" type="text" name="paymentCode" /><br></br>
          <br></br>
          <input type="submit" name="order" value="SUBMIT ORDER" />
        </form>
      </div>
    </section>

    <div class="column side">


    </div>

</body>

</html>
<script>
   function validateCheckOut() {
  //   fetch values from the input fields in the check out form 

    textarea = document.getElementById("textarea").value;
    paymentcode = document.getElementById("paymentcode").value;
    checkOut = document.getElementById("checkOut");



    //Check for Empty Fields

    if (textarea == "" || paymentcode == "") {
      alert("You must fill all fields");

      return false;
    } 
    // if there are no empty fields
      else {

        return true
        checkOut.submit();
      }
    }
</script>