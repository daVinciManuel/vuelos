<?php
require_once './checkOAuth.php';
require_once '../db/connect.php';
require_once '../models/mconsultas.php';
$reservas = getReservasOf($_SESSION['userid']);
if(isset($_POST['reserva_id'])){
  // muestro info del vuelo
  include_once './fnconsultas.php';
  $info = getInfoOfReserva($_POST['reserva_id'], $reservas); 
}
require_once '../views/vconsultas.php';
