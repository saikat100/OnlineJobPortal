<?php

session_start();
require_once("db.php");

if(isset($_POST)) {
	$firstname = mysqli_real_escape_string($conn, $_POST['fname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$sql = "SELECT email FROM users WHERE email='$email'";
	$result = $conn->query($sql);

	if($result->num_rows == 0) {

		$sql = "INSERT INTO users(firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";

		if($conn->query($sql)===TRUE) {
			$_SESSION['registerCompleted'] = true;
			header("Location: login.php");
			exit();
		} else {
			echo "Error " . $sql . "<br>" . $conn->error;
		}
	} else {
		$_SESSION['registerError'] = true;
		header("Location: register.php");
		exit();
	}

	$conn->close();

} else {
	header("Location: register.php");
	exit();
}