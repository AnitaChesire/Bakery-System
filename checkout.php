<?php
 session_start();

include_once('includes/connection.php');
include_once('includes/functions.php');

  //calls the function
  $data = checkLogIn($conn);

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
        <title>ABC abc_bakery</title>
            <link rel="stylesheet" href="navbar.css">
            <link rel="stylesheet" href="stylewelcome.css">
            
            <script defer src="js/cart.js"></script>
            
            <!-- INTERNAL INPUT VALIDATION -->         

            <script>

               function validateOrderForm(){
                 phone = document.getElementById("phone").value;
                 product = document.getElementById("product").value;
                 quantity = document.getElementById("quantity").value;
                 paymentcode = document.getElementById("paymentcode").value;
                 orderForm = document.getElementById("orderForm").value;
               

                 //Check for Empty Fields

             if( phone =="" || product=="" || quantity =="" || paymentcode ==""){
                alert("You must fill all fields");
                // because the conditions have not been met
                return false;
             }
             else{
              //  submit the form because conditions have been met..  value returned is true
              orderForm.submit();
             }
             

          }

            </script>
        <body>
        <p>Welcome 
    <?php
   echo $_SESSION['fname'];  ?>
   </p>

<!---adding nav bar--->

 <!--- Nav bar-->  
 <ul>
  <li><a href="home.php" class="active">Home</a></li>
  <li><a href="about.php">About Us</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="suggestions.php">Product Suggestion</a></li>
  <li class="cart"><a href="cart.php">Cart <span>0</span></a></li>
  
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
    elseif($_SESSION['user_id'] == 3){
      ?>
      <a href="suppliers.php">Supplier</a>
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

<div> 
  <div class="column middle" style="margin-left: 30%" >
<h1 class="lg-title"> ORDER FORM </h1>

<form id="orderForm" onsubmit="return validateOrderForm()" method="post" action="includes/orderformincludes.php" >
<div id="orderFormError"></div>
<div class="orderform">
<label name="orderEmail">Email    :</label>
<?php   echo $_SESSION['email'];  ?><br></br>
<label>Product:</label>
<input id="product" type="text" name="product" placeholder="" /><br></br>
<label>Amount per kg:</label>
<label id="amountKg" name="amount">2000</label><br>
<label>Quantity:</label>
<select id="productQuantity" name="quantity"><option>Select</option><option>1</option>
<option>2</option><option>3</option><option>4</option><option>5</option></select>
<br>
<br></br>
<label>Product Customization (Upload an Image)</label><br>
<input type="file" name="customization" id="fileToUpload">
<br></br>
<label>Product Description</label><br>
<textarea id="textarea" name="productDescription" placeholder="Write something.." style="height:100px" ></textarea><br></br>
<label>Pick up location/ Delivery location</label><br>
<textarea id="textarea" name="pickupLocation" placeholder="Write something.." style="height:100px" ></textarea><br></br>
<label>TOTAL COST:</label>

<input id="totalCosts" type="button" onclick="totalAmount()" value=" Click to show yor Total" /><br>
<p>The Result is : <br>
<span id = "result" name="result"></span>
</p>

<br></br>

<P>Kindly pay the amount above to:<br></br>
    MPESA PAYBILL 714777.</p>
    <br></br>

    <label>MPESA CODE:</label>
<input id="paymentcode" type="text" name="code" /><br></br>
<br></br>


<input type="submit" value="SUBMIT ORDER">

</div>
</div>
</div>
</form>

</div>
<script>
  function totalAmount(){
   
  var amountKg= document.getElementById('amountKg').value
  var productQuantity= document.getElementById('productQuantity').value
  document.getElementById('result').innerHTML = parseInt(productQuantity * amountKg)
  console.log(result)

   }

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>
</html>