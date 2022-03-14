<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');
$product_id = $_GET['id'];
$query = "select * from products where product_id = '$product_id'";

$s_product = mysqli_query($conn, $query);
//calls the function
$data = checkLogIn($conn);
$query = "select * from products where product_id = '$product_id'";

if (isset($_POST['prodUpdate'])) {

    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productImage = $_POST['productImage'];

    $query = "UPDATE products SET product_name = '$productName', product_description = '$productDescription', product_price = '$productPrice', product_image ='$productImage' where product_id = '$product_id'";

    $result = mysqli_query($conn, $query);
    if ($result) {
        header("Location: productEdit.php?update=successful&id=$product_id");
        echo '<script type="text/javascript" alert("Data Updated") </script>';
    } 
    else {
        header("Location: productEdit.php?update=successful&id=$product_id");
        echo '<script type="text/javascript" alert("Data Has NOT been Updated") </script>';
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

</head>


<body>

  <!--- Nav bar-->
  <ul>
    <li><a href="home.php" class="active">Home</a></li>
    <li><a href="about.php">About Us</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="suggestions.php">Product Suggestion</a></li>
    <li class="cart"><a href="cart.php">Cart </a></li>

    <li class="dropdown" style="float:right">
      <a href="javascript:void(0)" class="dropbtn">User</a>
      <div class="dropdown-content" style="right: 2%;;">
        <a href="profile.php">Profile</a>
        <a href="../php/logout.php">Logout</a>
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



    <div class="column middle ">
      <div class="report">
        <h1 class="lg-title"> UPDATE PRODUCT</h1>

        <div class="selectReport">
          <form method="post" action="productEdit.php?action=add&id=<?php echo $product_id;?>">
            <?php
            while ($s_prod = mysqli_fetch_assoc($s_product)) {
            ?>
              <p>Product Name</p>
              <input id="productName" name="productName" type="text" value="<?php echo $s_prod['product_name']; ?>">
              <br>
              <p>Product Description</p>
              <input id="productDescription" name="productDescription" type="text" value="<?php echo $s_prod['product_description']; ?>">
              <br>
              <p>Product Price</p>
              <input id="productPrice" name="productPrice" type="text" value="<?php echo $s_prod['product_price']; ?>">
              <br>
              <p>Product Image</p>
              <!-------select Image to upload--->
              <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($s_prod['product_image']); ?>" width="100" height="100">
              <input type="file" name="productImage" id="fileToUpload" value="">
              <input type="submit" id="prodUpdate" name="prodUpdate" value="UPDATE">
            <?php
            } ?>
          </form>
</body>

</html>