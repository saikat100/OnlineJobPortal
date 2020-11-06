<?php

session_start();
require_once("../db.php");
if(isset($_POST)) {

	$stmt = $conn->prepare("UPDATE job_post SET jobtitle=?, description=?, minimumsalary=?, maximumsalary=?, experience=?, qualification=? WHERE id_jobpost=? AND id_company=?");

	$stmt->bind_param("ssssssii", $jobtitle, $description, $minimumsalary, $maximumsalary, $experience, $qualification, $_POST['target_id'], $_SESSION['id_user']);

	$jobtitle = mysqli_real_escape_string($conn, $_POST['jobtitle']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$minimumsalary = mysqli_real_escape_string($conn, $_POST['minimumsalary']);
	$maximumsalary = mysqli_real_escape_string($conn, $_POST['maximumsalary']);
	$experience = mysqli_real_escape_string($conn, $_POST['experience']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);

	if($stmt->execute()) {
		$_SESSION['jobPostUpdateSuccess'] = true;
		header("Location: dashboard.php");
		exit();
	} else {
		echo "Error " . $sql . "<br>" . $conn->error;
	}

	$stmt->close();
	$conn->close();

} else {
	header("Location: dashboard.php");
	exit();
}