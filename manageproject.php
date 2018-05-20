<?php
require_once 'config.php';
session_start();
if($_SESSION['log_as_admin'] !== "permit"){
  $_SESSION['error'] = "Nie masz uprawnien!";
  header("Location: login.php");
  exit();
}

$sql = "SELECT Id, PicturePath, Title, Content, AddDate AS AddingDate FROM projects ORDER BY AddDate DESC";

$selectOptions = "";
if($result = $mysqli->query($sql)){
  while($tmp = $result->fetch_assoc()){
    // $selectOptions .= '<option value="'. $tmp['Id'] . '">' . $tmp['Title'] . ' | ' . $tmp['AddingDate'] . '</option>';
    $selectOptions .= '<option value="'. $tmp['Id'] . '">' . $tmp['AddingDate'] . ' | Title: "' . $tmp['Title'] . '"</option>';
  }
}
else {
  $project_err = 'database error';
  echo $project_err;
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Projects</title>
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
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit or Delete Project</li>
      </ol>
    </nav>
    <div id="delete">
      <div class="page-header mb-3">
        <h1>Delete Project</h1>
      </div>
      <form action="deleteproject.php" method="get">
        <select name="select-delete" class="custom-select mb-3" required>
          <option selected disabled hidden>Choose Project To Delete</option>
          <?php echo $selectOptions; ?>
        </select>
        <button type="submit" name="submit-delete" class="btn btn-primary mb-3" id="btn-delete" onclick="return confirm('Are you sure?');">Delete</button>
      </form>
    </div>
    <div id="edit">
      <div class="page-header mb-3">
        <h1>Edit Project</h1>
      </div>
      <form action="editproject.php" method="get">
        <select name="select-edit" class="custom-select mb-3" required>
          <option selected disabled hidden>Choose Project To Edit</option>
          <?php echo $selectOptions; ?>
        </select>
        <button type="submit" name="submit-edit" class="btn btn-primary mb-3" id="btn-delete">Edit</button>
      </form>
    </div>
  </div>
</body>
</html>
