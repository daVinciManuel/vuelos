<?php
// UNFINNISHED
function getPasswordOf($email) {
  $conn = connect();
    try {
        $sql = "SELECT pass FROM passengerdetails WHERE emailaddress = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    } catch(PDOException $e) {
        echo "Error extracting user data: " . $e->getMessage();
        return null;
    }
  $conn = null;
}
