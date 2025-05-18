<?php 
function createUser ($pdo, $username, $email , $hashedPassword) {
  $sql = "INSERT INTO users (username ,email ,password) VALUES (:username ,:email ,:hashedPassword)";
  $stmt = $pdo->prepare($sql); 
  return $stmt->execute([
    ':username' => $username,
    ':email' => $email,
    ':password' => $hashedPassword
]);
}; 