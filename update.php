<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
            <title>MY PROFILE</title>
            <link rel ="stylesheet" href="style.css"/>
            
            <script defer src="js/updateproile.js"></script>
        </head>
        <body>

<!---adding nav bar--->

<div id="navbar">
       
       <label class="logo">ABC BAKERY</label>
        
           <ul>
               <li><a href ="homepage.php">HOME</a></li>
               <li><a href ="aboutus.php">ABOUT US</a></li>
               <li><a href ="contact.php">CONTACT</a></li>
               
               <div class="dropdown">
                   <button class="dropbtn">ACCOUNT
                   <i class=" fa fa-caret-down"></i>
   </button>
   <div class="dropdown-content">
                            <a href ="index.php">USER LOG IN</a>
                            <a href ="adminpanel.php">ADMIN </a>
                           <a href ="profile.php">MY PROFILE </a>
   </div>
   </div>
   </div>
   
                   </div>
           </li>
               
               
   
       <!---end of Nav bar-->         
   

<!----PROFILE--->



<button class="tablink" onclick="openPage('myprofile', this, 'red')">My Profile</button>

<!-- this will be the default open tab--->

<button class="tablink" onclick="openPage('myorders', this, 'green')" id="defaultOpen">My Oders</button>


<div id="myprofile" class="tabcontent"> 
<h1 class="lg-title"> UPDATE PROFILE </h1>

<form id="updateform">
<div class="updateprofile">
  <div class="update-error"></div>
<label>First Name</label>
<input id="profileFirstName" type="text" name="text" /><br>
<label>Last Name</label>
<input id="profileLastName" type="text" name="text" placeholder="Vivianne" /><br>
<label>Phone Number</label>
<input id="profileNo" type="text" name="text" placeholder="Vivianne" /><br>
<label>Email</label>
<input id="profileEmail" type="email" name="email" placeholder="Vivianne@hotmail.com" /><br>
<br>
<label>Password</label>
<input id="password" type="password" name="password" placeholder="********" /></br>
<button type="submit" id="track">UPDATE</button>
</div>

</form> 

</div>

<div id="myorders" class="tabcontent"> 
<table>
  <tr>
    <th>PRODUCT</th>
    <th>QUANTITY </th>
    <th>AMOUNT</th>
    <th>STATUS</th>

  </tr>
  <tr>
    <td>Mocha Cake</td>
    <td>1</td>
    <td>####.00</td>
    <td>Ongoing<button id="track">Track</button></td>
  </tr>
  <tr>
    <td>Vanilla Cake</td>
    <td>30</td>
    <td>####.00</td>
    <td>Ongoing<button id="track">Track</button></td>
  </tr>
  <tr>
    <td>Chocolate Cake</td>
    <td>7</td>
    <td>####.00</td>
    <td>Completed</td>
  </tr>
  <tr>
    <td>TOTAL</td>
    <td></td>
    <td>####.00</td>
  </tr>
</table>





<script>
function openPage(pageName,elmnt,color) {

  // this is to hide all elements with class="tabcontent" by default */

  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

   // this is to remove the background color of all tablinks or buttons

  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = color;
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = "";
}

// Get the element with id="defaultOpen" and click on it

// default when you open page 

document.getElementById("defaultOpen").click();
</script>
        </body>
        </html>