<?php
function getVuelosReservadosPor($userid){
  $conn = connect();
    try {
        $sql = 
        'SELECT booking.booking_id, flightno, airline.airlinename, from_a, to_a, departure, arrival
        FROM flight
        JOIN airline ON flight.airline_id = airline.airline_id
        JOIN booking ON flight.flight_id = booking.flight_id
        WHERE booking.seat IS NULL AND booking.passenger_id = :userid';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':userid',$userid);
        $stmt->execute();
        $vuelos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = $vuelos;
    } catch(PDOException $e) {
        echo "Error extracting flights data: " . $e->getMessage();
        $result = null;
    }
  $conn = null;
  return $result ?? null;
}
function asignarAsiento($booking_id){
  $done = false;
  $asiento = nuevoAsiento();
  $conn = connect();
  try{
    $sql = 'UPDATE booking SET booking.seat = :seat WHERE booking_id = :booking_id AND booking.seat IS NULL';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':seat',$asiento);
    $stmt->bindValue(':booking_id',$booking_id);
    $stmt->execute();
    // si ha cambiado alguna linea:
    if($stmt->rowCount() > 0){
      $done = true;
    }
  }catch(PDOException $e){
    $done = false;
    echo 'ERROR updating booking table: '. $e->getMessage();
  }
  return $done ? $asiento : null;
}
function nuevoAsiento(){
  $abc = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
  $num = rand(100,999);
  $letter = $abc[($num*rand(5,50)) % strlen($abc)];
  $asiento = strval($num) . $letter;
  return $asiento;
}
function getVueloOf($booking_id){
  $conn = connect();
  try{
    $sql = 'SELECT flight.flightno FROM booking JOIN flight ON booking.flight_id = flight.flight_id WHERE booking_id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id',$booking_id);
    $stmt->execute();
    $vueloId = $stmt->fetchColumn();
  }catch(PDOException $e){
    echo 'Error extracting data from booking: ' . $e->getMessage();
  }
  return $vueloId;
}
