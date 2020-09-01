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



#patientTable, #doctorTable, #reservationTable {
  width: 100%	;
  margin-right: 0px;
  margin-left: auto;
  border-collapse: collapse;
  border: 1px solid #ddd;
  font-size: 18px;
}

#patientTable th, #patientTable td, #doctorTable th, #doctorTable td, #reservationTable th, #reservationTable td {
  text-align: right;
  padding: 12px;
}

#patientTable tr, #doctorTable tr, #reservationTable tr {
  border-bottom: 1px solid #ddd;
}

#patientTable tr.header, #patientTable tr:hover, #doctorTable tr.header, #doctorTable tr:hover, #reservationTable tr.header, #reservationTable tr:hover {
  background-color: #f1f1f1;
}
</style>
</head>
<body>
<title>إستعلام</title>
<link rel="stylesheet" type="text/css" href="style.css">


<div class="header">
  	<h2>إستعلام</h2>
  </div>
  
  
<form id="form" method="post" action="queryHospital.php" >




<!--Query patients-->
<?php if (isset($_SESSION['queriedPatientsBack'])) : ?>

	<input type="text" class="myInput" id="patientIn1" onkeyup="updatePatients()" placeholder="...البحث بأستخدام اسم المستخدم" title="Type in a username">

	<input type="text" class="myInput" id="patientIn2" onkeyup="updatePatients()" placeholder="...البحث بأستخدام الأسم" title="Type in a name">

	<input type="text" class="myInput" id="patientIn3" onkeyup="updatePatients()" placeholder="...البحث بأستخدام رقم الهاتف" title="Type in number">

	

	<table id="patientTable" DIR="RTL">
	
	  <tr >
		<th style="width:10%;">أسم المستخدم</th>
		<th style="width:20%;">الأسم</th>
		<th style="width:10%;">رقم الهاتف</th>
		<th style="width:20%;">البريد الألكتروني</th>
		<th style="width:20%;">العنوان</th>
		<th style="width:10%;">نوع الجنس</th>
		<th style="width:10%;">التوقيت الزمني لأخر تسجيل دخول</th>
		
	  </tr>
	  
	  
	  <?php
		  $array = $_SESSION['queriedPatients'];
		  foreach($array as $item) {
			  echo '<tr>';
				echo '<td>'.$item["username"].'</td>';
				echo '<td>'.$item["name"].'</td>';
				echo '<td>'.$item["phoneNumber"].'</td>';
				echo '<td>'.$item['email'].'</td>';
				echo '<td>'.$item['address'].'</td>';
				echo '<td>'.$item['gender'].'</td>';
				echo '<td>'.$item['lastLoginDate'].'</td>';
				echo '</tr>';
		
			}
			
			
	  ?>
	  </table>
	  <?php endif; ?>


	  
	  <!--Query doctors-->
	  <?php if (isset($_SESSION['queriedDoctorsBack'])) : ?>
	<input type="text" class="myInput" id="doctorIn1" onkeyup="updateDoctors()" placeholder="...البحث بأستخدام الأسم" title="Type in a name">

	<input type="text" class="myInput" id="doctorIn2" onkeyup="updateDoctors()" placeholder="...البحث بأستخدام درجة الطبيب" title="Type in doctor's type">

	<input type="text" class="myInput" id="doctorIn3" onkeyup="updateDoctors()" placeholder="...البحث بأستخدام تخصص الطبيب" title="Type in doctor's specialization">

	<table id="doctorTable" DIR="RTL">
	
	  <tr >
		<th style="width:20%;">الأسم</th>
		<th style="width:15%;">درجة الطبيب</th>
		<th style="width:15%;">التخصص</th>
		<th style="width:15%;">رقم الهاتف</th>
		<th style="width:20%;">العوان</th>
		<th style="width:15%;">نوع الجنس</th>
	  </tr>
	  
	  
	  <?php
		  $array = $_SESSION['queriedDoctors'];
		  foreach($array as $item) {
			  echo '<tr>';
				echo  '<td>'.$item['name'].'</td>';
				echo  '<td>'.$item['docType'].'</td>';
				echo  '<td>'.$item['specialization'].'</td>';
				echo  '<td>'.$item['phoneNumber'].'</td>';
				echo '<td>'.$item['address'].'</td>';
				echo '<td>'.$item['gender'].'</td>';
				echo '</tr>';
		
			}
			
			
	  ?>
	  </table>
	  <?php endif; ?>
	  
	  

	  <!--Query reservations-->
	  <?php if (isset($_SESSION['queriedReservationsBack'])) : ?>
	<input type="text" class="myInput" id="reservationIn1" onkeyup="updateReservations()" placeholder="...البحث بأستخدام أسم المريض" title="Type in patient's name">

	<input type="text" class="myInput" id="reservationIn2" onkeyup="updateReservations()" placeholder="...البحث بأستخدام أسم الطبيب" title="Type in doctor's name">

	<input type="text" class="myInput" id="reservationIn3" onkeyup="updateReservations()" placeholder="...البحث بأستخدام تخصص الطبيب" title="Type in doctor's specialization">

	<table id="reservationTable" DIR="RTL">
	
	  <tr >
		<th style="width:20%;">أسم المريض</th>
		<th style="width:20%;">أسم الطبيب</th>
		<th style="width:20%;">تخصص الطبيب</th>
		<th style="width:20%;">درجة الطبيب</th>
		<th style="width:20%;">تم التأكيد</th>
	  </tr>
	  
	  
	  <?php
		  $array = $_SESSION['queriedReservations'];
		  foreach($array as $item) {
				echo '<tr>';
				echo '<td>'.$item['patientName'].'</td>';
				echo '<td>'.$item['doctorName'].'</td>';
				echo '<td>'.$item['specialization'].'</td>';
				echo '<td>'.$item['docType'].'</td>';
				if($item['confirmation'])
				echo '<td>'.'نعم'.'</td>';
			else 
				echo '<td>'.'لا'.'</td>';
				echo '</tr>';
		
			}
			
			
	  ?>
	  </table>
	  <?php endif; ?>
	  
	<br>
	<button   type="submit" class="btn" name="queryReservations">الاستعلام عن الحجوزات</button>
	
	<button   type="submit" class="btn" name="queryDoctors">الاستعلام عن الأطباء</button>
	
	<button   type="submit" class="btn" name="queryPatients">الاستعلام عن المرضى</button>
	
	<br>
	<br>
	<button   type="button" class="btn" name="home" onclick="location.href = 'index.php';">الصفحة الرئيسية</button>
</form>

<script>


function updatePatients() {
  var input, input2, input3, filter, filter2, filter3, table, tr, td, td2, td3, i, txtValue, txtValue2, txtValue3;
  input = document.getElementById("patientIn1");
  input2 = document.getElementById("patientIn2");
  input3 = document.getElementById("patientIn3");
  filter = input.value.toUpperCase();
  filter2 = input2.value.toUpperCase();
  filter3 = input3.value.toUpperCase();
  table = document.getElementById("patientTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    td2 = tr[i].getElementsByTagName("td")[1];
    td3 = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      txtValue2 = td2.textContent || td2.innerText;
      txtValue3 = td3.textContent || td3.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1 && txtValue2.toUpperCase().indexOf(filter2) > -1 && txtValue3.toUpperCase().indexOf(filter3) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function updateDoctors() {
  var input, input2, input3, filter, filter2, filter3, table, tr, td, td2, td3, i, txtValue, txtValue2, txtValue3;
  input = document.getElementById("doctorIn1");
  input2 = document.getElementById("doctorIn2");
  input3 = document.getElementById("doctorIn3");
  filter = input.value.toUpperCase();
  filter2 = input2.value.toUpperCase();
  filter3 = input3.value.toUpperCase();
  table = document.getElementById("doctorTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    td2 = tr[i].getElementsByTagName("td")[1];
    td3 = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      txtValue2 = td2.textContent || td2.innerText;
      txtValue3 = td3.textContent || td3.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1 && txtValue2.toUpperCase().indexOf(filter2) > -1 && txtValue3.toUpperCase().indexOf(filter3) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function updateReservations() {
  var input, input2, input3, filter, filter2, filter3, table, tr, td, td2, td3, i, txtValue, txtValue2, txtValue3;
  input = document.getElementById("reservationIn1");
  input2 = document.getElementById("reservationIn2");
  input3 = document.getElementById("reservationIn3");
  filter = input.value.toUpperCase();
  filter2 = input2.value.toUpperCase();
  filter3 = input3.value.toUpperCase();
  table = document.getElementById("reservationTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    td2 = tr[i].getElementsByTagName("td")[1];
    td3 = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      txtValue2 = td2.textContent || td2.innerText;
      txtValue3 = td3.textContent || td3.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1 && txtValue2.toUpperCase().indexOf(filter2) > -1 && txtValue3.toUpperCase().indexOf(filter3) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}


</script>


</body>
</html>
