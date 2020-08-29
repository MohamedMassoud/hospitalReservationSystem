<!DOCTYPE html>
<html>
<head>

  <title>Sign in</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <script>
	function validate(){
		var usr = document.getElementById("usr").value;
		var pw = document.getElementById("pw").value;
		var errors=[""];
		var numerrors=0;
		
		if(usr==""){
			
			errors.push("Username can't be empty");
			numerrors++;
			
		}
		if(pw==""){
			errors.push("Password can't be empty");
			numerrors++;
		}
		
		
		if(numerrors!=0){
			document.getElementById("hint").innerHTML = errors.toString().replace(",", " ").fontcolor("red");
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
  	<h2>Sign in</h2>
  </div>
	 
  <form id="form" method="post" action="login.php" onsubmit="return validate();">
  <?php include('errors.php') ?>
  
  <div>
	<p id="hint"></p>
	</div>

  	<div class="input-group">
	
  		<label>Username</label>
  		<input id="usr" type="text" name="username" >
  	</div>
	
	
  	<div class="input-group">
  		<label>Password</label>
  		<input id="pw" type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Sign in</button>
  	</div>
	<p>
  		Not yet a member?

		<a href="register.php"> Signup <a/>
  </p>
  
  	
  </form>
</body>
</html>