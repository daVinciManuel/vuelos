<?php
// extrae informacion de todos los vuelos vuelos disponibles
// una vez extraido de la base de datos, lo guarda en $_SESSION
function getListaVuelos(){
  if(!isset($_SESSION['flights'])){
    include_once '../db/connect.php';
    include_once '../models/mreservas.php';
    $vuelos = getVuelosDisponibles();
    $_SESSION['flights'] = $vuelos;
  }else{
    $vuelos = $_SESSION['flights'];
  }
  return $vuelos;
}
