<?php
$loginAttempts = $_COOKIE['loginAttempts'] ?? 0;
// si mandan el formulario de login:
if(isset($_POST['login']) && $_POST['login']){
  // si el formulario no esta vacio:
  if(!empty($_POST['username']) && !empty($_POST['password'])){
    // -------------------- AUTENTICACION ------------------------------
    if(login_verify($_POST['username'],$_POST['password'])){
      // inicio de sesion
      $logged = loginOK($_POST['username']);

      if($logged){
        header('Location: ./controllers/cinicio.php');
      }
      echo 'login true';

    }else{
      echo 'login failed';
      // SUMA 1 INTENTO FALLIDO
      $loginAttempts += 1;
      // GUARDA NUMERO DE INTENTOS EN UNA COOKIE
      storeFailedLogin($loginAttempts);
    }
  } else { /* error FORM IS EMPTY */ }
}
// SI lleva 3 intentos:
if($loginAttempts > 2){
  disableLogin();
}else{
  enableLogin();
}








// -------- ACTIVA FORMULARIO DE LOGIN ----------
function enableLogin(){
  define('STATUS','');
}
// -------- DESACTIVA FORMULARIO DE LOGIN ----------
function disableLogin(){
  define('STATUS','disabled');
}
// -------------- GUARDA INTENTO FALLIDO EN COOKIE --------------------
function storeFailedLogin($numAttempt){
  setCookie("loginAttempts", $numAttempt, time() + 60*5, "/");
}

// ------------- FUNCION DE AUTENTICACION -----------------------
function login_verify($user,$password){
  // incluyo una funcion que me trae la clave encriptada de la BD
  include_once './db/connect.php';
  include_once './models/mlogin.php';
  // compruebo CLAVE INTRODUCIDA es igual a CLAVE ENCRIPTADA
  // DEVUELVO TRUE or FALSE
  return password_verify($password,getPasswordOf($user));
}
// ------------------- FUNCION DE INICIO DE SESION -----------------
function loginOK($email){
  $done = false;
  include_once './db/connect.php';
  include_once './models/mlogin.php';
  // Obtengo el nombre de usuario
  $username = getNameOf($email) ?? null;
  $userId = getIdOf($email) ?? null;
  // SI USER EXISTE:
  if($username && $userId){
  // crea VARIABLES DE SESION:
    session_start();
    $_SESSION['user'] = $username;
    $_SESSION['userId'] = $userId;
    $done = true;
  }
  return $done;
}

require_once './views/vlogin.php';
