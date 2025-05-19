<?php 
require_once '../config.php'; 
require_once '../models/UserModel.php';

function handleSignup() {
    $username = $_POST['username'] ;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    try {
        $errors = [];

        if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
            $errors[] = 'All fields are required.';
        }
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email address.';
        }
    
        if (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters.';
        }
    
        if ($password !== $confirmPassword) {
            $errors[] = 'Passwords do not match.';
        }
    
        if (empty($errors)) {
            global $pdo;
            $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
            createUser($pdo, $username, $email, $hashedPassword);
            header("Location: ../index.php"); 
            die(); 
        }
    } catch (PDOException $e) {
        echo "connection failed: " . $e->getMessage(); 
    }
}; 

function handleLogin() {
    $userInput = $_POST["user_input"];
    $password = $_POST["password"]; 

    try {
        $errors = []; 

        if (empty($userInput) || empty($password)) {
            $errors[] = "all fields are required"; 
        }
        global $pdo; 
        $userExistance = loginWithUsernameOrEmail($pdo, $userInput); 
        if (!$userExistance) {
            $errors[] = "user not found in the database"; 
        }elseif($userExistance And !password_verify($password, $userExistance["password"])) {
            $errors[] = "wrong password"; 
        }else {
            $_SESSION["id"] = $userExistance["id"] ;
            $_SESSION["username"] = htmlspecialchars($userExistance["username"]) ;
            $_SESSION["last_regenrated"] = time() ; 

            header("Location: ../index.php?login=success");

            die(); 
        }

    } catch (PDOException $e) {
        echo "connection failed: " . $e->getMessage(); 
    }
}

function handleLogout() {
    session_unset(); 
    session_destroy();
    header("Location: ../index.php?logout=success");
    die();
}
