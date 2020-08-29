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
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
	  $_SESSION['accType'] = "Patient";
  	$password = md5($password_1);//encrypt the password before saving in the database
	$date = date('y-m-d H:i:s');

  	$query = "INSERT INTO patients (username, email, password, regDate, lastLoginDate, name, address, phoneNumber, gender) 
  			  VALUES('$username', '$email', '$password', '$date', '$date', '$name', '$address', '$phoneNumber', '$gender')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
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
	  $_SESSION['accType'] = "Patient";
	  $date = date('y-m-d H:i:s');
	  $query = "UPDATE patients SET lastLoginDate = '$date' WHERE username='$username' AND password='$password'";
	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
	  mysqli_query($db, $query);
  	  header('location: index.php');
  	}else{
		//Nurse Account
		
		$query = "SELECT * FROM nurses WHERE username='$username' AND password='$password'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1) {
		$_SESSION['accType'] = "Nurse";
		$date = date('y-m-d H:i:s');
		$query = "UPDATE nurses SET lastLoginDate = '$date' WHERE username='$username' AND password='$password'";
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		mysqli_query($db, $query);
		header('location: index.php');
		}else{
			array_push($errors, "Wrong username/password combination");
		}
		
		
  		
  	}
  }
}
//Seach doctors
if (isset($_POST['search_doctors'])){
	$query = "SELECT * FROM doctors";
	$result = mysqli_query($db, $query);

	$rows = [];
	while($row = mysqli_fetch_array($result))
	{
		$rows[] = $row;
	}
	$_SESSION['doctors'] = $rows;
	$_SESSION['docsBack'] = true;
	header('location: reserve.php');
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
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Doctor added successfully!";
  	header('location: addDoctor.php');
		}
		
//Reserver
	if (isset($_POST['reserve'])){
		$patientUsername = $_SESSION['username'];
		$DID = $_POST['reserve'];
		$query = "INSERT INTO reservations (patientUsername, doctorDID) VALUES ('$patientUsername', '$DID')";
		mysqli_query($db, $query);
		$_SESSION['reserved'] = "Successfully reserved!";
		header('location: reserve.php');
	}
	


?>




