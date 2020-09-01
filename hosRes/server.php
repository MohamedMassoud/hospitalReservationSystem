<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$name = "";
$address = "";
$phoneNumber = "";
$gender = "";
$errors = array(); 
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'hospital');

if (mysqli_connect_errno()) {
  echo "Failed to connect to Database: " . mysqli_connect_error();
}
//if (isset($_POST['patient_signup'])) 

// REGISTER USER
if (isset($_POST['reg_user'])) {
	//if(isset($_POST['patient_signup'])){
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $phoneNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  



  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM patients WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "أسم المستخدم مستخدم بالعفل");
    }

    if ($user['email'] === $email) {
      array_push($errors, "البريد الألكتروني مستخدم بالفعل");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
	  $_SESSION['accType'] = "مريض";
  	$password = md5($password_1);//encrypt the password before saving in the database
	$date = date('y-m-d H:i:s');

  	$query = "INSERT INTO patients (username, email, password, regDate, lastLoginDate, name, address, phoneNumber, gender) 
  			  VALUES('$username', '$email', '$password', '$date', '$date', '$name', '$address', '$phoneNumber', '$gender')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "تم تسجيل الدخول بنجاح";
  	header('location: index.php');
		}
	
}
//LOGIN_USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  

  if (count($errors) == 0) {
	  //Patient Account
  	$password = md5($password);
  	$query = "SELECT * FROM patients WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
	  $_SESSION['accType'] = "مريض";
	  $date = date('y-m-d H:i:s');
	  $query = "UPDATE patients SET lastLoginDate = '$date' WHERE username='$username' AND password='$password'";
	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "تم تسجيل الدخول بنجاح";
	  mysqli_query($db, $query);
  	  header('location: index.php');
  	}else{
		//Nurse Account
		
		$query = "SELECT * FROM nurses WHERE username='$username' AND password='$password'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1) {
		$_SESSION['accType'] = "ممرضة";
		$date = date('y-m-d H:i:s');
		$query = "UPDATE nurses SET lastLoginDate = '$date' WHERE username='$username' AND password='$password'";
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "تم تسجيل الدخول بنجاح";
		mysqli_query($db, $query);
		header('location: index.php');
		}else{
			array_push($errors, "بيانات تسجيل الدخول خاطئة");
		}
		
		
  		
  	}
  }
}
//Search doctors
if (isset($_POST['search_doctors'])){
	$username = $_SESSION['username'];
	$query = "SELECT name, specialization, docType, DID FROM doctors
	WHERE DID NOT IN (SELECT doctorDID FROM reservations WHERE patientUsername = '$username')";	
	
	/*$query = "SELECT doctors.name, doctors.specialization, doctors.docType, doctors.DID
			FROM ((reservations 
			INNER JOIN patients ON reservations.patientUsername = patients.username)
			INNER JOIN doctors ON reservations.doctorDID = doctors.DID)
			WHERE patients.Username=reservations.patientUsername";*/
	
	
	
	$result = mysqli_query($db, $query);

	$rows = [];
	while($row = mysqli_fetch_array($result))
	{
		$rows[] = $row;
	}
	
	
	
	$_SESSION['doctors'] = $rows;
	$_SESSION['docsBack'] = true;
	
	//header('location: reserve.php');
}

//Add doctor

if (isset($_POST['add_doctor'])){
	$date = date('y-m-d H:i:s');
	$name = mysqli_real_escape_string($db, $_POST['name']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$phoneNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
	$gender = mysqli_real_escape_string($db, $_POST['gender']);
	$docType = mysqli_real_escape_string($db, $_POST['docType']);
	$specialization = mysqli_real_escape_string($db, $_POST['specialization']);
	$query = "INSERT INTO doctors ( regDate, name, address, phoneNumber, gender, docType, specialization) 
  			  VALUES('$date', '$name', '$address', '$phoneNumber', '$gender', '$docType', '$specialization')";
  	mysqli_query($db, $query);
  	//$_SESSION['username'] = $username;
  	$_SESSION['success'] = "تمت إضافة الطبيب بنجاح";
  	//header('location: addDoctor.php');
	}
		
//Reserve
	if (isset($_POST['reserve'])){
		
		$patientUsername = $_SESSION['username'];
		$DID = $_POST['reserve'];
		
		$reservationQuery = "SELECT * FROM reservations WHERE patientUsername='$patientUsername' AND doctorDID='$DID' LIMIT 1";
		$result = mysqli_query($db, $reservationQuery);
		$reservationRes = mysqli_fetch_assoc($result);
		
		if($reservationRes){
			
			array_push($errors, "تم الحجز بالفعل مع هذا الطبيب");
			
		}else{
			$query = "INSERT INTO reservations (patientUsername, doctorDID) VALUES ('$patientUsername', '$DID')";
			mysqli_query($db, $query);
			$_SESSION['reserved'] = "تم الحجز بنجاح";
			$_SESSION['currentReservation'] = $DID;


			$username = $_SESSION['username'];
			$query = "SELECT name, specialization, docType, DID FROM doctors
			WHERE DID NOT IN (SELECT doctorDID FROM reservations WHERE patientUsername = '$username')";	
			$result = mysqli_query($db, $query);

			$rows = [];
			while($row = mysqli_fetch_array($result))
			{
				$rows[] = $row;
			}
			
			
			
			$_SESSION['doctors'] = $rows;
		}
		
		//header('location: reserve.php');
	}
	
	// Search reservations
	if(isset($_POST['search_reservations'])){
		$query = "SELECT patients.name AS 'patientName', doctors.name AS 'doctorName',
		doctors.specialization AS 'specialization', doctors.docType AS 'docType',
		doctors.DID AS 'DID', patients.username AS 'patientUsername'
		FROM ((reservations 
		INNER JOIN patients ON reservations.patientUsername = patients.username)
		INNER JOIN doctors ON reservations.doctorDID = doctors.DID)
		WHERE reservations.confirmed = '0';";
		
		$result = mysqli_query($db, $query);
		$rows = [];
		while($row = mysqli_fetch_array($result))
		{
			$rows[] = $row;
		}
		$_SESSION['reservations'] = $rows;
		$_SESSION['resBack'] = true;
		
	}
	
	// Confirm reservations
	
	if(isset($_POST['confirmReservation'])){
		$value = $_POST['confirmReservation'];
		$pieces = explode(" ", $value);
		$patientUsername = $pieces[0];
		$DID = $pieces[1];
		
		$checkQuery = "SELECT * FROM reservations WHERE patientUsername = '$patientUsername' AND doctorDID = '$DID' AND confirmed = 1 LIMIT 1 ";
		$result = mysqli_query($db, $checkQuery);
		$confirmationRes = mysqli_fetch_assoc($result);
		
		if($confirmationRes){
			array_push($errors, "تم تأكيد هذا الحجز بالفعل");
		}else{
			$query = "UPDATE reservations SET confirmed = 1 WHERE  patientUsername='$patientUsername' AND doctorDID = '$DID'";
			mysqli_query($db, $query);
			$_SESSION['confirmed'] = "تم التأكيد بنجاح";
			$_SESSION['currentConfirmation'] = $value;
			
			
			
			$query = "SELECT patients.name AS 'patientName', doctors.name AS 'doctorName',
			doctors.specialization AS 'specialization', doctors.docType AS 'docType',
			doctors.DID AS 'DID', patients.username AS 'patientUsername'
			FROM ((reservations 
			INNER JOIN patients ON reservations.patientUsername = patients.username)
			INNER JOIN doctors ON reservations.doctorDID = doctors.DID)
			WHERE reservations.confirmed = '0';";
			
			$result = mysqli_query($db, $query);
			$rows = [];
			while($row = mysqli_fetch_array($result))
			{
				$rows[] = $row;
			}
			$_SESSION['reservations'] = $rows;
		}
		
	}
	
	//Query patients
	if(isset($_POST['queryPatients'])){
		$query = "SELECT username, name, email, address, gender, lastLoginDate, phoneNumber
		FROM patients;";
		$result = mysqli_query($db, $query);
			$rows = [];
			while($row = mysqli_fetch_array($result))
			{
				$rows[] = $row;
			}
		$_SESSION['queriedPatients'] = $rows;
		$_SESSION['queriedPatientsBack'] = true;
		unset($_SESSION['queriedDoctorsBack']);
		unset($_SESSION['queriedReservationsBack']);
	}
	
	//Query doctors
	if(isset($_POST['queryDoctors'])){
		$query = "SELECT name, address, gender, phoneNumber, specialization, docType, DID
		FROM doctors;";
		$result = mysqli_query($db, $query);
			$rows = [];
			while($row = mysqli_fetch_array($result))
			{
				$rows[] = $row;
			}
		$_SESSION['queriedDoctors'] = $rows;
		$_SESSION['queriedDoctorsBack'] = true;
		unset($_SESSION['queriedPatientsBack']);
		unset($_SESSION['queriedReservationsBack']);
	}
	
	//Query Reservations
	if(isset($_POST['queryReservations'])){
		$query = "SELECT patients.name AS 'patientName', doctors.name AS 'doctorName',
				doctors.specialization AS 'specialization', doctors.docType AS 'docType',
				reservations.confirmed AS 'confirmation'
				FROM ((reservations 
				INNER JOIN patients ON reservations.patientUsername = patients.username)
				INNER JOIN doctors ON reservations.doctorDID = doctors.DID);";
		$result = mysqli_query($db, $query);
			$rows = [];
			while($row = mysqli_fetch_array($result))
			{
				$rows[] = $row;
			}
		$_SESSION['queriedReservations'] = $rows;
		$_SESSION['queriedReservationsBack'] = true;
		unset($_SESSION['queriedDoctorsBack']);
		unset($_SESSION['queriedPatientsBack']);
	}
	
	
	
?>




