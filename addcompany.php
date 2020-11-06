<?php

session_start();

require_once("db.php");

if(isset($_POST)) {

	$companyname = mysqli_real_escape_string($conn, $_POST['companyname']);
	$location = mysqli_real_escape_string($conn, $_POST['location']);
	$contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
	$website = mysqli_real_escape_string($conn, $_POST['website']);
	$companytype = mysqli_real_escape_string($conn, $_POST['companytype']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$sql = "SELECT email FROM company WHERE email='$email'";
	$result = $conn->query($sql);

	if($result->num_rows == 0) {

		$sql = "INSERT INTO company(companyname, location, contactno, website, companytype, email, password) VALUES ('$companyname', '$location', '$contactno', '$website', '$companytype', '$email', '$password')";

		if($conn->query($sql)===TRUE) {

			$_SESSION['registerCompleted'] = true;
			header("Location: company-login.php");
			exit();

		} else {
			echo "Error " . $sql . "<br>" . $conn->error;
		}
	} else {
		$_SESSION['registerError'] = true;
		header("Location: company-register.php");
		exit();
	}
	$conn->close();

} else {
	header("Location: company-register.php");
	exit();
}