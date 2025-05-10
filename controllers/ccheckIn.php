<?php
require_once './checkOAuth.php';
require_once '../db/connect.php';
require_once '../models/mcheckIn.php';
if(isset($_POST['checkIn']) && isset($_POST['reserva_id'])){
  var_dump($_POST);
  
  $asiento = asignarAsiento($_POST['reserva_id']);
  if(isset($asiento)){
    echo '<br>';
    echo 'asiento: <b>'.$asiento.'</b>';
    echo '<br>';
    echo 'vuelo: <b>'.getVueloOf($_POST['reserva_id']).'</b>';
  }
}
$allVuelos = getVuelosReservadosPor($_SESSION['userid']);
if(count($allVuelos) == 0){
  $allVuelos = null;
}
require_once '../views/vcheckIn.php';
