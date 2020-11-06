<?php

session_start();

require_once("db.php");

if(isset($_POST)) {

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$sql = "SELECT id_user, firstname, lastname, email, active FROM users WHERE email='$email' AND password='$password'";
	$result = $conn->query($sql);

	if($result->num_rows > 0) {

		while($row = $result->fetch_assoc()) {

			if($row['active'] == '0') {
				$_SESSION['loginActiveError'] = true;
		 		header("Location: login.php");
				exit();
			} else if($row['active'] == '1') { 

				$_SESSION['name'] = $row['firstname'] . " " . $row['lastname'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['id_user'] = $row['id_user'];

				if(isset($_SESSION['callFrom'])) {
					$location = $_SESSION['callFrom'];
					unset($_SESSION['callFrom']);
					
					header("Location: " . $location);
					exit();
				} else {
					header("Location: jobseekers/dashboard.php");
					exit();
				}
			}

			
		}
 	} else {

 		$_SESSION['loginError'] = $conn->error;
 		header("Location: login.php");
		exit();
 	}

 	$conn->close();

} else {
	header("Location: login.php");
	exit();
}