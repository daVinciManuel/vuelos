<?php
require_once './checkOAuth.php';
require_once './fnconsultas.php';
$reservas = getReservasOf($_SESSION['userid']);
if(isset($_POST['reserva_id'])){
  // muestro info del vuelo
  include_once '../db/connect.php';
  include_once '../models/mconsultas.php';
  $info = getInfoOfReserva($_POST['reserva_id']); 
  echo '$info: ';
  var_dump($info);
  echo '<br>';
}
require_once '../views/vconsultas.php';
