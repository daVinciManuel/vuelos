<?php
// ------------------- FUNCION DE INICIO DE SESION -----------------
include_once './db/connect.php';
include_once './models/mloginOAuth.php';
function grantAccess($email){
  $done = false;
  // Obtengo el nombre de usuario
  $username = getNameOf($email) ?? null;
  $userid = getIdOf($email) ?? null;
  // SI USER EXISTE:
  if($username && $userid){
  // crea VARIABLES DE SESION:
    session_start();
    $_SESSION['user'] = $username;
    $_SESSION['userid'] = $userid;
    $done = true;
  }
  return $done;
}
