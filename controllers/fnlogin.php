<?php
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
// -------------- ELIMINA COOKIE INTENTOS FALLIDOS--------------------
function forgetLoginAttempts(){
  setCookie("loginAttempts",'', time() -999999, "/");
}
