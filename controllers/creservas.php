<?php
require_once './checkOAuth.php';
// desplegable de vuelos:
require_once './fnReservas.php';
define('VUELOS',getListaVuelos());

// eliminar del carrito
if(isset($_POST['removeFromCart']) && isset($_POST['flightsToRemove'])){
  include_once './fnCarrito.php';
  define('CART',carritoDel($_POST['flightsToRemove']));
  if(!empty(CART['vuelos'])){
    carritoSave(CART);
  }else{
    carritoDestroy();
  }
}
// agregar al carrito
if(isset($_POST['addToCart']) && isset($_POST['flight'])){
  include_once './fnCarrito.php';
  define('CART', carritoAdd($_POST['flight']));
  carritoSave(CART);
  mostrarCarrito();
}elseif(isset($_COOKIE['cart'])){
  include_once './fnCarrito.php';
  mostrarCarrito();
}

// comprar
if(isset($_POST['pay'])){
  // pasarela de pago:
  //
  // guardar en db:
  //
}
require_once '../views/vreservas.php';
