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
			
			errors.push(".يجب ملء خامة أسم المستخدم");
			numerrors++;
			
		}
		if(pw1==""){
			errors.push(".يجب ملء خانة كلمة السر");
			numerrors++;
		}else if(pw1!=pw2){
			errors.push(".كلمتا السر غير متطابقتان");
			numerrors++;
		}
		
		if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(em))){
			errors.push(".البريد الالكتروني غير صحيح");
			numerrors++;
		}
		if(name==""){
			errors.push(".يجب ملء خانة الأسم");
			numerrors++;
		}
		if(address ==""){
			errors.push(".يجب ملء خانة العنوان");
			numerrors++;
		}
		var phoneno = /^\d{11}$/;
		if(phoneNumber == ""){
			errors.push(".يجب ملء خانة رقم الهاتف");
		}else if(!phoneNumber.match(phoneno)){
			errors.push(".رقم الهاتف غير صحيح");
			numerrors++;
		}
		if (gender == ""){
			errors.push(".يجب ملء خانة نوع الجنس");
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
  	<h2>إنشاء حساب جديد</h2>
  </div>
	
  <form name= "reg" method="post" action="register.php" onsubmit="return validate();">
  	<?php include('errors.php'); ?>
	
	<div>
	<p id="hint"></p>
	</div>
  	<div class="input-group">
  	  <label>أسم المستخدم</label>
  	  <input id="usr" type="text" name="username">
  	</div>
  	<div class="input-group">
  	  <label>البريد الالكتروني</label>
  	  <input id="em" type="text" name="email">
  	</div>
  	<div class="input-group">
  	  <label>كلمة السر</label>
  	  <input id="pw1" type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>إعادة كتابة كلمة السر</label>
  	  <input id="pw2" type="password" name="password_2">
  	</div>
	<div class="input-group">
  	  <label>الأسم الكامل</label>
  	  <input id="name" type="text" name="name">
  	</div>
	<div class="input-group">
  	  <label>العنوان</label>
  	  <input id="address" type="text" name="address">
  	</div>
	<div class="input-group">
  	  <label>رقم الهاتف</label>
  	  <input id="phoneNumber" type="text" name="phoneNumber">
  	</div>
	<div >
  	  <label>نوع الجنس </label>
  	   <label  class="radio-inline"><input  type="radio" value="male" name="gender">ذكر</label>
		<label  class="radio-inline"><input type="radio" value="female" name="gender">أنثى</label>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">أنشأ حساب جديد</button>
  	</div>
  	<p>
  		تمتلك حساب؟ <a href="login.php">تسجيل الدخول</a>
  	</p>
  </form>
</body>
</html>