<?php
require_once 'config.php';

$project_err = "";
// $projects = [];
$modalThumb = '';
$modalContent = '';
$sql = "SELECT Id, PicturePath,  Title, Content, DATE(AddDate) AS AddingDate FROM projects ORDER BY AddDate DESC";

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

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>portfolio</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="style.css"> <!-- PAGE CSS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> <!-- JQUERY -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> <!-- BOOTSTRAP JS -->
</head>

<body class="right-area-background">
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 col-md-3 col-lg-2 left-area-background"> <!-- LEFT AREA -->
      <div class="sticky-top pt-3" >
        <figure class="figure text-center mb-5"> <!-- PHOTO AND NAME BAR -->
          <img src="img/avatar.png" class="figure-img img-fluid rounded-circle border left-avatar-bordercolor" alt="Photo" width="35%" height="35%">
          <figcaption><p class="font-weight-normal" style="font-size: 22px;">Magdalena Tomasik</p></figcaption>
        </figure>
        <nav class="navbar flex-column text-right nav-stacked" ><!-- NAV MENU -->
          <ul class="navbar-nav" >
            <li class="nav-item pt-2"><a class="nav-link navbar-brand" data-toggle="collapse" href="#menu1Collapse" role="button" aria-expanded="false" aria-controls="collapseExample">My Projects</a></li> <!-- NAV MENU1 -->
              <div class="collapse" id="menu1Collapse"> <!-- SUBMENU MENU1  -->
                <ul class="list-group list-group-flush">
                  <li class="list-group-item list-group-item-secondary border-0"><span class="filter font-italic" data-filter="allprojects">All projects</span></li>
                  <li class="list-group-item list-group-item-secondary border-0"><span class="filter font-italic" data-filter="2018">2018</span></li>
                  <li class="list-group-item list-group-item-secondary border-0"><span class="filter font-italic" data-filter="2017">2017</span></li>
                  <li class="list-group-item list-group-item-secondary border-0"><span class="filter font-italic" data-filter="2016">2016</span></li>
                  <li class="list-group-item list-group-item-secondary border-0"><span class="filter font-italic" data-filter="2015">2015</span></li>
                </ul>
              </div>
            <li class="nav-item pt-2"><a class="nav-link navbar-brand" data-toggle="collapse" href="#menu2Collapse" role="button" aria-expanded="false" aria-controls="collapseExample">Curriculum Vitae</a></li> <!-- NAV MENU2 -->
              <div class="collapse" id="menu2Collapse"> <!-- SUBMENU MENU2  -->
                <ul class="list-group list-group-flush">
                  <li class="list-group-item list-group-item-secondary border-0"><a class="font-italic" href="#">Download [pdf]</a></li>
                </ul>
              </div>
            <li class="nav-item pt-2 mb-5"><a href="#" class="nav-link navbar-brand">Contacts</a></li> <!-- NAV MENU3 -->
          </ul>
        </nav>
      </div>
      <footer class="footer mb-2 mr-2">
        <small>&copy; Copyright 2018, Example Corporation</small>
      </footer>
    </div>
    <div class="col-sd-12 col-md-9 col-lg-10 pt-3 pl-5 pr-5"> <!-- RIGHT AREA -->
      <p class="h3 bg-faded mb-4 font-weight-normal text-center">SOME OF MY PROJECTS</p>
      <div class="d-flex flex-wrap justify-content-left project-conteiner">
        <div class="p-2 col-lg-3 col-md-4 col-sm-12 project-pnl" data-filter="2018">
          <div class="hovereffect">
            <a href="#"><img src="https://unsplash.it/600.jpg?image=251" class="img-fluid"></a>
            <div class="overlay">
              <a href="#" class="right-button-about">About</a>
            </div>
          </div>
        </div>
        <div class="p-2 col-lg-3 col-md-4 col-sm-12 project-pnl" data-filter="2015">
          <div class="hovereffect">
            <a href="#"><img src="https://unsplash.it/600.jpg?image=253" class="img-fluid"></a>
            <div class="overlay">
              <a href="#" class="right-button-about">About</a>
            </div>
          </div>
        </div>
        <div class="p-2 col-lg-3 col-md-4 col-sm-12 project-pnl" data-filter="2015">
          <div class="hovereffect">
            <a href="#"><img src="https://unsplash.it/600.jpg?image=252" class="img-fluid"></a>
            <div class="overlay">
              <a href="#" class="right-button-about">About</a>
            </div>
          </div>
        </div>
        <div class="p-2 col-lg-3 col-md-4 col-sm-12 project-pnl" data-filter="2016">
          <div class="hovereffect">
            <a href="#"><img src="https://unsplash.it/600.jpg?image=251" class="img-fluid"></a>
            <div class="overlay">
              <a href="#" class="right-button-about">About</a>
            </div>
          </div>
        </div>
        <div class="p-2 col-lg-3 col-md-4 col-sm-12 project-pnl" data-filter="2017">
          <div class="hovereffect">
            <a href="#"><img src="https://unsplash.it/600.jpg?image=253" class="img-fluid"></a>
            <div class="overlay">
              <a href="#" class="right-button-about">About</a>
            </div>
          </div>
        </div>
        <div class="p-2 col-lg-3 col-md-4 col-sm-12 project-pnl" data-filter="2018">
          <div class="hovereffect">
            <a href="#"><img src="https://unsplash.it/600.jpg?image=252" class="img-fluid"></a>
            <div class="overlay">
              <a href="#" class="right-button-about">About</a>
            </div>
          </div>
        </div>
        <div class="p-2 col-lg-3 col-md-4 col-sm-12 project-pnl"data-filter="2016">
          <div class="hovereffect">
            <a href="#"><img src="https://unsplash.it/600.jpg?image=251" class="img-fluid"></a>
            <div class="overlay">
              <a href="#" class="right-button-about">About</a>
            </div>
          </div>
        </div>
        <div class="p-2 col-lg-3 col-md-4 col-sm-12 project-pnl" data-filter="2017">
          <div class="hovereffect">
            <a href="#"><img src="https://unsplash.it/600.jpg?image=253" class="img-fluid"></a>
            <div class="overlay">
              <a href="#" class="right-button-about">About</a>
            </div>
          </div>
        </div>
        <div class="p-2 col-lg-3 col-md-4 col-sm-12 project-pnl" data-filter="2015">
          <div class="hovereffect">
            <a href="#"><img src="https://unsplash.it/600.jpg?image=252" class="img-fluid"></a>
            <div class="overlay">
              <a href="#" class="right-button-about">About</a>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<footer class="footer-b mb-2 mr-2">
  <small>&copy; Copyright 2018, Example Corporation</small>
</footer>

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

$(function() {
  $('.filter').click(function(){
    var category = $(this).attr("data-filter");

    if(category == 'allprojects'){
      $('.project-pnl').each(function(){
        $(this).addClass('d-block');
      });
    } else {
      $('.project-pnl').each(function(){
        $(this).removeClass('d-block');
        $(this).removeClass('d-none');
        var tmp = $(this).attr("data-filter")
        if(tmp == category){
          $(this).addClass('d-block');
        }
        else {
          $(this).addClass('d-none');
        }
      });
    }
  });
});

</script>
</body>

</html>
