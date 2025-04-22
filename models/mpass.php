<?php
// ---------- FUNCION CREAR COLUMNA PARA PASSWORDS 
function createColumnForPasswords()
{
    $conn = connect();
    $done = false;
    try {
        $conn->beginTransaction();
        $query = "ALTER TABLE passengerdetails ADD COLUMN pass VARCHAR(80)";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $conn->commit();
    $done = true;
    } catch (PDOException $e) {
        $conn->rollback();
        die($e->getMessage());
    }
    $conn = null;
    return $done;
}

// ---------- FUNCION COMPROBAR COLUMNA PARA PASSWORDS EXISTE
// NO FUNCIONA
function passColumnExists() {
  $conn = connect();
    try {
        $sql = "SELECT pass FROM passengerdetails LIMIT 2";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchColumn();
    } catch(PDOException $e) {
        echo "Error checking pass column: " . $e->getMessage();
        $result = null;
    }
  $conn = null;
  return $result > 0? true : false;
}

// ------------ FUNCION RELLENAR COLUMNA PASSWORDS PARA UN USUARIO
function fillPass($id,$password){
  $conn = connect();
  $conn->beginTransaction();
  $done = '0';
  try{
    $sql = "UPDATE passengerdetails SET pass = :password WHERE passenger_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam('id',$id);
    $stmt->bindParam('password',$password);
    $stmt->execute();
    $conn->commit();
    $done = 'Y';
  }catch(PDOException $e){
    echo 'error mysql: '. $e->getMessage();
    $done = 'N';
    $conn->rollback();
  }
  // $conn = null;
  return $done;
}
// ------------- FUNCION EXTRAER CLAVES NO ENCRIPTADAS E id
function getUsersData(){
  $conn = connect();
  try{
    $sql = "SELECT passenger_id,birthdate FROM passengerdetails";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo "Error extracting users data: " . $e->getMessage();
    $result = null;
  }
  return $result;
}
