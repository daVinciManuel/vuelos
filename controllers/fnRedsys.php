<?php
// PREPARAR ENVIO A REDSYS
function setRedsysValues($price){
	include_once './API_PHP/redsysHMAC256_API_PHP_7.0.0/apiRedsys.php';
	$miObj = new RedsysAPI;
	// $url="http://sis-t.redsys.es:25443/sis/realizarPago";
  $urlOKKO="http://localhost/apps/vuelos/controllers/creservas.php";
  $url="http://localhost/apps/vuelos/controllers/creservas.php";
  // $urlOKKO="http://192.168.206.130/apps/vuelos/controllers/creservas.php";
  $id = rand(10000,99999);
  // total a pagar
	$amount=floatval($price)*100;
	// Se Rellenan los campos
	$miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
	$miObj->setParameter("DS_MERCHANT_ORDER",$id);
	$miObj->setParameter("DS_MERCHANT_MERCHANTCODE",'263100000');
	$miObj->setParameter("DS_MERCHANT_CURRENCY",'978');
	$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",'0');
	$miObj->setParameter("DS_MERCHANT_TERMINAL",'13');
	$miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
	$miObj->setParameter("DS_MERCHANT_URLOK",$urlOKKO);
	$miObj->setParameter("DS_MERCHANT_URLKO",$urlOKKO);
	$miObj->setParameter("DS_MERCHANT_PAYMENTMETHOD",'C');

	//Datos de configuración
	$version="HMAC_SHA256_V1";
  $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
	// Se generan los parámetros de la petición
	$params = $miObj->createMerchantParameters();
	$signature = $miObj->createMerchantSignature($kc);
  return array('version' => $version, 'params' => $params, 'signature' => $signature);
}
// TRATAR RESPUESTA DE REDSYS
function redsysHandle($version,$datos,$signatureRecibida){
  $pagoOK = false;
    include_once './API_PHP/redsysHMAC256_API_PHP_7.0.0/apiRedsys.php';
    $miObj = new RedsysAPI;
    $decodec = $miObj->decodeMerchantParameters($datos);
    $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
    $firma = $miObj->createMerchantSignatureNotif($kc,$datos);
    if ($firma === $signatureRecibida){
      // codigo de respuesta:
      $responseCode = $miObj->getParameter("Ds_Response");
      // si codigo ok => guardar en DB
      if($responseCode === "0000"){
        $pagoOK = true;
      }
    }
  return $pagoOK;
}
