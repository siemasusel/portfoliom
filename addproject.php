<?php
require_once 'config.php';

session_start();
if($_SESSION['log_as_admin'] !== "permit"){
  $_SESSION['error'] = "Nie masz uprawnien!";
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE !html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Add Project</title>
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
      <li class="breadcrumb-item active" aria-current="page">Add Project</li>
    </ol>
  </nav>
  <div class="page-header mb-3">
    <h1>Add Project</h1>
  </div>
    <form class="needs-validation" method="post" action="sendproject.php" enctype="multipart/form-data" novalidate>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Project Title:</span>
        </div>
        <input type="text" name="title" class="form-control" aria-describedby="basic-addon1" required>
        <div class="invalid-feedback">This field can't be empty.</div>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="adddate">Date:</span>
        </div>
        <input type="text" name="addDate" placeholder="YYYY-MM-DD" id="setDate" class="form-control" aria-describedby="adddate" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" maxlength="10" required>
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" onclick="setToday()">Set Today</button>
        </div>
        <div class="invalid-feedback">Date format must be: YYYY-MM-DD</div>
      </div>
      <div class="custom-file mb-3">
        <input type="file" name="photo" class="custom-file-input" id="picture" required>
        <label class="custom-file-label" for="picture">Add photo:</label>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Description:</span>
        </div>
        <textarea name="content" class="form-control" rows="8" aria-label="With textarea" required></textarea>
        <div class="invalid-feedback">This field can't be empty.</div>
      </div>
      <button type="reset" value="Reset">Reset</button>
      <button type="submit" name="submit" class="btn btn-primary mb-3">Submit</button>
    </form>
</div>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

function setToday(){
  var setDate = document.getElementById('setDate');
  var date = new Date();
  var today = "";
  var month = date.getMonth() + 1;
  var day = date.getDate();

  if(month<10){
    month = "0" + month;
  }
  if(day<10){
    day = "0" + day;
  }
  today = date.getFullYear() + "-" + month + "-" + day;

  setDate.value = today;
}


</script>
</body>
</html>
