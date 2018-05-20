<?php
require_once 'config.php';
session_start();
if($_SESSION['log_as_admin'] !== "permit"){
  $_SESSION['error'] = "Nie masz uprawnien!";
  header("Location: login.php");
  exit();
}
if(isset($_GET['select-delete']) && $_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["submit-delete"])){
  $projectid = trim($_GET['select-delete']);
  $sql = "DELETE FROM projects WHERE id = $projectid";

  if($mysqli->query($sql)){
    echo 'Deleted Successfully. <br /> <a href="editproject.php">Go back</a> | <a href="dashboard.php">Dashboard</a> | <a href="index.php">Home Page</a>';
  }
  else {
    $project_err = 'database error';
    echo $project_err;
  }
}
else

?>
