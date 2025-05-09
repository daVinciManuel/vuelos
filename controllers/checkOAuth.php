<?php
session_start();
if(empty($_SESSION['user']) || empty($_SESSION['userid'])){
  session_unset();
  session_destroy();
  setcookie(session_name(), '', time() - 9999, '/');
  header('Location: ../index.php');
}
