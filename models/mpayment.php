<?php
function insertReserva($booking_id,$flight_id,$userid,$price){
  $conn = connect();
  $conn->beginTransaction();
  try{
    $sql = 'INSERT INTO booking(booking_id,flight_id,seat,passenger_id,price)
            VALUES (:booking_id,:flight_id,null,:passenger_id,:price)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':booking_id',$booking_id);
    $stmt->bindParam(':flight_id',$flight_id);
    $stmt->bindParam(':passenger_id',$userid);
    $stmt->bindParam(':price',$price);
    $stmt->execute();
    $conn->commit();
  }catch(PDOException $e){
    $conn->rollback();
    //die($e->getMessage());
    echo "Error inserting booking: " . $e->getMessage();
  }
  $conn = null;
}
function nextBookingId(){
  $conn = connect();
  try{
    $sql = 'SELECT max(booking_id) FROM booking';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $id = $stmt->fetchColumn();
    $id+=1;
  }catch(PDOException $e){
    echo "Error extracting booking_id: " . $e->getMessage();
  }
  $conn = null;
  return $id;
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
