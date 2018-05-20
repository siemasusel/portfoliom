<?php
require_once 'config.php';
session_start();
if($_SESSION['log_as_admin'] !== "permit"){
  $_SESSION['error'] = "Nie masz uprawnien!";
  header("Location: login.php");
  exit();
}
require_once 'savePhoto.php';
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-edit"])) {
  // Send to server
  $id = trim($_POST['projectid']);
  $title = $mysqli->real_escape_string($_POST['title']);
  $content = $mysqli->real_escape_string($_POST['content']);
  $addDate = $_POST['addDate'];
  $addDate = date("Y-m-d", strtotime($addDate));
  if($isPicture){
    if($addDate){
      $sql = "UPDATE projects SET PicturePath = '$pictureName', Title = '$title', Content = '$content', AddDate = '$addDate' WHERE Id = $id";

      if($mysqli->query($sql)){
        echo 'Edited Successfully. <br /> <a href="manageproject.php">Go back</a> | <a href="dashboard.php">Dashboard</a> | <a href="index.php">Home Page</a>';
      }
      else {
        echo "nie edytowano";
      }
    }
    else{
      echo "Blad w dacie";
    }
  }
  else {
    $sql = "UPDATE projects SET Title = '$title', Content = '$content', AddDate = '$addDate' WHERE Id = $id";

    if($mysqli->query($sql)){
      echo 'Edited Successfully. <br /> <a href="editproject.php">Go back</a> | <a href="dashboard.php">Dashboard</a> | <a href="index.php">Home Page</a>';
    }
    else {
      echo "nie edytowano";
    }
  }
}
?>
