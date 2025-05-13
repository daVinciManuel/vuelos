<?php
if(isset($_COOKIE['PHPSESSID'])){
  header('Location: ./controllers/cinicio.php');
  exit();
}

if(isset($_POST) && !empty($_POST)){
  if(
    isset($_POST['name']) &&
    isset($_POST['birthdate']) &&
    isset($_POST['street']) &&
    isset($_POST['city']) &&
    isset($_POST['country']) &&
    isset($_POST['email']) &&
    isset($_POST['phonenumber']) &&
    isset($_POST['signUp'])
  ){
    var_dump($_POST);
    include_once '../db/connect.php';
    include_once '../models/mregistro.php';
    $name = trim($_POST['name']);
    $birthdate = trim($_POST['birthdate']);
    $sex = trim($_POST['sexo']);
    $street = trim($_POST['street']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $email = trim($_POST['email']);
    $phonenumber = trim($_POST['phonenumber']);
    if(registra($name,$birthdate,$sex,$street,$city,$country,$email,$phonenumber)){
      echo '<b>ALERT:</b> usuario "'.$name.'" registrado correctamente.';
    }
  }
}

require_once '../views/vregistro.php';
