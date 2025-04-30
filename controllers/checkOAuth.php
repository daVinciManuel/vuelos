<?php
session_start();
if(empty($_SESSION['user']) || empty($_SESSION['userId'])){
  header('Location: ../index.php');
}
