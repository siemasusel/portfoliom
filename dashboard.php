<?php
  session_start();
  if($_SESSION['log_as_admin'] !== "permit"){
    $_SESSION['error'] = "Nie masz uprawnien!";
    header("Location: login.php");
    exit();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> <!-- BOOTSTRAP CSS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> <!-- JQUERY -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> <!-- BOOTSTRAP JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
    </nav>
    <div class="page-header mb-3">
      <h1>Dashboard</h1>
    </div>
    <div class="list-group">
      <a href="addproject.php" class="list-group-item">Add Project</a>
      <a href="manageproject.php" class="list-group-item">Edit or Delete Project</a>
      <a href="setpersonal.php" class="list-group-item">Set personal info (name, photo)</a>
      <a href="logout.php" class="list-group-item">Logout</a>
    </div>
  </div>
</body>
</html>
