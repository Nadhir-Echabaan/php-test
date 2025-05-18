<?php 

require_once './config.php'; 
require_once './models/UserModel.php';

function handleSignup() {
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

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
            $success = createUser($pdo, $username, $email, $hashedPassword);
            if ($success) {
                header('Location: /views/login.php');
                exit;
            } else {
                $errors[] = 'Failed to register user.';
            }
        }
    include 'views/signup.php';
}
}; 
