<?php
function connect(){

    $dbhost = 'localhost';
    $username = 'root';
    $password = 'rootroot';
    $dbname = 'airportdb';

    try{
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
    echo 'error connect: '. $e->getMessage();
        $conn=null;
        die($e->getMessage());
    }
  return $conn;
}
