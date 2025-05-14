<?php
function getReservasOf($person){
  $conn = connect();
  $done = false;
  try{
    $query = 'SELECT booking.booking_id,flight.flightno, booking.seat, flight.from_a, flight.to_a, departure, arrival, airline.airlinename
              FROM flight
              JOIN booking ON flight.flight_id = booking.flight_id
              JOIN airline ON flight.airline_id = airline.airline_id
              WHERE booking.passenger_id = :person
              ORDER BY booking.booking_id ASC';
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':person',$person);
    $stmt->execute();
    $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($reservas)){
      $done = true;
    }
  }catch(PDOException $e){
    $done = false;
    echo 'ERROR extracting reservas data from booking,flight,airline: '. $e->getMessage();
  }
  return $done ? $reservas : null;
}
