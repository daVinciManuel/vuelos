<?php
function carritoAdd($vuelo){
  // ESTRUCTURA:
  // carrito: [
  //    vuelos: [vueloA,vueloB,vueloC,vueloD]
  //    cantidad: [vueloA => '3', vueloC => '5', vueloB => '7']
  // ]
  //
  // array VUELOS: value = almacena ID del vuelo
  //
  // array CANTIDAD: key(s) = vueloID, value=cantidad de ese vuelo
  //
  // cuando un mismo vuelo se pide por segunda vez:
  // se agrega un elemento en el array CANTIDAD
  // cuyo indice es vueloID y valor inicial es 2
  //
  //
  // si existe la COOKIE DEL CARRITO la usa, si no, crea un array vacio

  $cookiename = 'cart' . strval($_SESSION['userid']);
  $cart = isset($_COOKIE[$cookiename]) ? unserialize($_COOKIE[$cookiename]) : array('vuelos' => array(), 'cantidad' => array());
  // compruebo si ya se ha pedido ese mismo vuelo
  $repeated = false;
  if(!empty($cart['vuelos']) && in_array($vuelo,$cart['vuelos'])){
    $repeated = true;
  }
  // SI se ha pedido el vuelo
  if($repeated){
    // incremento la cantidad
    if(isset($cart['cantidad'][$vuelo])){
      $cart['cantidad'][$vuelo] = 1 + intval($cart['cantidad'][$vuelo]);
    }
    // si NO se ha pedido el mismo vuelo previamente
  }else{
    array_push($cart['vuelos'],$vuelo);
    $cart['cantidad'][$vuelo] = 1;
  }
  return $cart;
}
// CREA O ACTUALIZA COOKIE CARRITO
function carritoSave($c){
  $cart = serialize($c);
  $cartname = 'cart' . strval($_SESSION['userid']);
  setCookie($cartname, $cart, time() + 3600 * 1, "/");
}
// carrito visible
function carritoToView($cart,$allVuelos){
  if(!empty($cart['vuelos'])){
    $vcarrito = array();
    // del listado de vuelos,
    // selecciono los que estan en el carrito
    foreach($allVuelos as $v){
      if(in_array(strval($v['flight_id']), $cart['vuelos'])){
        array_push( $vcarrito, $v);
      }
    }
  }
  return $vcarrito ?? null;
}
// calculo del precio total:
function calcPrecioTotal($vcarrito,$cart){
  $total = 0;
  foreach($vcarrito as $c){
    $total += $c['price'] * $cart['cantidad'][$c['flight_id']];
  }
  return $total;
}
// eliminar de carrito
function carritoDel($vuelos){
  $carrito = unserialize($_COOKIE['cart'.$_SESSION['userid']]);
  foreach($vuelos as $v){
    $key = array_search($v,$carrito['vuelos']);
    if(!is_null($key)){
      unset($carrito['vuelos'][$key]);
      unset($carrito['cantidad'][$v]);
    }
  }
  return $carrito;
}
// eliminar carrito
function carritoDestroy(){
  $cartname = 'cart' . strval($_SESSION['userid']);
  setCookie($cartname, '', time() - 99999, "/");
}
