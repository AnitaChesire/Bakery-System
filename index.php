<?php

include_once('includes/connection.php');

if (isset($_POST['updatePas'])) {

  $paswrdUp = $_POST['paswrdUp'];
  $emailUp = $_POST['emailUp'];

  $query = "UPDATE  users SET password = '$paswrdUp', email = '$emailUp' ";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo '<script> alert("Data Updated") </script>';
  } else {
    echo '<script type="text/javascript" alert("Data Has NOT been Updated") </script>';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
  <title>ABC abc_bakery</title>
  <link rel="stylesheet" href="style.css">

  <script>
    // validate the log in form 
    function validateLogIn() {

      loginemail = document.getElementById("loginemail").value;
      loginpaswrd = document.getElementById("loginpaswrd").value;
      logIn = document.getElementById("log-in");

      //Check for Empty Fields

      if (loginemail == "" || loginpaswrd == "") {
        alert("You must fill all fields");

        return false;
      }
      //check for the occurrence of @ in the string, If it returns  -1 then the  character was not found
      //check for the occurrence of . in the string, If it returns  -1 then the  character was not found

      if (loginemail.indexOf("@") == -1 || loginemail.indexOf(".") == -1) {
        alert("You must enter a valid email");
        return false;
      } else {
        true;
      }
      //variable with password requirements upper and lower case,\w means all alpha numeric characters
      //  including underscore, \W includes all non-letter characters like % # etc i.e special characters
      //   also, should not be less 8 and not more than 20 characters

      if (loginpaswrd.match(/[A-Za-z]/) || loginpaswrd.match(/\w/) || loginpaswrd.match(/\W/) || loginpaswrd.match(
          /{7,19}/)) {
        return true;
        logIn.submit();

      } else {
        alert(
          "Password should include upper &lowercase, alphanumeric and special characters and should be between 8 to 20 characters "
          );
        false;
      }
    }
// validate Sign up
    function validateSignUp() {

      fname = document.getElementById("fname").value;
      lname = document.getElementById("lname").value;
      signupemail = document.getElementById("signupemail").value;
      signuppaswrd = document.getElementById("signuppaswrd").value;
      confirmpasswrd = document.getElementById("confirmpasswrd").value;
      signupform = document.getElementById("signupform");

      //Check for Empty Fields

      if (fname == "" || lname == "" || signupemail == "" || signuppaswrd == "" || confirmpasswrd == "") {
        alert("You must fill all fields");

        return false;
      }
      //check for the occurrence of @ in the string, If it returns  -1 then the  character was not found
      //check for the occurrence of . in the string, If it returns  -1 then the  character was not found

      if (signupemail.indexOf("@") == -1 || signupemail.indexOf(".") == -1) {
        alert("You must enter a valid email");
        return false;
      } else {
        return true
      }
      //variable with password requirements upper and lower case,\w means all alpha numeric characters
      //  including underscore, \W includes all non-letter characters like % # etc i.e special characters
      //   also, should not be less 8 and not more than 20 characters
      if (signuppaswrd.match(/[A-Za-z]/) || signuppaswrd.match(/\w/) || signuppaswrd.match(/\W/) || signuppaswrd.match(
          /{7,19}/)) {

        signupform.submit();
        alert("Sign Up was successful, Please log In")

      } else {
        alert(
          "Password should include upper &lowercase, alphanumeric and special characters and should be between 8 to 20 characters "
          );
        return false;
      }
    }

//-------------------- Validate Supplier sign UP 

    function validateSupplierSignUp() {

fname = document.getElementById("firstname").value;
lname = document.getElementById("lastname").value;
signupemail = document.getElementById("emailSupplier").value;
org = document.getElementById("org").value;
signuppaswrd = document.getElementById("paswrdSup").value;
confirmpasswrd = document.getElementById("conpasswrdSup").value;
signupformSupplier = document.getElementById("signupformSupplier");

//Check for Empty Fields

if (fname == "" || lname == "" || signupemail == "" || org == "" || signuppaswrd == "" || confirmpasswrd == "") {
  alert("You must fill all fields");

  return false;
}
//check for the occurrence of @ in the string, If it returns  -1 then the  character was not found
//check for the occurrence of . in the string, If it returns  -1 then the  character was not found

if (signupemail.indexOf("@") == -1 || signupemail.indexOf(".") == -1) {
  alert("You must enter a valid email");
  return false;
} else {
  return true
}
//variable with password requirements upper and lower case,\w means all alpha numeric characters
      //  including underscore, \W includes all non-letter characters like % # etc i.e special characters
      //   also, should not be less 8 and not more than 20 characters
if (signuppaswrd.match(/[A-Za-z]/) || signuppaswrd.match(/\w/) || signuppaswrd.match(/\W/) || signuppaswrd.match(
    /{7,19}/)) {

      signupformSupplier.submit();
  alert("Sign Up was successful, Please log In")

} else {
  alert(
    "Password should include upper &lowercase, alphanumeric and special characters and should be between 8 to 20 characters "
    );
  return false;
}
}

    function validateAdminLogIn() {

      loginId = document.getElementById("loginId").value;
      adminpaswrd = document.getElementById("adminpaswrd").value;
      adminlogIn = document.getElementById("adminlog-in");

      //Check for Empty Fields

      if (loginId == "" || adminpaswrd == "") {
        alert("You must fill all fields");

        return false;
      } else {
        true;
      }
      if (adminpaswrd.match(/[A-Za-z]/) || adminpaswrd.match(/\w/) || adminpaswrd.match(/\W/) || adminpaswrd.match(
          /{7,19}/)) {

        adminlogIn.submit();

      } else {
        alert(
          "Password should include upper &lowercase, alphanumeric and special characters and should be between 8 to 20 characters "
          );
        return false;
      }
    }
  </script>


</head>
<!-- php include 'php/validate.php';?> -->

<body background="bgfront.jpg">
  <img src="logo.png" style="width:30%;display:block;margin-left: auto;margin-right: auto;">



  <div class="flex">

    <!-- Log in Container-->
    <div class="containerx">
      <button class="tablink" onclick="openPage('myLogin', this, '#ff0062')" id="defaultOpen">Log In </button>
      <button class="tablink" onclick="openPage('mySignup', this, '#ff0062')">Sign Up</button>
      <!-- <button class="tablink" onclick="openPage('myprofile', this, '#ff0062')">Forgot your Password? </button> -->
      <button class="tablink" onclick="openPage('myorders', this, '#ff0062')">Supplier Registration</button>

      <div id="myLogin" class="tabContent">
        <br></br>
        <h1 class="lg-title-password">LOG IN </h1>
        <!-- <form id="log-in" action="php/login.php" method="post"> -->
        <form id="log-in" onsubmit="return validateLogIn()" action="includes/logInincludes.php" method="post">
          <div id="loginerror"></div>
          <div class="row">
            <div class="col-25">

              <label for="email">E-Mail</label>
            </div>
            <div class="col-75">
              <input type="text" id="loginemail" name="email" placeholder="Your E-Mail..">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="paswrd">Password</label>
            </div>
            <div class="col-75">
              <input type="password" id="loginpaswrd" name="paswrd" placeholder="Your Password..">
            </div>
          </div>
          <div class="row">

            <input type="submit" name="logIn" value="LOG IN">

          </div>
        </form>
      </div>


      <!-- signup Container-->

      <div id="mySignup" class="tabContent">
        <br></br>
        <h1 class="lg-title-password">SIGN UP </h1>
        <form id="signupform" onsubmit="return validateSignUp()" method="POST" action="includes/signupincludes.php">
          <div class="row"><br></br>
            <div class="col-25">
              <label for="fname">First Name</label>
            </div>
            <div class="col-75">
              <input type="text" id="fname" name="fname" placeholder="Your name..">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="lname">Last Name</label>
            </div>
            <div class="col-75">
              <input type="text" id="lname" name="lname" placeholder="Your last name..">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="email">E-Mail</label>
            </div>
            <div class="col-75">
              <input type="email" id="signupemail" name="email" placeholder="Your E-Mail..">
            </div>
          </div>
          <div class="row">
            <div class="col-75">
              <input type="hidden" id="user_role_id" name="user_role_id" value="2">
            </div>
          </div>
          <div class="row">
            <div class="col-75">
              <input type="hidden" id="orgz" name="orgz" value="n/a">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="paswrd">Password</label>
            </div>
            <div class="col-75">
              <input type="password" id="signuppaswrd" name="paswrd" placeholder="Your Password..">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="passwrd">Confirm Password</label>
            </div>
            <div class="col-75">
              <input type="password" id="confirmpasswrd" name="passwrd" placeholder="Your Password..">
            </div>
          </div>
          <div class="row">
            <input type="submit" name="signUp" value="SIGN UP">
          </div>
        </form>
      </div>


      <div id="myprofile" class="tabContent">
        <h1 class="lg-title-password"> Reset password </h1>

        <form id="form" action="index.php" method="POST">
          <div class="row">
            <div class="col-25">
              <label for="email">E-Mail</label>
            </div>
            <div class="col-75">
              <input type="email" id="email" name="emailUp" placeholder="Your E-Mail..">
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="paswrd">Password</label>
            </div>
            <div class="col-75">
              <input type="password" id="paswrd" name="paswrdUp" placeholder="Your Password..">
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="passwrd">Confirm Password</label>
            </div>
            <div class="col-75">
              <input type="password" id="passwrd" name="passwrdUpCon" placeholder="Your Password..">
            </div>

          </div>
          <input type="submit" name="updatePas" value="RESET">
          <br></br>
        </form>

      </div>

      <div id="myorders" class="tabContent">
      <br></br>
        <h1 class="lg-title-password">SUPPLIER SIGN UP</h1>
        <form id="signupformSupplier" onsubmit="return validateSupplierSignUp()" method="POST" action="includes/supplierincludes.php">
          <div class="row"><br></br>
            <div class="col-25">
              <label for="fname">First Name</label>
            </div>
            <div class="col-75">
              <input type="text" id="firstname" name="firstname" placeholder="Your name..">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="lname">Last Name</label>
            </div>
            <div class="col-75">
              <input type="text" id="lastname" name="lastname" placeholder="Your last name..">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="email">E-Mail</label>
            </div>
            <div class="col-75">
              <input type="email" id="emailSupplier" name="emailSupplier" placeholder="Your E-Mail..">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="organization">Organization</label>
            </div>
            <div class="col-75">
              <input type="text" id="org" name="org" placeholder="Your Organiztion Name ....">
            </div>
          </div>
          <div class="row">
            <div class="col-75">
              <input type="hidden" id="user_role_id" name="user_role_id" value="3">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="paswrd">Password</label>
            </div>
            <div class="col-75">
              <input type="password" id="paswrdSup" name="paswrdSup" placeholder="Your Password..">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="passwrd">Confirm Password</label>
            </div>
            <div class="col-75">
              <input type="password" id="conpasswrdSup" name="conpasswrdSup" placeholder="Confirm Password..">
            </div>
          </div>
          <div class="row">
            <input type="submit" name="signUp" value="SIGN UP">
          </div>
        </form>
      </div>


      <script>
        function openPage(pageName, elmnt, color) {
          //  Hide all elements with class="tabcontent" by default 

          var i, tabContent, tablinks;
          tabContent = document.getElementsByClassName("tabContent");
          for (i = 0; i < tabContent.length; i++) {
            tabContent[i].style.display = "none";
          }
          // Remove the background color of all tablinks/buttons
          tablinks = document.getElementsByClassName("tablink");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
          }
          // Show the tab content of the tab clicked 
          document.getElementById(pageName).style.display = "block";

          // Add the specific color to the button used to open the tab content
          elmnt.style.backgroundColor = color;
        }

        // Get the element with id="defaultOpen" and click on it (by default)
        document.getElementById("defaultOpen").click();
      </script>
    </div>

</body>

</html>