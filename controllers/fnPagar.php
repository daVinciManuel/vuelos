<?php
function storeCarritoPagado($cart,$userid){
  foreach($cart['vuelos'] as $v){
    $cantidad = $cart['cantidad'][$v];
    while($cantidad > 0){
      insertReserva(nextBookingId(),$v,$userid,getPriceOf($v));
      $cantidad -= 1;
    }
  }
}
