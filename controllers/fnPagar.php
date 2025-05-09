<?php
function storeCarritoPagado($cart,$userid){
  $done = false;
  foreach($cart['vuelos'] as $k => $v){
    $cantidad = $cart['cantidad'][$v];
    while($cantidad > 0){
      if(insertReserva(nextBookingId(),$v,$userid,getPriceOf($v))){
        $cantidad -= 1;
      }
    }
    unset($cart['vuelos'][$k]);
    unset($cart['cantidad'][$v]);
  }
  
  if(count($cart['vuelos']) == 0){
    $done = true;
  }
  return $done;
}
