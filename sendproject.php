<?php
require_once 'config.php';

session_start();
if($_SESSION['log_as_admin'] !== "permit"){
  $_SESSION['error'] = "Nie masz uprawnien!";
  header("Location: login.php");
  exit();
}

// img upload
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $uploaddir = 'img/';
  $picturePath = '';
  $isPicture = false;
  $uploadOk = 1;

  if($_FILES['photo']['error'] == UPLOAD_ERR_OK){
    $pictureName = basename($_FILES['photo']['name']);
    $picturePath = $uploaddir . $pictureName;
    $pictureFileType = strtolower(pathinfo($picturePath, PATHINFO_EXTENSION));

    $temp_name = $_FILES['photo']['tmp_name'];
    $check = getimagesize($_FILES["photo"]["tmp_name"]);

    if($pictureFileType != "jpg" && $pictureFileType != "png" && $pictureFileType != "jpeg" && $pictureFileType != "gif" && $pictureFileType != "apng" && $pictureFileType != "bmp"  && $pictureFileType != "svg") {
        echo "Sorry, only JPG, JPEG, PNG, GIF, APNG, SVG & BMP files are allowed.";
        $uploadOk = 0;
    }
    if(move_uploaded_file($temp_name, $picturePath) && $uploadOk){
      echo "plik został załadowany";
      $isPicture = true;
    }
    else {
      echo "Nieprawidłowy plik";
      $uploadOk = 0;
    }
  }
  else{
    echo "wystapil blad: ";
  }

  //Send to server
  if($isPicture){
    $title = $mysqli->real_escape_string($_POST['title']);
    $content = $mysqli->real_escape_string($_POST['content']);
    $addDate = $_POST['addDate'];
    $addDate = date("Y-m-d", strtotime($addDate));
    if($addDate){
      $sql = "INSERT INTO projects (PicturePath, Title, Content, AddDate) VALUES('$pictureName', '$title', '$content', '$addDate')";

      if($mysqli->query($sql)){
        echo "dodano";
        header("Location: dashboard.php");
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
