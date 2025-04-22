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
var_dump($usersData);
echo '<br>';
echo '<br>';
foreach($usersData as $user){
  $pass = password_hash($user["birthdate"],PASSWORD_DEFAULT);
  $id = $user['passenger_id'];
  var_dump($id);
  fillPass($id,$pass);
}
