<?php
function getInfoOfReserva($reserva_id, $reservas){
  $info = array();
  foreach($reservas as $r){
    if($r['booking_id'] == $reserva_id){
      $info = $r;
    }
  }
  return $info;
}
