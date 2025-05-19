<?php 
function createUser ($pdo,string $username,string $email,string $hashedPassword) {
  $sql_query = "INSERT INTO users (username ,email ,password) VALUES (:username ,:email ,:password);";
  $stmt = $pdo->prepare($sql_query);

  $stmt->bindParam(":username", $username); 
  $stmt->bindParam(":email", $email); 
  $stmt->bindParam(":password",$hashedPassword); 

  $stmt->execute(); 

  return true; 
}; 
function loginWithUsernameOrEmail ($pdo, string $userInput) {
  $sql_query = "SELECT * FROM users WHERE username = :userInput OR email = :userInput;"; 
  $stmt = $pdo->prepare($sql_query); 

  $stmt->bindParam(":userInput", $userInput); 
  $stmt->execute(); 

  $query_result = $stmt->fetch(PDO::FETCH_ASSOC); 
  return $query_result; 
}
