<!DOCTYPE html>
<?php
  require_once 'config.php';
  session_start();
  //root123
  $password_err = '';
  if(isset($_SESSION['log_as_admin'])){
    if($_SESSION['log_as_admin'] === "permit"){
      header("location: dashboard.php");
    }
  }
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["password"]))){
      $password_err = 'Wpisz haslo';
    } else {
      $password = trim($_POST['password']);
    }

    if(empty($password_err)){
      $sql = "SELECT password FROM admin";

      if($result = $mysqli->query($sql)){
        $result = $result->fetch_row();
        $hashed_password = $result[0];
        if(password_verify($password, $hashed_password)){
          session_start();
          $_SESSION['log_as_admin'] = "permit";
          header("location: dashboard.php");
        }else {
          $password_err = 'Niepoprawne haslo';
        }
      }
    }
  }
  $mysqli->close();
?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="style.css"> <!-- PAGE CSS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> <!-- JQUERY -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> <!-- BOOTSTRAP JS -->
</head>
<body>
    <?php
    $divErrorStart = '<div class="alert alert-danger" role="alert">';
    $divEnd =  '</div>';


    if(!empty($password_err)) {
      echo $divErrorStart . $password_err . $divEnd;
    }
    elseif(isset($_SESSION['error'])){
      echo $divErrorStart . $_SESSION['error'] . $divEnd;
    }
    ?>
  <div class="container">
    <form action="" method="POST">
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <!-- <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div> -->
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>


</body>
</html>
