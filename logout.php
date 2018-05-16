<?php
session_start();
if($_SESSION['log_as_admin'] !== "permit"){
  $_SESSION['error'] = "Nie masz uprawnien! Wpisz haslo aby kontynuowac.";
  header("Location: login.php");
  exit();
}
else {
  $_SESSION = array();
  session_destroy();
  header("Location: index.php");
  exit();
}

?>
