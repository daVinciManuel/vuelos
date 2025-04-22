<?php
require_once '../db/connect.php';
require_once '../models/mpass.php';
// $passColumnExists = passColumnExists();
// echo '$passColumnExists: ';
// var_dump($passColumnExists);
// echo '<br>';
// echo '<br>';
//
// if(!$passColumnExists){
// $columnCreated = createColumnForPasswords();
// echo '$columnCreated: ';
// var_dump($columnCreated);
// echo '<br>';
// echo '<br>';
// }
$usersData = getUsersData();
echo '$usersData: ';
print_r($usersData);
echo '<br>';
echo '<br>';

// foreach($usersData as $user){
// $pass = password_hash($user["birthdate"],PASSWORD_DEFAULT);
// $id = $user['passenger_id'];
// echo $id;
// fillPass($id,$pass);
// echo 'insert ok';
// }
foreach($usersData as $user){
  $pass = password_hash($user["birthdate"],PASSWORD_DEFAULT);
  $id = $user['passenger_id'];
  print_r($user['passenger_id']);
  echo '<br>';
  $reponse = fillPass($id,$pass);
  echo $reponse;
  // echo 'insert ok';
  
}
