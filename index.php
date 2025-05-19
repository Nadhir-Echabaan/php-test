<?php
if(isset($_GET["login"])||isset( $_SESSION["user_id"])){
    header("Location: views/dashboard.php");
    die();
}else{
    header("Location: views/login.php");
}
