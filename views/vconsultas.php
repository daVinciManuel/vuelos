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
if(isset($reservas)){
  echo '      <form id="" name="" action="'.htmlentities($_SERVER["PHP_SELF"]) .'" method="post" class="card-body">';
  echo '        <div class="form-group">';
  echo '          Vuelos';
// ----------------- LISTADO DE RESERVAS ----------------------------------------
  echo '          <select name="reserva_id" class="">';
// echo '            <option disabled selected>Selecciona un vuelo</option>';
  $optionsList = '';
  foreach($reservas as $r){
    $optionsList .= '<option value="' . $r['booking_id'].'">';
    $optionsList .= 'Reserva '.$r['booking_id'] . ' ';
    $optionsList .= '</option>';
  }
  echo $optionsList;
  echo '          </select>';
// BOTON CHECK IN
  echo '          <br>';
  echo '          <input type="submit" name="consulta" value="Mostrar detalles" class="btn btn-info disabled">';
  echo '        </div>';
  echo '      </form>';
}else{
  echo '      <h4>No hay reservas disponibles para consultar .<br> Por favor, vuelva a Inicio.</h4>';
}
if(isset($info) && !empty($info)){
  echo '<table>';
  echo '  <thead>';
  echo '    <tr>';
  echo '      <th>Num Reserva</th>';
  echo '      <th>Num vuelo</th>';
  echo '      <th>Aerolinea</th>';
  echo '      <th>Origen</th>';
  echo '      <th>Destino</th>';
  echo '      <th>Salida</th>';
  echo '      <th>Llegada</th>';
  echo '      <th>Asiento</th>';
  echo '    </tr>';
  echo '  </thead>';
  echo '  <tbody>';
    echo '    <tr>';
    echo '      <td>'. $info['booking_id']. '</td>';
    echo '      <td>'. $info['flightno']. '</td>';
    echo '      <td>'. $info['airlinename']. '</td>';
    echo '      <td>'. $info['from_a']. '</td>';
    echo '      <td>'. $info['to_a']. '</td>';
    echo '      <td>'. $info['departure']. '</td>';
    echo '      <td>'. $info['arrival']. '</td>';
    echo '      <td>'. $info['seat']. '</td>';
    echo '    </tr>';
  echo '  </tbody>';
  echo '</table>';
}
echo '      </div>';
echo '    </main>';
echo '  </body>';
echo '</html>';
