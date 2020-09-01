<!DOCTYPE html>
<html>
<head>

  <title>تسجيل الدخول</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <script>
	function validate(){
		var usr = document.getElementById("usr").value;
		var pw = document.getElementById("pw").value;
		var errors=[""];
		var numerrors=0;
		
		if(usr==""){
			
			errors.push(".يجب ملء خانة أسم المستخدم");
			numerrors++;
			
		}
		if(pw==""){
			errors.push(".يجب ملء خانة كلمة السر");
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
  	<h2>تسجيل الدخول</h2>
  </div>
	 
  <form id="form" method="post" action="login.php" onsubmit="return validate();">
  <?php include('errors.php') ?>
  
  <div>
	<p id="hint"></p>
	</div>

  	<div class="input-group">
	
  		<label>أسم المستخدم</label>
  		<input id="usr" type="text" name="username" >
  	</div>
	
	
  	<div class="input-group">
  		<label>كلمة السر</label>
  		<input id="pw" type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">تسجيل الدخول</button>
  	</div>
	<p>
  		لا تمتلك حساب؟

		<a href="register.php"> إنشاء حساب جديد <a/>
  </p>
  
  	
  </form>
</body>
</html>