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
if(isset($vuelos)){
  $optionsList = '';
  foreach($vuelos as $v){
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
if(isset($carritoView) && count($carritoView) > 0){
  echo '      <hr>';
  echo '      <h3>Carrito</h3>';
  echo '      <table>';
  echo '        <thead>';
  echo '          <tr>';
  echo '            <th>Cancion</th>';
  echo '            <th>Cantidad</th>';
  echo '            <th>Precio</th>';
  echo '            <th></th>';
  echo '          </tr>';
  echo '        </thead>';
  echo '        <tbody>';
        foreach($carritoView as $c){
          if($c){

  echo '          <tr>';
  echo '            <td>'. $c['Name'].'</td>';
  echo '            <td> &nbsp;&nbsp;&nbsp;'. $_SESSION['carrito'][$c['TrackId']].'</td>';
  echo '            <td>'. $c['UnitPrice'] . '</td>';
  // CASILLA PARA SELECCIONAR ITEM PARA ELIMINAR
  echo '            <td><input type="checkbox" name="tracksToRemove[]" value="'. $c['TrackId'].'"></td>';
  echo '          </tr>';
        }}
  echo '            <tr>';
  echo '              <td></td>';
  echo '              <td></td>';
  // BOTON PARA ELIMINAR ITEM DEL CARRITO
  echo '              <td><input type="submit" name="removeFromCart" value="Eliminar" class="btn btn-danger"></td>';
  echo '            </tr>';
  echo '        </tbody>';
  echo '      </table>';
}
echo '      </form>';
echo '      </div>';
echo '    </main>';
echo '  </body>';
echo '</html>';
