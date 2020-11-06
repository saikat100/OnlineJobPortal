<?php
session_start();
$_SESSION["id_admin"] = "1";
$conn = mysqli_connect("localhost", "root", "", "jobportal") or die("Connection Error: " . mysqli_error($conn));

if (count($_POST) > 0) {
    $result = mysqli_query($conn, "SELECT *from admin WHERE id_admin='" . $_SESSION["id_admin"] . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["password"]) {
        mysqli_query($conn, "UPDATE admin set password='" . $_POST["newPassword"] . "' WHERE id_admin='" . $_SESSION["id_admin"] . "'");
        $message = "Password Changed";
    } else
        $message = "Current Password is not correct";
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Portal</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <header>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dashboard.php">Job Portal</a>
          </div>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              <li><a href="../logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <script>
      function validatePassword() {
      var currentPassword,newPassword,confirmPassword,output = true;

      currentPassword = document.frmChange.currentPassword;
      newPassword = document.frmChange.newPassword;
      confirmPassword = document.frmChange.confirmPassword;

      if(!currentPassword.value) {
	      currentPassword.focus();
	      document.getElementById("currentPassword").innerHTML = "required";
	      output = false;
      }
      else if(!newPassword.value) {
	      newPassword.focus();
	      document.getElementById("newPassword").innerHTML = "required";
	      output = false;
      }
      else if(!confirmPassword.value) {
	      confirmPassword.focus();
	      document.getElementById("confirmPassword").innerHTML = "required";
	      output = false;
      }
      if(newPassword.value != confirmPassword.value) {
	      newPassword.value="";
	      confirmPassword.value="";
	      newPassword.focus();
	      document.getElementById("confirmPassword").innerHTML = "not same";
	      output = false;
      } 	
      return output;
      }
    </script>
  <body> 
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
          <h2 class="text-center">Change Password</h2>
          <form name="frmChange" method="post" action="" onSubmit="return validatePassword()"> 
              <div class="form-group">
                <label for="currentPassword">Current Password</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password" required="">
              </div>
              <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" required="">
              </div>
              <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required="">
              </div>
                <div class="text-center">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
              <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 
</html>