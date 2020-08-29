<!DOCTYPE html>
<html>
<head>
  <title>Sign up</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <script>
	function validate(){

		var name = document.getElementById("name").value;
		var address = document.getElementById("address").value;
		var phoneNumber = document.getElementById("phoneNumber").value;
		var gender = document.forms["reg"]["gender"].value;
		var specialization = document.getElementById("specialization").value;
		var docType = document.getElementById("docType").value;
		var errors=[""];
		var numerrors=0;
		
		
		
		
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
		if (specialization == ""){
			errors.push("Specialization can't be empty.");
			numerrors++;
		}
		if(docType == ""){
			errors.push("Doctor type can't be empty.");
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
	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
	<div>
	<p id="hint"></p>
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
  	  <label>Doctor type</label>
  	  <input id="docType" type="text" name="docType">
  	</div>
	<div class="input-group">
  	  <label>Specialization</label>
  	  <input id="specialization" type="text" name="specialization">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="add_doctor">Add doctor</button>
  	</div>
  </form>
</body>
</html>