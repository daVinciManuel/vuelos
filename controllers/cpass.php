<?php
require_once '../db/connect.php';
require_once '../models/mpass.php';
// ------------------------------------------------
// UNCOMMENT THIS TO CREATE THE COLUMN
// $columnCreated = createColumnForPasswords();
// echo '$columnCreated: ';
// var_dump($columnCreated);
// echo '<br>';
// echo '<br>';
// ------------------------------------------------
//
// pillo todo el listado de usuarios
$usersData = getUsersData();

// encripto la contraseña y la guardo con la funcion FILLPASS
foreach($usersData as $user){
  $pass = password_hash($user["birthdate"],PASSWORD_DEFAULT);
  $id = $user['passenger_id'];
  fillPass($id,$pass);
}
