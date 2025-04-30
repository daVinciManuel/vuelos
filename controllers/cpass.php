<?php
require_once '../db/connect.php';
require_once '../models/mpass.php';
// ------------------------------------------------
// UNCOMMENT THIS TO CREATE THE COLUMN
$columnCreated = createColumnForPasswords();
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
// --------------------------------------------------------------------
// view:
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirección</title>
    <meta http-equiv="refresh" content="5;url=../index.php">
</head>
<body>
    <h1>Redirigiendo...</h1>
    <p>Serás redirigido en 5 segundos a la página deseada.</p>
    <a href="../index.php">Si no funciona click here </a>
</body>
</html>
