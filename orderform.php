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
   
<!-- <button class="tablink" onclick="openPage('myprofile', this, 'red')"  >ORDER</button>
<button class="tablink" onclick="openPage('myorders', this, 'green')" id="defaultOpen">ORDER TRACKING</button>


<div id="myprofile" class="tabcontent">  -->
  <div class="column middle" style="margin-left: 30%" >
<h1 class="lg-title"> ORDER FORM </h1>

<form id="orderForm" onsubmit="return validateOrderForm()" method="post" action="includes/orderformincludes.php" >
<div id="orderFormError"></div>
<div class="orderform">
<label name="orderEmail">Email    :</label>
<?php   echo $_SESSION['email'];  ?><br></br>
<input type="hidden" name="orderE" value="<?php   echo $_SESSION['email'];  ?>"/>
<label>Product:</label>
<input id="product" type="text" name="product"  /><br></br>
<label>Amount per kg:</label>
<input type="hidden" id="amountKg" name="amountKg" value="2000"/>
<label id="amountKg1" type="number" name="amount">2000</label><br>
<label>Quantity in(kg):</label>
<input id="productQuantity" type="number" min="1" max="10" name="quantityKg" /><br></br>
<!-- <select id="productQuantity" name="quantity"><option>Select</option><option>1</option>
<option>2</option><option>3</option><option>4</option><option>5</option></select>
<br> -->
<br></br>
<label>Product Customization (Upload an Image)</label><br>
<input type="file" name="customization" id="customization"/>
<br></br>
<label>Product Description</label><br>
<textarea id="productDescription" name="productDescription" placeholder="Write something.." style="height:100px" ></textarea><br></br>
<label>Pick up location/ Delivery location</label><br>
<textarea id="pickupLocation" name="pickupLocation" placeholder="Write something.." style="height:100px" ></textarea><br></br>
<label>TOTAL COST:</label>
<!-- <input type="hidden" name="amountKg" value="function totalAmount(result)"/> -->
<input id="totalCosts" type="button" onclick="totalAmount()" value=" Click to show your Total" /><br> 
<p>The Result is : <br>
<span id = "result" name="result"></span>
</p>

<br></br>

<P>Kindly pay the amount above to:<br></br>
    MPESA PAYBILL 714777.</p>
    <br></br>

    <label>MPESA CODE:</label>
    <input id="code" type="text" name="code" /><br></br>
<br></br>

<input type="submit" value="SUBMIT ORDER">
</div>
</div>
</div>
</form>


<!-- <div id="myorders" class="tabcontent">  -->
<!----tracking Progress-->
<div class="column side"></div>
<!-- 
  <div class="column middle">
  <h2><p>Order No. 001A</p>
    <p>Product</p>

  </h2> -->
    <!-- <div id="trackingOrder">
    <ul>
      <li>
        <img src="images/payment.jpg"/>
        
        <p>Payment Confirmation</p>
      </li>
      <li>
        <img src="images/order.jpg"/>
       
        <p>Order Preparation</p>
      </li>
      <li>
        <img src="images/pickup.png"/>
       
        <p>Ready for Pick up/Dispatch</p>
      </li>
      <li>
        <img src="images/completed.jpg"/>
        
        <p>Order Completed</p>
      </li>
    </ul>
  
</div>--->
</div>
</div>



</div>
<script>
  function totalAmount(){
  var amountKg= document.getElementById('amountKg').value
  var productQuantity= document.getElementById('productQuantity').value
  document.getElementById('result').innerHTML = parseInt(productQuantity * amountKg)
  // result = result ? result :result;
  console.log(result)

   }

  </script>

<script>
function openPage(pageName,elmnt,color) {
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

<script>
  function validateOrderForm() {
    product = document.getElementById("product").value;
    productQuantity = document.getElementById("productQuantity").value;
    customization = document.getElementById("customization").value;
    productDescription = document.getElementById("productDescription").value;
    pickupLocation = document.getElementById("pickupLocation").value;
    result = document.getElementById("result").value;
    orderForm = document.getElementById("orderForm");




    //Check for Empty Fields

    if (product == "" || productQuantity == ""|| customization == ""|| productDescription == ""|| pickupLocation == ""|| paymentcode == ""
   ) {
      alert("You must fill all fields");

      return false;
    } 
      else {
        return true
        orderForm.submit();
      }
    }
</script>

</body>
</html>