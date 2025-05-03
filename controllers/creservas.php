<?php
require_once './checkOAuth.php';
require_once '../db/connect.php';
// desplegable de vuelos:
require_once '../models/mreservas.php';
$vuelos = getVuelosDisponibles();

// agregar al carrito
if(isset($_POST['addToCart'])){
  var_dump($_POST);
  $vuelo = $_POST['flight'];
  agregarAlCarrito($vuelo);
  // guardar carrito:
  //
}

// comprar
if(isset($_POST['pay'])){
  // pasarela de pago:
  //
  // guardar en db:
  //
}
function agregarAlCarrito($vuelo){
  // si existe la COOKIE DEL CARRITO la usa, si no, crea un array vacio
  $cart = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : array();
  // compruebo si ya se ha pedido ese mismo vuelo
  $repeated = false;
  foreach($cart as $c){
    if(in_array($vuelo,$c['vuelos']){
      $repeated = true;
    }
  }
  // SI se ha pedido el vuelo
  if($repeated){
    // creo un array con la cantidad de cada producto
    if(!isset($cart[$vuelo])){
      $cart['cantidad'][$vuelo] = 2;
    }else{
      $cart['cantidad'][$vuelo] += 1;
    }
  }else{
    array_push($cart['vuelos'],$vuelo);
  }
}
require_once '../views/vreservas.php';
