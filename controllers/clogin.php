<?php
if(isset($_COOKIE['PHPSESSID'])){
  header('Location: ./controllers/cinicio.php');
  exit();
}
$loginAttempts = $_COOKIE['loginAttempts'] ?? 0;
// incluye enableLogin() disableLogin() storeFailedLogin()
require_once './controllers/fnlogin.php';
// si mandan el formulario de login:
if(isset($_POST['login'])){
  // si el formulario no esta vacio:
  if(!empty($_POST['username']) && !empty($_POST['password'])){
    // -------------------- AUTENTICACION ------------------------------
    include_once './controllers/fnloginAuth.php';
    if(login_verify($_POST['username'],$_POST['password'])){
      // ------------------- AUTORIZACION ------------------------------
      include_once './controllers/fnloginOAuth.php';
      $logged = grantAccess($_POST['username']);

      if($logged){
        header('Location: ./controllers/cinicio.php');
        forgetLoginAttempts();
      }
    }else{
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

require_once './views/vlogin.php';
