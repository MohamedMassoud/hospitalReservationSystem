<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

.myInput {
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}



#myTable {
  width: 100%	;
  margin-right: 0px;
  margin-left: auto;
  border-collapse: collapse;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: right;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
</head>
<body>
<title>تأكيد الحجوزات</title>
<link rel="stylesheet" type="text/css" href="style.css">


<div class="header">
  	<h2>تأكيد الحجوزات</h2>
  </div>

<form id="form" method="post" action="resConfirmation.php" >
	<?php include('errors.php'); ?>
	
	<!-- notification message -->
	<?php if (isset($_SESSION['confirmed'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
		  
          	echo $_SESSION['confirmed']; 
          	
			
		
			
          ?>
      	</h3>
      </div>
  	<?php endif ?>

		
<?php if (isset($_SESSION['resBack'])) : ?>

	<table id="myTable" DIR="RTL">
	
	  <tr >
		<th style="width:20%;">أسم المريض</th>
		<th style="width:20%;">أسم الطبيب</th>
		<th style="width:20%;">تخصص الطبيب</th>
		<th style="width:20%;">درجة اطبيب</th>
		<th style="width:20%;">تأكيد</th>
	  </tr>
	  
	  
	  <?php
		  $array = $_SESSION['reservations'];
		  //print_r($array);
		  foreach($array as $item) {
			  echo '<tr id="',$item["patientUsername"]." ".$item["DID"],'">';
				echo  '<td>'.$item['patientName'].'</td>';
				echo '<td>'.$item['doctorName'].'</td>';
				echo '<td>'.$item['specialization'].'</td>';
				echo '<td>'.$item['docType'].'</td>';
				echo '<td><button  type="submit" class="btn"  name="confirmReservation" value="',$item["patientUsername"]." ".$item["DID"],'">تأكيد</button> </td>';
				echo '</tr>';
		
			}
			endif;
			
	  ?>
	  
	  
	</table>
		
		
		<?php if (isset($_SESSION['confirmed'])){
			echo '<script>var elem = document.getElementById(\''.$_SESSION["currentConfirmation"].'\');elem.parentNode.removeChild(elem);</script>';
			unset($_SESSION['confirmed']);
		}
		 ?>
		
		
  	
	<?php if(!isset($_SESSION['resBack'])) :?>
	<button  id="searchit" type="submit" class="btn" name="search_reservations">بحث</button>
	<br>
	<?php endif; ?>
	<br>
	<button   type="button" class="btn" name="home" onclick="location.href = 'index.php';">الصفحة الريئسية</button>
</form>
<script>




function removeBtn(val) {
	//alert(val);
    var elem = document.getElementById(val);
    return elem.parentNode.removeChild(elem);
	
    
}

/*onClick="removeBtn(\'',$item["patientUsername"]." ".$item["DID"],'\');"*/

//update reservations set confirmed = 0 where true;


</script>


</body>
</html>
