<?php 
declare(strict_types=1) ;
require_once "../config.php" ;
require_once "../controllers/AuthController.php" ;

if (!isset($_SESSION["id"])) {
  header("Location: ../views/login.php");
  die();
}

if(isset($_GET["logout"])){
  session_destroy();
  header("Location: ../index.php");
  die();
}

function get_username_from_session(){
  if (isset($_SESSION["username"])) {
      echo $_SESSION["username"]; 
  }else {
      echo "an error occured while getting the username"; 
  }
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
  <p>Welcome to the dashboard! <span><?php get_username_from_session() ?></span></p>

</body>
<a href="?logout=true">Log out</a>
</html>