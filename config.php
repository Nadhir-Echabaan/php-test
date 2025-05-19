<?php 
// DATA BASE CONNECTION 
$host = 'localhost';
$dbname = 'secure_notes';
$username = 'root';  
$password = 'goodmorning';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
  die("Connection failed " . $e->getMessage()); 
}

// SESSION MANAGMENT 
ini_set("session.use_only_cookies" , 1 );
ini_set("session.use_strict_mode" , 1 );


session_set_cookie_params([
    "lifetime" => 1800 , 
    "domain" => "localhost" ,
    "path" => "/", 
    "secure" => true  , 
    "httponly" => true , 
]); 

session_start();

if(!isset($_SESSION["last_regenerated"])){
        regenrate_session_id ();
}else{
    $interval = 60 * 15 ; 
    if(time() - $_SESSION["last_regenerated"] >= $interval){
        regenrate_session_id ();  
    }
}; 

function regenrate_session_id () {
  session_regenerate_id(true);
  $_SESSION["last_regenerated"] = time(); 
}; 