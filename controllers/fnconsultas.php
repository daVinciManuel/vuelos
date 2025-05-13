<?php
function getReservasOf($person){
  if(!isset($_SESSION['reservas'])){
    include_once '../db/connect.php';
    include_once '../models/mconsultas.php';
    $reservas = getReservasFromDb($person);
    $_SESSION['reservas'] = $reservas;
  }else{
    $reservas = $_SESSION['reservas'];
  }
  return $reservas;
}
function getInfoOfReserva($reserva_id){
  $info = array();
  foreach($_SESSION['reservas'] as $r){
    if($r['booking_id'] == $reserva_id){
      $info = $r;
    }
  }
  return $info;
}
