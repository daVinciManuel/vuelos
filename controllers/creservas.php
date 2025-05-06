<?php
require_once './checkOAuth.php';
// desplegable de vuelos:
require_once './fnReservas.php';
$allVuelos = getListaVuelos();

// eliminar del carrito
if(isset($_POST['removeFromCart']) && isset($_POST['flightsToRemove'])){
  include_once './fnCarrito.php';
  $cart = carritoDel($_POST['flightsToRemove']);
  if(!empty($cart['vuelos'])){
    carritoSave($cart);
  }else{
    carritoDestroy();
  }
}
// agregar al carrito
if(isset($_POST['addToCart']) && isset($_POST['flight'])){
  include_once './fnCarrito.php';
  $cart = carritoAdd($_POST['flight']);
  carritoSave($cart);
  $vcarrito = carritoToView($cart,$allVuelos);
}elseif(isset($cart)){
  include_once './fnCarrito.php';
  $vcarrito = carritoToView($cart,$allVuelos);
}elseif(isset($_COOKIE['cart'])){
  include_once './fnCarrito.php';
  $vcarrito = carritoToView($_COOKIE['cart'],$allVuelos);
}

// comprar
if(isset($_POST['pay'])){
  // pasarela de pago:
  //
  // guardar en db:
  //
}
require_once '../views/vreservas.php';
