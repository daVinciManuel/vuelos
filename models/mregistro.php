<?php
function registra($name,$birthdate,$sex,$street,$city,$country,$email,$phone){
  $conn = connect();
  $conn->beginTransaction();
  $done = false;
  try{
    $sql = 'INSERT INTO passengerdetails (passenger_id,name,birthdate,sex,street,city,zip,country,emailaddress,telephoneno,pass)';
    $sql .= 'VALUES (:passenger_id,:name,:birthdate,:sex,:street,:city,:zip,:country,:emailaddress,:telephoneno,:pass)';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':name',$name);
    $stmt->bindValue(':birthdate',$birthdate);
    $stmt->bindValue(':sex',$sex);
    $stmt->bindValue(':street',$street);
    $stmt->bindValue(':city',$city);
    $stmt->bindValue(':country',$country);
    $stmt->bindValue(':emailaddress',$email);
    $stmt->bindValue(':telephoneno',$phone);

    $id = getNextPassengerId();
    $zip = rand(1234,9999);
    $pass = password_hash($birthdate, PASSWORD_DEFAULT);

    $stmt->bindValue(':passenger_id',$id);
    $stmt->bindValue(':zip',$zip);
    $stmt->bindValue(':pass',$pass);
    $stmt->execute();
    $conn->commit();
    $done = true;
  }catch(PDOException $e){
    echo 'Error inserting data: '. $e->getMessage();
    $conn->rollback();
    $done = false;
  }
  return $done;
}
function getNextPassengerId(){
  $conn = connect();
  try{
    $sql = 'SELECT max(passenger_id) FROM passengerdetails';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $lastId = $stmt->fetchColumn();

    $result = 1 + intval($lastId);
  }catch(PDOException $e){
    echo 'ERROR querying passengerdetails: '. $e->getMessage();
  }
  return $result ?? 0;
}
