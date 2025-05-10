<?php
echo '<!DOCTYPE html>';
echo '<html>';
echo '  <head>';
echo '    <meta charset="UTF-8">';
echo '    <meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '    <title>Vuelos</title>';
echo '    <link rel="stylesheet" href="../css/bootstrap.min.css">';
echo '  </head>';
echo '  <body class="bg-dark">';
echo '    <header>';
echo '      <a class="btn btn-danger" href="./logout.php">Logout</a>';
echo '      <a class="btn btn-warning" href="./cinicio.php">Inicio</a>';
echo '    </header>';
echo '    <main>';
$nombre = $_SESSION['user'] ?? '';
echo '      <h1>WELCOME '. $nombre .'</h1>';
echo '      <div class="card border">';
// ---------------------------------------------------------------------------------
if(isset($allVuelos)){
  echo '      <form id="" name="" action="'.htmlentities($_SERVER["PHP_SELF"]) .'" method="post" class="card-body">';
  echo '        <div class="form-group">';
  echo '          Vuelos';
// ----------------- LISTADO DE RESERVAS ----------------------------------------
  echo '          <select name="reserva_id" class="">';
// echo '            <option disabled selected>Selecciona un vuelo</option>';
  $optionsList = '';
  foreach($allVuelos as $v){
    $optionsList .= '<option value="' . $v['booking_id'].'">';
    $optionsList .= $v['flightno'] . ' ';
    $optionsList .= $v['airlinename'] . ' ';
    $optionsList .= 'from <b>'.$v['from_a'].'</b> ';
    $optionsList .= 'to <b>'.$v['to_a'] .'</b> ';
    $optionsList .= '['.$v['departure'] .'] - [' . $v['arrival'] .'] ';
    $optionsList .= '</option>';
  }
  echo $optionsList;
  echo '          </select>';
// BOTON CHECK IN
  echo '          <br>';
  echo '          <input type="submit" name="checkIn" value="Check In" class="btn btn-info disabled">';
  echo '        </div>';
  echo '      </form>';
}else{
  echo '      <h4>No hay reservas disponibles para hacer CHECK IN.<br> Por favor, vuelva a Inicio.</h4>';
}
echo '      </div>';
echo '    </main>';
echo '  </body>';
echo '</html>';
