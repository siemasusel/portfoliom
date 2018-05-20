<?php
require_once 'config.php';

session_start();
if($_SESSION['log_as_admin'] !== "permit"){
  $_SESSION['error'] = "Nie masz uprawnien!";
  header("Location: login.php");
  exit();
}

// img upload
require_once 'savePhoto.php';
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  //Send to server
  if($isPicture){
    $title = $mysqli->real_escape_string($_POST['title']);
    $content = $mysqli->real_escape_string($_POST['content']);
    $addDate = $_POST['addDate'];
    $addDate = date("Y-m-d", strtotime($addDate));
    if($addDate){
      $sql = "INSERT INTO projects (PicturePath, Title, Content, AddDate) VALUES('$pictureName', '$title', '$content', '$addDate')";

      if($mysqli->query($sql)){
        echo 'Added Successfully. <br /> <a href="editproject.php">Go back</a> | <a href="dashboard.php">Dashboard</a> | <a href="index.php">Home Page</a>';
      }
      else {
        echo "nie dodano";
      }
    }
    else{
      echo "Blad w dacie";
    }
  }
}
?>
