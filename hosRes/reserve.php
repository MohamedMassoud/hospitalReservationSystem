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
<title>حجز طبيب</title>
<link rel="stylesheet" type="text/css" href="style.css">


<div class="header">
  	<h2>حجز طبيب</h2>
  </div>

<form id="form" method="post" action="reserve.php" >
	<?php include('errors.php'); ?>
	<!-- notification message -->
  	<?php if (isset($_SESSION['reserved'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
		  
          	echo $_SESSION['reserved']; 
          	
          ?>
      	</h3>
      </div>
  	<?php endif ?>
	
<?php if (isset($_SESSION['docsBack'])) : ?>
	<input type="text" class="myInput" id="myInput" onkeyup="updateDoctors()" placeholder="... البحث بأسم الطبيب" title="Type in a name">

	<input type="text" class="myInput" id="myInput2" onkeyup="updateDoctors()" placeholder="... البحث بدرجة الطبيب" title="Type in a docType">

	<input type="text" class="myInput" id="myInput3" onkeyup="updateDoctors()" placeholder="... البحث بتخصص الطبيب" title="Type in a specialization">

	<table id="myTable"  DIR="RTL">
	
	  <tr >
		<th style="width:40%;">الأسم</th>
		<th style="width:25%;">درجة الطبيب</th>
		<th style="width:25%;">التخصص</th>
		<th style="width:10%;">حجز</th>
	  </tr>
	  
	  
	  <?php
		  $array = $_SESSION['doctors'];
		  foreach($array as $item) {
			  echo '<tr id="',$item["DID"],'">';
				echo  '<td>'.$item["name"].'</td>';
				echo '<td>'.$item['docType'].'</td>';
				echo '<td>'.$item['specialization'].'</td>';
				echo '<td><button type="submit" class="btn"  name="reserve" value="',$item["DID"],'">حجز</button> </td>';
				echo '</tr>';
		
			}
			endif;
	  ?>
	  
	  
	</table>
	
	<?php if (isset($_SESSION['reserved'])){
			echo '<script>var elem = document.getElementById(\''.$_SESSION["currentReservation"].'\');elem.parentNode.removeChild(elem);</script>';
			unset($_SESSION['reserved']);
		}
		 ?>
	<?php if(!isset($_SESSION['docsBack'])) :?>
	<button  id="searchit" type="submit" class="btn" name="search_doctors">بحث</button>
	<br>
	<?php endif; ?>
	<br>
	<button   type="button" class="btn" name="home" onclick="location.href = 'index.php';">الصفحة الرئيسية</button>
</form>
<script>


function updateDoctors() {
  var input, input2, input3, filter, filter2, filter3, table, tr, td, td2, td3, i, txtValue, txtValue2, txtValue3;
  input = document.getElementById("myInput");
  input2 = document.getElementById("myInput2");
  input3 = document.getElementById("myInput3");
  filter = input.value.toUpperCase();
  filter2 = input2.value.toUpperCase();
  filter3 = input3.value.toUpperCase();
  table = document.getElementById("myTable");
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
