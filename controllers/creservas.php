<?php
require_once './checkOAuth.php';
require_once '../db/connect.php';
// desplegable de vuelos:
require_once '../models/mreservas.php';
$vuelos = getVuelosDisponibles();


// agregar al carrito
if(isset($_POST['addToCart']) && isset($_POST['flight'])){
  $vuelo = $_POST['flight'];

  include_once './fnCarrito.php';
  $carrito = agregarAlCarrito($vuelo);
  storeCarrito($carrito);
}

// comprar
if(isset($_POST['pay'])){
  // pasarela de pago:
  //
  // guardar en db:
  //
}
var_dump(unserialize($_COOKIE['cart']));
require_once '../views/vreservas.php';
