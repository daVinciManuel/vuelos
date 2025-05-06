<?php
session_start();
if(empty($_SESSION['user']) || empty($_SESSION['userid'])){
  header('Location: ../index.php');
}
