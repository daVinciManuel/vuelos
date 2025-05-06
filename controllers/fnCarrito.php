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
  $cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array('vuelos' => array(), 'cantidad' => array());
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
  $cartname = 'cart' + $_SESSION['userid']
  setCookie("cart", $cart, time() + 3600 * 1, "/");
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
  return $vcarrito;
}
// calculo del precio total:
function calcPrecioTotal($vcarrito){
  $total = 0;
  foreach(VCARRITO as $c){
    $total += $c['price'] * CART['cantidad'][$c['flight_id']];
  }
  return $total;
}
// eliminar de carrito
function carritoDel($vuelos){
  $carrito = unserialize($_COOKIE['cart']);
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
  setCookie("cart", '', time() - 99999, "/");
}
