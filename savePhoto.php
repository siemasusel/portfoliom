<?php
//input name: photo
//return $isPicture true
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $uploaddir = 'img/';
  $picturePath = '';
  $isPicture = false;
  $uploadPhotoOk = 1;

  if($_FILES['photo']['error'] == UPLOAD_ERR_OK){
    $pictureName = basename($_FILES['photo']['name']);
    $picturePath = $uploaddir . $pictureName;
    $pictureFileType = strtolower(pathinfo($picturePath, PATHINFO_EXTENSION));

    $temp_name = $_FILES['photo']['tmp_name'];
    $check = getimagesize($_FILES["photo"]["tmp_name"]);

    if($pictureFileType != "jpg" && $pictureFileType != "png" && $pictureFileType != "jpeg" && $pictureFileType != "gif" && $pictureFileType != "apng" && $pictureFileType != "bmp"  && $pictureFileType != "svg") {
        echo "Sorry, only JPG, JPEG, PNG, GIF, APNG, SVG & BMP files are allowed.";
        $uploadPhotoOk = 0;
    }
    if($uploadPhotoOk){
      if(move_uploaded_file($temp_name, $picturePath)){
        echo "plik został załadowany";
        $isPicture = true;
      }
      else {
        echo "Nieprawidłowy plik";
        $uploadPhotoOk = 0;
      }
    }
  }
  else{
    echo "wystapil blad";
  }
}
?>
