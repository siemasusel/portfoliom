<?php
require_once 'config.php';
session_start();
if($_SESSION['log_as_admin'] !== "permit"){
  $_SESSION['error'] = "Nie masz uprawnien!";
  header("Location: login.php");
  exit();
}

if(isset($_GET['select-edit']) && $_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["submit-edit"])){
  $projectid = trim($_GET['select-edit']);
  $sql = "SELECT PicturePath, Title, Content, AddDate AS AddingDate FROM projects WHERE Id = $projectid";
  if($result = $mysqli->query($sql)){
    $project = $result->fetch_assoc();
  }
}
else{
  header("Location: manageproject.php");
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
        <li class="breadcrumb-item"><a href="manageproject.php">Edit or Delete Project</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
    </nav>
    <div id="edit">
      <div class="page-header mb-3">
        <h1>Edit</h1>
      </div>
      <form action="edit.php" method="post" class="needs-validation" enctype="multipart/form-data">
        <input type="hidden" name="projectid" value="<?php echo $projectid; ?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"; >Project Title:</span>
          </div>
          <input type="text" name="title" class="form-control" aria-describedby="basic-addon1" value="<?php echo $project['Title'] ?>" required>
          <div class="invalid-feedback">This field can't be empty.</div>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="adddate">Date:</span>
          </div>
          <input type="text" name="addDate" placeholder="YYYY-MM-DD" class="form-control" value="<?php echo $project['AddingDate'] ?>" aria-describedby="adddate" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" maxlength="10" required>
          <div class="invalid-feedback">Date format must be: YYYY-MM-DD</div>
        </div>
        <div class="custom-file mb-3">
          <input type="file" name="photo" class="custom-file-input" id="picture">
          <label class="custom-file-label" for="picture">Add photo:</label>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Description:</span>
          </div>
          <textarea name="content" class="form-control" rows="8" aria-label="With textarea" required><?php echo $project['Content'] ?></textarea>
          <div class="invalid-feedback">This field can't be empty.</div>
        </div>
        <button type="submit" name="submit-edit" class="btn btn-primary mb-3" id="btn-delete">Edit</button>
      </form>

      <a class="btn btn-primary" data-toggle="collapse" href="#collapsePhoto" role="button" aria-expanded="false" aria-controls="collapsePhoto">Show Current Photo</a>
      <div class="collapse mx-0" id="collapsePhoto">
        <div class="card card-body">
          <img src="img/<?php echo $project['PicturePath'] ?>" class="img-fluid d-block mx-auto" alt="Photo">
        </div>
      </div>
    </div>
  </div>
</body>
</html>
