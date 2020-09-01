<!DOCTYPE html>
<html>
<head>
  <title>إضافة طبيب</title>
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
		if (specialization == ""){
			errors.push(".يجب ملء خانة التخصص");
			numerrors++;
		}
		if(docType == ""){
			errors.push(".يجب ملء خانة درجة الطبيب");
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
  	<h2>إضافة طبيب</h2>
  </div>
  
	
  <form name= "reg" method="post" action="addDoctor.php" onsubmit="return validate();">
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
  	  <label>أسم الطبيب كامل</label>
  	  <input id="name" type="text" name="name">
  	</div>
	<div class="input-group">
  	  <label>عنوان الطبيب</label>
  	  <input id="address" type="text" name="address">
  	</div>
	<div class="input-group">
  	  <label>رقم هاتف الطبيب</label>
  	  <input id="phoneNumber" type="text" name="phoneNumber">
  	</div>
	<div >
	
  	  <label>نوع جنس الطبيب </label>
  	   <label  class="radio-inline"><input  type="radio" value="ذكر" name="gender">ذكر</label>
		<label  class="radio-inline"><input type="radio" value="أنثى" name="gender">أنثى</label>
  	</div>
	<div class="input-group">
  	  <label>درجة الطبيب</label>
  	  <input id="docType" type="text" name="docType">
  	</div>
	<div class="input-group">
  	  <label>تخصص الطبيب</label>
  	  <input id="specialization" type="text" name="specialization">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="add_doctor">إضافة الطبيب</button>
  	</div>
	<button   type="button" class="btn" name="search_doctors" onclick="location.href = 'index.php';">الصفحة الرئيسية</button>
  </form>
</body>
</html>