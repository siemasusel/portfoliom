<?php
require_once 'config.php';

$currentName = '';
$sql_err = '';
$sqlGetName = 'SELECT name, PicturePath from personalinfo;';
if($result = $mysqli->query($sqlGetName)){
  $result = $result->fetch_assoc();
  $currentName = $result['name'];
  $currentPhoto = $result['PicturePath'];
}
else{
  $sql_err = 'Error sql query name';
  echo $sql_err;
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  if(file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name'])) {
      require_once 'savePhoto.php';
  }
  else{
    $pictureName = $currentPhoto;
    $isPicture = true;
  }

  if($isPicture){
    $name = $mysqli->real_escape_string($_POST['person-name']);

    $sql = "UPDATE personalinfo SET name='$name', PicturePath='$pictureName' WHERE id=1";

    if($mysqli->query($sql)){
      echo "dodano";
      if($currentPhoto != $pictureName){
        if (!unlink("img/" . $currentPhoto)){
          echo ("Error deleting $currentPhoto but updated");
        }
        else{
          echo ("Deleted $currentPhoto");
          header("Location: dashboard.php");
        }
      }
      else {
        header("Location: dashboard.php");
      }
    }
    else {
      echo "nie dodano";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Set Personal info</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> <!-- BOOTSTRAP CSS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> <!-- JQUERY -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> <!-- BOOTSTRAP JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
  <form class="needs-validation" method="post" action="" enctype="multipart/form-data" >
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Set Personal Info</li>
      </ol>
    </nav>
    <div class="page-header mb-3">
      <h1>Set Personal Info</h1>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" >Name</span>
      </div>
      <input type="text" class="form-control" name="person-name" value="<?php echo $currentName; ?>">
    </div>
    <div class="custom-file mb-3">
      <input type="file" name="photo" class="custom-file-input" id="picture" >
      <label class="custom-file-label" for="picture">Set New Photo</label>
    </div>
    <button type="submit" name="submit" class="btn btn-primary mb-3">Submit</button>
  </form>

  <a class="btn btn-primary" data-toggle="collapse" href="#collapsePhoto" role="button" aria-expanded="false" aria-controls="collapsePhoto">
    Show Current Photo
  </a>
  <div class="row">
    <div class="col-sm-12 col-md-6 col-lg-4">
      <div class="collapse" id="collapsePhoto">
        <div class="card card-body">
          <img src="img/<?php echo $currentPhoto; ?>" class="figure-img img-fluid rounded-circle border left-avatar-bordercolor" alt="Photo">
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
