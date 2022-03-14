<?php
 session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
  $data = checkLogIn($conn);

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

 $queryOrders = "SELECT * FROM orders WHERE email='".$_SESSION['email']."' ";
 $resultOrders = mysqli_query($conn, $queryOrders);

?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
<link rel="icon" href="..\images\icon.png" type="image/gif" sizes="16x16">
<title>ABC abc_bakery</title>
<link rel="stylesheet" href="navbar.css">
<link rel="stylesheet" href="stylewelcome.css">

</head>
<body>
<p>Welcome 
    <?php
   echo $_SESSION['fname'];  ?>
   </p>
<ul>
  <li><a href="home.php" class="active">Home</a></li>
  <li><a href="about.php">About Us</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="suggestions.php">Product Suggestion</a></li>
  <li class="cart"><a href="cart.php">Cart </a></li>
  
  <!---Dropdown button--->

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
  <!-- logo -->
<img src="logo.png" alt="Girl in a jacket" style="width:30%;height:10%;display:block;margin-left: auto;margin-right: auto;">

<div class="row">
  <div class="column side">
  <div class="responsive" style="background-color:aliceblue;justify-content: center;">
  <div class="gallery">
    <a target="_blank" href="#">
      <img src="icons/newuser.png" alt="bread" width="600" height="400">
    </a>
    <div class="desc">USER</div>
  </div>
</div>
  
  </div>
  
  <div class="column middle">
    <!----PROFILE--->

<!-- <div id="myorders" class="tabcontent"> -->
<h1 class="lg-title"> Profile</h1>

<label>Name: <?php
   echo $_SESSION['fname'];  ?>
   </p></label><br>
<label>Email: <?php
   echo $_SESSION['email'];  ?>
   </p></label><br></br>
   <h2></h2> 
<!-- </div> -->
<!-- this statement in this case refers to element that is to be received -->
   <button class="tablink" onclick="openPage('myprofile', this, 'red')">Update Account Details</button>
   <button class="tablink" onclick="openPage('myorders', this, 'green')" id="defaultOpen">My Orders</button> 
   <div id="myprofile" class="tabcontent">
<div class="updateprofile">
  <form action="includes/profileIncludes.php" method="post">
  <input id="hidden" type="hidden" name="emailProfile" value="<?php
   echo $_SESSION['email'];  ?>" /><br>
<label>First Name</label>
<input id="text" type="text" name="nameProf" placeholder="Vivianne" /><br>
<label>Last Name</label>
<input id="last" type="text" name="lastNameProf" placeholder="Vivianne" /><br>
<label>Email</label>
<input id="email" type="email" name="emailProf" placeholder="Vivianne@hotmail.com" /><br>
<label>Password</label>
<input id="password" type="password" name="passwordProf" placeholder="********" /><br></br>

<input type="submit" value="UPDATE">
<form>
</div>

</div>
 
<!-- <button class="tablink" onclick="openPage('myorders', this, 'red')">My Orders</button> -->
<div id="myorders" class="tabcontent"> 
  <div class="profileupdate">
<table>
  <tr style="background-color: rgb(211, 253, 255);">
    <th>PRODUCT</th>
    <th>QUANTITY </th>
    <th>PRICE</th>
    <th>TOTALAMOUNT</th>
    <th>TIME ORDERED</th>
    <!-- <th>STATUS</th> -->
    <th></th>
  </tr>
  <?php
  while ($rows = mysqli_fetch_assoc($resultOrders)){
    ?>   
    <tr>
    <td><?php echo $rows['item_name']; ?></td>
    <td><?php echo $rows['item_quantity']; ?></td>
    <td><?php echo $rows['item_price']; ?></td>
    <td style="font-weight:bolder; color:indigo; text-align:center;"><?php echo $rows['order_total']; ?></td>
    <td><?php echo $rows['time']; ?></td>
    
  </tr>
  <?php
  }
  ?>
  
</table>





<script>
function openPage(pageName,elmnt,color) {
  //  Hide all elements with class="tabcontent" by default 
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  // Show the tab content of the tab clicked 
  //block= starts on a new line and takes up the whole width
  document.getElementById(pageName).style.display = "block";

   // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = color;
}

 // Get the element with id="defaultOpen" and click on it
// //click function immitates the mouse click
 document.getElementById("defaultOpen").click();
</script>
  </div>
  
  <div class="column side">
  
</div>


  </div>
</body>
</html>
<?php

//  while ($rows = mysqli_fetch_assoc($resultOrders)){   
        
//               ?>
              <tr>
               <td><?php //echo $rows['Item_name'];?></td>
              <td><?php //echo $rows['Item_price'];?></td>
               <td><?php //echo $rows['Item_quantity'];?></td>
              <td><?php //echo $rows['order total'];?></td>
            </tr>
          </table>
        </div>
       </div>

//             <?
//            }
          
//            ?>
           
//  <?
          
           // else{
              "<div class='alert'>
                  No Orders yet
                  </div>";
           // }
         
          
          //}   
  ?> 