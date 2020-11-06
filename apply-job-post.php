<?php

session_start();

if(empty($_SESSION['id_user'])) {
  $_SESSION['callFrom'] = "apply-job-post.php?id=".$_GET[id];
	header("Location: job_seekers.php");
	exit();
}

require_once("db.php");
?>
<!DOCTYPE html>
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
            <a class="navbar-brand" href="index.php">Job Portal</a>
          </div>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              <li><a href="jobseekers/profile.php">Profile</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <div class="container">

    <div class="row">
      <div class="col-md-12">
        <?php 
          $sql = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id]'";
          $result = $conn->query($sql);

          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) 
            {
             ?>
                    <h2 class="text-center"><?php echo $row['jobtitle']; ?></h2>
                    <p><?php echo $row['description']; ?></p>
                    <a href="apply.php?id=<?php echo $row['id_jobpost']; ?>" class="btn btn-primary">Apply</a>
              <?php
            }
          }
          ?>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>