<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>الصفحة الرئيسية</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>الصفحة الرئيسية</h2>
</div>
<div class="content" ">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" ">
      	<h3>
          <?php 
		  
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p><strong><?php echo $_SESSION['username']; ?></strong>  مرحباً </p>
		<p> تم تسجيل الدخول ك <strong> <?php echo $_SESSION['accType']; ?> </strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">تسجيل الخروج</a> </p>
    <?php endif ?>
	
	<?php if($_SESSION['accType'] == 'مريض') : ?>
		<br>
		<input class="btn" type="button" value="حجز" name="reserve" onClick="document.location.href='reserve.php'" />
	<?php endif ?>
	<?php  if ($_SESSION['accType'] == 'ممرضة') : ?>
	<br>
    	<input class="btn" type="button" value="تأكيد الحجوزات"  onClick="document.location.href='resConfirmation.php'" />
		<input class="btn" type="button" value="إضافة طبيب" onClick="document.location.href='addDoctor.php'" />
		<input class="btn" type="button" value="إستعلام" onClick="document.location.href='queryHospital.php'" />
    <?php endif ?>
	
	
	
</div>
		
</body>
</html>