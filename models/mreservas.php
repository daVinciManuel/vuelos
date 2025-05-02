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
    'SELECT flight_id, flightno, flight.airline_id,
    from, to, departure, arrival
          FROM flight, airplane
          WHERE flight.airplane_id = airplane.airplane_id
          AND airplane.capacity >
          (SELECT count(booking.booking_id) FROM booking
          WHERE booking.flight_id = flight.flight_id)';

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $vuelos = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error extracting user data: " . $e->getMessage();
        $result = null;
    }
  $conn = null;
  return $result ?? null;
}

