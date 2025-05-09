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
}elseif(isset($_COOKIE['cart'.strval($_SESSION['userid'])])){
  include_once './fnCarrito.php';
  $cart = unserialize($_COOKIE[ 'cart'.strval($_SESSION['userid']) ]);
  $vcarrito = carritoToView($cart,$allVuelos);
}

// comprar
if(isset($_POST['pay'])){
  if(isset($cart)){
  // pasarela de pago:
  //
  // guardar en db:
    include_once '../db/connect.php';
    include_once '../models/mpayment.php';
    include_once './fnPagar.php';
    if(storeCarritoPagado($cart,$_SESSION['userid'])){
      echo '<b>ALERT:</b> pago realizado correctamente';
      carritoDestroy();
      $cart = null;
      $vcarrito = null;
    }
  }
}
if(isset($vcarrito) && isset($cart)){
  $precioTotal = calcPrecioTotal($vcarrito, $cart);
}
require_once '../views/vreservas.php';
