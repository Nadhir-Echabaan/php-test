<?php 
declare(strict_types=1) ;
require_once "../controllers/AuthController.php" ;

if(isset($_SESSION["user_id"])){
    header("Location: dashboard.php");
    die();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    handleLogin(); 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="post">
    <input type="text" name="user_input" placeholder="Username"> 
    <input type="password" name="password" placeholder="Password"> 
    <button>Login</button>
</form>
</body>
</html>