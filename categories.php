  <?php
  session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
$data = checkLogIn($conn);

        $queryCat = "SELECT * FROM categories ";
        $resultCat = mysqli_query($conn, $queryCat);
        $query = "SELECT * FROM products WHERE product_category = 'cakes' ";
        $result = mysqli_query($conn, $query);
        $querycookies = "SELECT * FROM products WHERE product_category = 'cookies' ";
        $resultCookies = mysqli_query($conn, $querycookies);
        $queryBread = "SELECT * FROM products WHERE product_category = 'Bread&Buns' ";
        $resultBread = mysqli_query($conn, $queryBread);
        $listCat = "SELECT * FROM products WHERE product_category = 'category_name' ";
        $resultlist = mysqli_query($conn, $listCat);
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Categories</title>
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
            <a href="adminpanel.php">Dashboard</a><br>
            <a href="categories.php">Categories</a><br>
            <a href="categoryupload.php">Add Category</a><br>
            <a href="productupload.php">Add Product </a><br>
            <a href="orders.php">Orders</a><br>
            <a href="reports.php">Users' Report</a><br>
            <a href="suggestionview.php">Suggestions</a><br>
            <a href="users.php">Custom Orders</a><br>
            <a href="stock.php">Stock</a><br>
            <a href="supplierview.php">Suppliers</a><br>
            <a href="requestview.php">Requests</a><br>
            <a href="stockreport.php">Baking Essentials</a><br>
          </div>
        </div>

        <div class="column middle" style="overflow: auto !important">
          <div id="myprofile" class="tabcontent">
            <h1 class="lg-title"> CAKES </h1>

            <div id="reportTable2">
              <table>
                <tr>
                  <th>PRODUCT</th>
                  <th>DESCRIPTION</th>
                  <th>PRICE</th>
                  <th>UPDATE</th>
                </tr>
                <?php
        
                  while ($rows = mysqli_fetch_assoc($result))
                  {
                  ?>

                <tr>
                  <td><?php echo $rows['product_name']  ?></td>
                  <td><?php echo $rows['product_description']  ?></td>
                  <td><?php echo $rows['product_price']  ?></td>
                  <td style="display: flex; justify-content: center;"><button type="submit"
                      onclick="document.location='productEdit.php?id=<?php echo $rows['product_id']; ?>'">Edit</button>
                    <button style="margin-left: 5%;" type="submit"
                      onclick="document.location='delete.php?id=<?php echo $rows['product_id']; ?>'">Delete</button>
                  </td>
                </tr>


                <?php
                    }
                  
                    ?>
              </table>
            </div>

          </div>

          <div id="myproducts" class="tabcontent">
            <h1 class="lg-title"> COOKIES</h1>

            <div id="reportTable2">
              <table>
                <tr>
                  <th>PRODUCT</th>
                  <th>DESCRIPTION</th>
                  <th>PRICE</th>
                  <th>UPDATE</th>
                </tr>
                <?php
        
                    while ($rowsCookies = mysqli_fetch_assoc($resultCookies))
                    {
                    ?>
                <tr>
                  <td><?php echo $rowsCookies['product_name']  ?></td>
                  <td><?php echo $rowsCookies['product_description']  ?></td>
                  <td><?php echo $rowsCookies['product_price']  ?></td>
                  <td style="display: flex; justify-content: center;"><button type="submit"
                      onclick="document.location='productEdit.php?id=<?php echo $rowsCookies['product_id']; ?>'">Edit</button>
                    <button type="submit" style="margin-left: 5%;"
                      onclick="document.location='delete.php?id=<?php echo $rowsCookies['product_id']; ?>'">Delete</button>
                  </td>
                </tr>


                <?php
                      }
                    
                      ?>
              </table>
            </div>

          </div>

          <div id="myorders" class="tabcontent">
            <h1 class="lg-title"> BREAD & BUNS </h1>

            <div id="reportTable2">
              <table>
                <tr>
                  <th>PRODUCT</th>
                  <th>DESCRIPTION</th>
                  <th>PRICE</th>
                  <th>UPDATE</th>
                </tr>
                <?php
        
                    while ($rowsBread = mysqli_fetch_assoc($resultBread))
                    {
                    ?>

                <tr>
                  <td><?php echo $rowsBread['product_name']  ?></td>
                  <td><?php echo $rowsBread['product_description']  ?></td>
                  <td><?php echo $rowsBread['product_price']  ?></td>
                  <td style="display: flex; justify-content: center;"><button type="submit"
                      onclick="document.location='productEdit.php?id=<?php echo $rowsBread['product_id']; ?>'">Edit</button>
                    <button style="margin-left: 5%;" type="submit"
                      onclick="document.location='delete.php?id=<?php echo $rowsBread['product_id']; ?>'">Delete</button>
                  </td>
                </tr>


                <?php
                      }
                    
                      ?>
              </table>
            </div>

          </div>
        </div>

        <div class="column side">
          <button style="width:100% !important" class="tablink" onclick="openPage('myprofile', this, '#ff0062')">CAKES
            <br>
            <!--a href="categoryEdit.php">Edit</a>
            <a href="#">Delete</a></button-->
            <button style="width:100% !important" class="tablink"
              onclick="openPage('myproducts', this, '#ff0062')">COOKIES
              <br>
              <button style="width:100% !important" class="tablink" onclick="openPage('myorders', this, '#ff0062')"
                id="defaultOpen">BREAD & BUNS
                <br>
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