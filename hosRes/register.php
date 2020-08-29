<!DOCTYPE html>
<html>
<head>
  <title>Sign up</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <script>
	function validate(){
		var usr = document.getElementById("usr").value;
		var pw1 = document.getElementById("pw1").value;
		var pw2 = document.getElementById("pw2").value;
		var em = document.getElementById("em").value;
		var name = document.getElementById("name").value;
		var address = document.getElementById("address").value;
		var phoneNumber = document.getElementById("phoneNumber").value;
		var gender = document.forms["reg"]["gender"].value;
		
		var errors=[""];
		var numerrors=0;
		
		if(usr==""){
			
			errors.push("Username can't be empty.");
			numerrors++;
			
		}
		if(pw1==""){
			errors.push("Password can't be empty.");
			numerrors++;
		}else if(pw1!=pw2){
			errors.push("Passwords don't match.");
			numerrors++;
		}
		
		if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(em))){
			errors.push("Invalid Email address.");
			numerrors++;
		}
		if(name==""){
			errors.push("Name can't be empty.");
			numerrors++;
		}
		if(address ==""){
			errors.push("Address can't be empty.");
			numerrors++;
		}
		var phoneno = /^\d{11}$/;
		if(phoneNumber == ""){
			errors.push("Phone number can't be empty.");
		}else if(!phoneNumber.match(phoneno)){
			errors.push("Phone number is not valid.");
			numerrors++;
		}
		if (gender == ""){
			errors.push("Gender can't be empty.");
			numerrors++;
		}
		
		if(numerrors!=0){
			document.getElementById("hint").innerHTML = errors.toString().replace(/,/g, "<br>").fontcolor("red");
			return false;
		}else{
			<?php include('server.php') ?>
			return true;
		}
	}
  </script>
  
  
  
</head>
<body>
  <div class="header">
  	<h2>Sign up</h2>
  </div>
	
  <form name= "reg" method="post" action="register.php" onsubmit="return validate();">
  	<?php include('errors.php'); ?>
	
	<div>
	<p id="hint"></p>
	</div>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input id="usr" type="text" name="username">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input id="em" type="text" name="email">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input id="pw1" type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input id="pw2" type="password" name="password_2">
  	</div>
	<div class="input-group">
  	  <label>Full name</label>
  	  <input id="name" type="text" name="name">
  	</div>
	<div class="input-group">
  	  <label>Address</label>
  	  <input id="address" type="text" name="address">
  	</div>
	<div class="input-group">
  	  <label>Phone number</label>
  	  <input id="phoneNumber" type="text" name="phoneNumber">
  	</div>
	<div >
  	  <label>Gender: </label>
  	   <label  class="radio-inline"><input  type="radio" value="male" name="gender">Male</label>
		<label  class="radio-inline"><input type="radio" value="female" name="gender">Female</label>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Sign up</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>