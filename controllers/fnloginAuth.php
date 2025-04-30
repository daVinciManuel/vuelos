<?php
// incluyo una funcion que me trae la clave encriptada de la BD
include_once './db/connect.php';
include_once './models/mloginAuth.php';
// ------------- FUNCION DE AUTENTICACION -----------------------
function login_verify($user,$password){
  // compruebo CLAVE INTRODUCIDA es igual a CLAVE ENCRIPTADA
  // DEVUELVO TRUE or FALSE
  return password_verify($password,getPasswordOf($user));
}
