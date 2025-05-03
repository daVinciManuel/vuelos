<?php
# SELECT flight_id, flightno, flight.airplane_id
# FROM flight, airplane
# WHERE flight.airplane_id = airplane.airplane_id
# AND airplane.capacity >
#  (SELECT count(booking.booking_id) FROM booking
#  WHERE booking.flight_id = flight.flight_id);

function getVuelosDisponibles(){
  $conn = connect();
    try {
        $sql = 
        'SELECT flight.flight_id, flightno, airline.airlinename, from_a, to_a, departure, arrival, airplane.capacity
        FROM flight
        JOIN airplane ON flight.airplane_id = airplane.airplane_id
        JOIN airline ON flight.airline_id = airline.airline_id
        WHERE airplane.capacity >
        (SELECT count(booking.booking_id) FROM booking
        WHERE booking.flight_id = flight.flight_id)';

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $vuelos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($vuelos){
      foreach($vuelos as &$v){
        if($v['capacity'] < 100){
          $v['price'] = 80;
        }else if($v['capacity'] < 200){
          $v['price'] = 120;
        }else{
          $v['price'] = 300;
        }
      }
    }
        $result = $vuelos;
    } catch(PDOException $e) {
        echo "Error extracting flights data: " . $e->getMessage();
        $result = null;
    }
  $conn = null;
  return $result ?? null;
}
function getPriceOf($flight_id){
  $conn = connect();
  try{
    $sql = 'SELECT airplane.capacity FROM airplane JOIN flight ON flight.airplane_id = airplane.airplane_id WHERE flight.flight_id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id',$flight_id);
    $stmt->execute();
    $capacity = $stmt->fetchColumn();
    $price = 0;
    if($capacity && $capacity < 100){
      $price = 80;
    }else if($capacity < 200){
      $price = 120;
    }else{
      $price = 300;
    }
  }catch(PDOExcepion $e){
      echo "Error extracting flights data: " . $e->getMessage();
  }
  $conn = null;
  return $price ?? null;
}
