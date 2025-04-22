<?php

$loginAttempts = $_COOKIE['loginAttempts'] ?? null;
// si mandan el formulario de login:
if($_POST['login']){
  // si el formulario no esta vacio:
  if(!empty($_POST['username']) && !empty($_POST['password'])){
    // -------------------- AUTENTICACION ------------------------------
    if(!login_verify($_POST['username'],$_POST['password'])){
      // crea VARIABLE DE SESION: user 
      // Redirige a menu de inicio
    }else{
      // SUMA 1 INTENTO FALLIDO
      // GUARDA NUMERO DE INTENTOS EN UNA COOKIE
      $loginAttempts += 1;
    }
  }
}
// SI lleva 3 intentos:
if($loginAttempts > 2){
  // DESACTIVA BOTON DE LOGIN
  // HASTA QUE DESAPAREZCA LA COOKIE
}else{
  // ACTIVA BOTON DE LOGIN
}

// ------------- FUNCION DE AUTENTICACION -----------------------
function login_verify($user,$password){
  // incluyo una funcion que me trae la clave encriptada de la BD
  include_once './models/mlogin.php';
  // compruebo CLAVE INTRODUCIDA es igual a CLAVE ENCRIPTADA
  return password_verify($password,getPasswordOf($user));
}

include_once './views/vlogin.php';
