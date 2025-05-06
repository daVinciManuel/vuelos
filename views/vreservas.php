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
echo '      <form id="" name="" action="" method="post" class="card-body">';
echo '        <div class="form-group">';
echo '          Vuelos';
// ----------------- LISTADO DE PRODUCTOS ----------------------------------------
echo '          <select name="flight" class="">';
echo '            <option disabled selected>Selecciona una pista</option>';
if(defined('VUELOS')){
  $optionsList = '';
  foreach(VUELOS as $v){
    $optionsList .= '<option value="' . $v['flight_id'].'">';
    $optionsList .= $v['flightno'] . ' ';
    $optionsList .= $v['airlinename'] . ' ';
    $optionsList .= 'from <b>'.$v['from_a'].'</b> ';
    $optionsList .= 'to <b>'.$v['to_a'] .'</b> ';
    $optionsList .= '['.$v['departure'] .'] - [' . $v['arrival'] .'] ';
    $optionsList .= $v['price'] . '€';
    $optionsList .= '</option>';
  }
  echo $optionsList;
}
echo '          </select>';
echo '        </div>';
// BOTON AGREGAR AL CARRITO
echo '		<input type="submit" name="addToCart" value="Agregar al carrito" class="btn btn-info disabled">';
// BOTON COMPRAR 
echo '		<input type="submit" name="pay" value="Finalizar Compra" class="btn btn-info disabled">';
// --------------------- CARRITO ----------------------------------------------
if(defined('VCARRITO')){
  echo '      <hr>';
  echo '      <h3>Vuelos por pagar</h3>';
  echo '      <table>';
  echo '        <thead>';
  echo '          <tr>';
  echo '            <th>Vuelo</th>';
  echo '            <th>Numero de asientos</th>';
  echo '            <th>Precio por asiento</th>';
  echo '            <th>Seleccionar</th>';
  echo '          </tr>';
  echo '        </thead>';
  echo '        <tbody>';
  foreach(VCARRITO as $c){
    if($c){
      echo '          <tr>';
      echo '            <td>'. $c['flightno'] . ' '. $c['airlinename'] . ' [' . $c['departure'] . ' - '. $c['arrival'] .']</td>';
      
      echo '            <td> &nbsp;&nbsp;&nbsp;'. CART['cantidad'][$c['flight_id']] .'</td>';
      echo '            <td>'. $c['price'] . '€' . '</td>';
      // CASILLA PARA SELECCIONAR ITEM PARA ELIMINAR
      echo '            <td><input type="checkbox" name="flightsToRemove[]" value="'. $c['flight_id'].'"></td>';
      echo '          </tr>';
  }}
  echo '            <tr>';
  echo '              <td></td>';
  echo '              <td></td>';
  echo '              <td></td>';
  // BOTON PARA ELIMINAR ITEM DEL CARRITO
  echo '              <td><input type="submit" name="removeFromCart" value="Eliminar" class="btn btn-danger"></td>';
  echo '            </tr>';
  echo '            <tr>';
  echo '              <td><hr></td>';
  echo '              <td><hr></td>';
  echo '              <td><hr></td>';
  echo '              <td><hr></td>';
  echo '            </tr>';
  echo '            <tr>';
  echo '              <th>Total:</th>';
  echo '              <td></td>';
  echo '              <td></td>';
  echo '              <td>'.PRECIO_TOTAL. '€' .'</td>';
  echo '            </tr>';
  echo '        </tbody>';
  echo '      </table>';
}
echo '      </form>';
echo '      </div>';
echo '    </main>';
echo '  </body>';
echo '</html>';
