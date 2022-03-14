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


// Making a stock request

if (isset($_POST['requestIng'])) {

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
  <title>Stock</title>
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
    <li class="cart"><a href="mycart.php">Cart</a></li>

    <li class="dropdown" style="float:right">
      <a href="javascript:void(0)" class="dropbtn">User</a>
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
        <div id="myingredients" class="tabcontent">
          <h1 class="lg-title" style="text-align: center; color:#ff0062;"> INGREDIENTS </h1>
          <h2> Add an Ingredient </h2>
          <!-- create a form to add new flavour to the database-->
          <form id="addIng" onsubmit=" return validateIng()" method="post" action="includes/addIng.php" enctype="fmultipart/form-data">
            <div id="productImage">
              <p>Ingredient Name</p>
              <input id="ingredient" name="ingredient" type="text" placeholder="Enter ingredient name.." />
              <p>Stock</p>
              <input id="stock" name="stock" type="text" placeholder="Enter stock.." />
              <!-- <input id="stock" name="stock" type="text" placeholder="Enter stock.." /> -->
              <input type="hidden" id="ingName" name="ingName" value="ingredient" />
              <p>Standard Measure</p>
              <input id="measure" name="measure" type="text" placeholder="Enter standard measure for price.." />
              <input type="submit" id="addIngs" name="addIngs" value="Add Ingredient" />
              <br>

            </div>
          </form>
          <div id="reportTable2">

            <table>
              <tr>
                <th style="font-weight:bolder; text-align:center;">INGREDIENT</th>
                <th style="font-weight:bolder; color:red; text-align:center;">AVAILABLE STOCK</th>
                <th style="font-weight:bolder; text-align:center;">STANDARDS OF MEASURE</th>
                <th style="font-weight:bolder; text-align:center;">UPDATE</th>
              </tr>
              <?php
              while ($rows = mysqli_fetch_assoc($resultIng)) {
              ?>
                <tr>
                  <td style="text-align:center;" name="ingrd"><?php echo $rows['name']  ?></td>
                  <td style="font-weight:bolder; color:red; text-align:center;" name="ingrdAmt"><?php echo $rows['amount']  ?></td>
                  <td style="font-weight:bolder; color:green; text-align:center;" name="ingrdMeas"><?php echo $rows['measure']  ?></td>
                  <td><button style="margin-left: 5%;" type="submit" onclick="document.location='stockRequest.php?id=<?php echo $rows['stock_id']; ?>'">REQUEST</button></td>

                </tr>
              <?php
              }
              ?>

            </table>
          </div>
        </div>

        <div id="myflavours" class="tabcontent">
          <h1 class="lg-title" style="text-align: center; color:#ff0062;"> FLAVOURS</h1>
          <h2> Add a Flavour </h2>
          <!-- create a form to add new flavour to the database-->
          <form id="addFlav" onsubmit=" return validateFlav()" method="post" action="includes/addIngFlav.php" enctype="fmultipart/form-data">
            <div id="productImage">
              <p>Flavour Name</p>
              <input id="flav" name="flav" type="text" placeholder="Enter flavour name.." />
              <p>Stock</p>
              <input id="stockFlav" name="stockFlav" type="text" placeholder="Enter stock.." />
              <input type="hidden" id="flavour" name="flavour" value="flavour" />
              <p>Standard Measure</p>
              <input id="meas" name="meas" type="text" placeholder="Enter standard measure for price.." />
              <input type="submit" id="addFlavs" value="Add Flavour" />
              <br>
            </div>
          </form>
          <div id="reportTable2">

            <table>
              <tr>
                <th style="font-weight:bolder; text-align:center;">FLAVOURS</th>
                <th style="font-weight:bolder; color:red; text-align:center;">AVAILABLE STOCK</th>
                <th style="font-weight:bolder; text-align:center;">UPDATE</th>
              </tr>
              <?php
              while ($rowsFla = mysqli_fetch_assoc($resultFla)) {
              ?>
                <tr>
                  <td style="text-align:center;"><?php echo $rowsFla['name']  ?></td>
                  <td style="font-weight:bolder; color:red; text-align:center;"><?php echo $rowsFla['amount']  ?></td>
                  <td style="font-weight:bolder; color:green; text-align:center;"><?php echo $rowsFla['measure']  ?></td>
                  <td><button style="margin-left: 5%;" type="submit" onclick="document.location='stockRequest.php?id=<?php echo $rowsFla['stock_id']; ?>'">REQUEST</button></td>
                </tr>
              <?php
              }
              ?>
            </table>

          </div>
        </div>
      </div>
      <div class="column side">
        <button style="width:100% !important" class="tablink" onclick="openPage('myingredients', this, '#ff0062')" id="defaultOpen">INGREDIENTS
          <button style="width:100% !important" class="tablink" onclick="openPage('myflavours', this, '#ff0062')">FLAVOURS

      </div>

      <script>
        function openPage(pageName, elmnt, color) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablink");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
          }
          document.getElementById(pageName).style.display = "block";
          elmnt.style.backgroundColor = color;
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
      </script>
  </body>

</html>
<script>
  //   adding an Ingredient form validation
  function validateIng() {

    //   fetch input fields from the form 

    ingredient = document.getElementById("ingredient").value;
    stock = document.getElementById("stock").value;
    addIng = document.getElementById("addIng");

    //Check for Empty Fields

    if (ingredient == "" || stock == "") {
      alert("You must fill all fields");

      return false;
    } else {
      return true;
      addIng.submit();
    }
  }

  //   adding an Flavour form validation
  function validateFlav() {

    //   fetch input fields from the form 

    flav = document.getElementById("flav").value;
    stockFlav = document.getElementById("stockFlav").value;
    addFlav = document.getElementById("addFlav");

    //Check for Empty Fields

    if (flav == "" || stockFlav == "") {
      alert("You must fill all fields");

      return false;
    } else {
      return true;
      addFlav.submit();
    }
  }
</script>