<?php
require_once './checkOAuth.php';
// desplegable de vuelos:
require_once './fnReservas.php';
$allVuelos = getListaVuelos();

// eliminar del carrito
if(isset($_POST['removeFromCart']) && isset($_POST['flightsToRemove'])){
  include_once './fnCarrito.php';
  $cart = carritoDel($_POST['flightsToRemove']);
  if(!empty($cart['vuelos'])){
    carritoSave($cart);
  }else{
    carritoDestroy();
  }
}
// agregar al carrito
if(isset($_POST['addToCart']) && isset($_POST['flight'])){
  include_once './fnCarrito.php';
  $cart = carritoAdd($_POST['flight']);
  carritoSave($cart);
  $vcarrito = carritoToView($cart,$allVuelos);
}elseif(isset($cart)){
  include_once './fnCarrito.php';
  $vcarrito = carritoToView($cart,$allVuelos);
}elseif(isset($_COOKIE['cart'.strval($_SESSION['userid'])])){
  include_once './fnCarrito.php';
  $cart = unserialize($_COOKIE[ 'cart'.strval($_SESSION['userid']) ]);
  $vcarrito = carritoToView($cart,$allVuelos);
}

// Respuesta de Redsys
if(isset($_POST['Ds_SignatureVersion']) && isset($_POST["Ds_MerchantParameters"]) && isset($_POST["Ds_Signature"]) ) {//URL DE RESP. ONLINE
  echo 'REDSYS RESPONSE METHOD: POST <br>';
  include_once './fnRedsys.php';
  $pagoOK = redsysHandle($_POST["Ds_SignatureVersion"],$_POST["Ds_MerchantParameters"],$_POST["Ds_Signature"]); 
}elseif (isset($_GET['Ds_SignatureVersion']) && isset($_GET["Ds_MerchantParameters"]) && isset($_GET["Ds_Signature"]) ) {//URL DE RESP. ONLINE
  echo 'REDSYS RESPONSE METHOD: GET <br>';
  include_once './fnRedsys.php';
  $pagoOK = redsysHandle($_GET["Ds_SignatureVersion"],$_GET["Ds_MerchantParameters"],$_GET["Ds_Signature"]); 
}
// si PAGO OK => guardar en BD
if(isset($pagoOK) && isset($cart)){
  if($pagoOK){
  // guardar en db:
    include_once './fnSavePago.php';
    if(storeCarritoPagado($cart,$_SESSION['userid'])){
      echo '<b>ALERT:</b> pago realizado correctamente :D';
      carritoDestroy();
      $cart = null;
      $vcarrito = null;
    }
  }else{
    echo '<b>ALERT:</b> pago NO realizado D:';
  }
}
if(isset($vcarrito) && isset($cart)){
// --- calc PRECIO TOTAL
  $precioTotal = calcPrecioTotal($vcarrito, $cart);
  $enablePago = true;
// ---- mostrar BOTON PAGAR
  include_once './fnRedsys.php';
  $redsysData = setRedsysValues($precioTotal) ?? array();
  $version    = $redsysData['version'] ?? '';
  $params     = $redsysData['params'] ?? '';
  $signature  = $redsysData['signature'] ?? '';
  
}
require_once '../views/vreservas.php';
