<?php

session_start();

require_once("db.php");

if(isset($_POST)) {

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$sql = "SELECT id_company, companyname, email, active FROM company WHERE email='$email' AND password='$password'";
	$result = $conn->query($sql);

	if($result->num_rows > 0) {

		while($row = $result->fetch_assoc()) {

			if($row['active'] == '2') {
				$_SESSION['companyLoginError'] = "Your Account Is Still Pending Approval.";
				header("Location: company-login.php");
				exit();
			} else if($row['active'] == '0') {
				$_SESSION['companyLoginError'] = "Your Account Is Rejected. Please Contact For More Info.";
				header("Location: company-login.php");
				exit();
			} else if($row['active'] == '1') {
				$_SESSION['name'] = $row['companyname'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['id_user'] = $row['id_company'];
				$_SESSION['companyLogged'] = true;
				header("Location: employers/dashboard.php");
				exit();
			}
		}
 	} else {
 		$_SESSION['loginError'] = $conn->error;
 		header("Location: company-login.php");
		exit();
 	}

 	$conn->close();

} else {
	header("Location: company-login.php");
	exit();
}