<?php
require_once 'config.php';

$project_err = "";
// $projects = [];
$modalThumb = '';
$modalContent = '';
$sql = "SELECT Id, PicturePath, Title, Content, AddDate AS AddingDate FROM projects ORDER BY AddDate DESC";

if($result = $mysqli->query($sql)){
  while($tmp = $result->fetch_assoc()){
    // $projects[array_shift($tmp)] = $tmp;
    // array_push($projects, $tmp);
    $modalThumb .= '<div class="p-2 col-lg-3 col-md-4 col-sm-12 project-pnl" data-filter=" ' . date('Y', strtotime($tmp['AddingDate']) ) . '"> <div class="hovereffect"> <a href="#"><img src="img/' . $tmp['PicturePath'] . '"class="img-fluid"></a> <div class="overlay"> <a href="#" class="right-button-about" data-toggle="modal" data-target="#lightbox' . $tmp['Id'] . '">About</a> </div></div></div>';
    $modalContent .= '<div class="modal fade" id="lightbox' . $tmp['Id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" > <div class="modal-dialog" role="document" style="max-width: 80%;"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="exampleModalLabel">' . $tmp['Title'] . '</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div><div class="modal-body" style="padding: 0;"> <div class="container" style="margin: 0; max-width: none;"> <div class="row"> <div class="col-8 bg-dark"> <a href="#"><img src="img/' . $tmp['PicturePath'] . '" class="img-fluid mx-auto d-block"></a> </div><div class="col-4" style="padding-top: 1rem;">' . $tmp['Content'] . '</div></div></div></div><div class="modal-footer"> <span class="modal-date">' . $tmp['AddingDate'] . '</span> </div></div></div></div>';
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
  <div class="col-sd-12 col-md-9 col-lg-10 pt-3 pl-5 pr-5"> <!-- RIGHT AREA -->
    <p class="h3 bg-faded mb-4 font-weight-normal text-center">SOME OF MY PROJECTS</p>
    <div class="d-flex flex-wrap justify-content-left project-conteiner">
      <?php echo $modalThumb; ?>
    </div>
    <?php echo $modalContent; ?>
  </div>



<script>
$(function() {
  $('.hovereffect').hover(function() {
    $('.overlay', this).stop().animate({'opacity': '1'}, 300);
    }, function() {
    $('.overlay', this).stop().animate({'opacity': '0'}, 200);
  }) ;
});

$(function() {
  $('.hovereffect').hover(function() {
    $('.overlay', this).css({'background-color': 'rgba(244, 244, 244, .7)'});
    }, function() {
    $('.overlay', this).css({'background-color': 'transparent'});
  }) ;
});
</script>
</body>

</html>
