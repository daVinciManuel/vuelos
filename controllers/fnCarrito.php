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
    // creo un array con la cantidad de cada producto
    if(!isset($cart['cantidad'][$vuelo])){
      $cart['cantidad'][$vuelo] = 2;
    }else{
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
  setCookie("cart", $cart, time() + 3600 * 1, "/");
}
// extrae la informacion para mostrar el carrito
function carritoContains($flight){
  $flightInCart = false;
  if(in_array(strval($flight['flight_id']), CART['vuelos'])){
    $flightInCart = true;
  }
  return $flightInCart;
}
// mostrar carrito
function mostrarCarrito(){
  if( !defined('CART') ){
    define('CART', unserialize($_COOKIE['cart']));
  }
  if(!empty(CART['vuelos'])){
    define('VCARRITO',array_filter(VUELOS, 'carritoContains') ?? null);
  }
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
