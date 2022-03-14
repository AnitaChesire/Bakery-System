<?php
session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
$data = checkLogIn($conn);


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

<script>

function validateSuggestions(){

             nameSuggestion = document.getElementById("nameSuggestion").value;
             descriptionSuggestion = document.getElementById("descriptionSuggestion").value;
             suggestionForm = document.getElementById("suggestionForm");

              //Check for Empty Fields

              if(  nameSuggestion =="" || descriptionSuggestion=="" ){
                alert("You must fill all fields");
                // because the conditions have not been met
                return false;
             }
             else{
              alert("submitted succesfully");
              //  submit the form because conditions have been met..  value returned is true
              suggestionForm.submit();
              
            }
          }

</script>

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
  <li style="width:100%;"><a href="cakeproducts.php" style="width:100%;">CAKES</a></li>
  <li style="width:100%;"><a href="bread.php" style="width:100%;">BREAD AND BUNS</a></li>
  <li style="width:100%;"><a href="cookies.php" style="width:100%;">CUP CAKES</a></li>
</ul>
  </div>
  
  <div class="column middle">
  <h1 class="lg-title">SUGGESTION FORM </h1>

<form id="suggestionForm" onsubmit="return validateSuggestions()" method="post" action="includes/suggestionsinclude.php" >
<div class="orderform">
<div class="row">
        <br></br>
          <div id="signuperror"></div>
          <div class="col-25">
            <label for="fname">Product Name</label>
          </div>
          <div class="col-75">
            <input type="text" id="nameSuggestion" name="productSuggestName" placeholder="Your name.." >
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Product Description</label>
          </div>
          <div class="col-75">
            <input type="text" id="descriptionSuggestion" name="suggestionDescription" placeholder="Your last name..">
          </div>
        </div><div class="row">
          <div class="col-25">
            <label for="email">Image</label>
          </div>
          <div class="col-75">
          <input type="file" name="suggestionImage" id="fileToUpload">
          </div>
        </div>
        <div class="row">
          <input type="submit" value="SUBMIT">
        </div>
</div>
</div>
</form>

  </div>
 </div>
</body>
</html>
