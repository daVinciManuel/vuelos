<?php
function getPasswordOf($email) {
  $conn = connect();
    try {
        $sql = "SELECT pass FROM passengerdetails WHERE emailaddress = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $result = $stmt->fetchColumn();
    } catch(PDOException $e) {
        echo "Error extracting user data: " . $e->getMessage();
        $result = null;
    }
  $conn = null;
  return $result ?? null;
}
