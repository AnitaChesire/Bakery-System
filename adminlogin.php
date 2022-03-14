<!DOCTYPE html>
<html lang="en">

<head>
	
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


	<title>admin</title>
	<script defer src="js/adminlogin.js"></script>
	<script defer src="js/adminsignup.js"></script>
</head>

<body>
	<img src="pinkmarblebackground.jpg" class="backg">





	<!---adding nav bar--->



	<label class="logo">ABC BAKERY</label>



	<!---end of Nav bar-->
	<div class="admin-login">
<p>ADMIN LOG IN</p>
</div>
<br></br>

	<form id="admin-loginform" action="adminpanel.php" method="POST">
		<div id="loginbox">
			<img src="images/user.png" class="user">
			<h1> LOG IN</h1>
			<br>
			<div id="adminerror"></div>
			<br>
			<div>
				<label for="staffid">Staff ID</label>
				<br>
				<input id="staffid" name="staffid" type="text" placeholder="Enter your Staff Id" />
				<br></br>
			</div>
			<div>
				<label for="password">Password</label>
				<br>
				<input id="adminPassword" name="adminPassword" type="password" placeholder="Enter your password" />
				<br></br>
			</div>
			<button type="submit">LOG IN</button>
			<br></br>
			
		</div>
	</form>

	<!----sign up side---->


	<form id="admin-signupform">

		<div id="signinbox" action="adminpanel.php">
			<img src="images/user.png" class="user">
			<h1> SIGN UP</h1>

			<br>

			<div id="signuperror"></div>
			<br>
			<div>
				<label for="staff-name" name="staff-name">Staff's Name</label>
				<br>
				<input id="txtStaffName" type="text" name="username" placeholder="Enter your name" />
				
			</div>

			<br>

			<div>
				<label for="staffId" name="email">Staff ID </label>
				<br>
				<input id="txtStaffId" type="text" name="txtStaffId" placeholder="Enter your staff Id" />
				
			</div>

			<br>

			<div>
				<label for="AdminPassword" name="pwd">Password</label>
				<br>
				<input id="adminsignupPassword" type="password" name="adminsignupPassword" placeholder="Enter your password" />
				
			</div>
			<br>

			<div>
				<label for="conpwd" name="conpwd">Confirm Password</label>
				<br>
				<input id="adminsignupconPwd" type="password" name="adminsignupconPwd" placeholder="Confirm your password" />
				
			</div>
			<br>

			<button type="submit">SIGN UP</button>
			<br>

		</div>


	</form>
</body>

</html>