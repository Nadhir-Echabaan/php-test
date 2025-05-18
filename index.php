<?php
require_once 'config.php';
require_once 'controllers/AuthController.php';
require_once 'models/UserModel.php';

$action = $_GET['action'] ?? 'login';

if ($action === 'signup') {
    handleSignup();
} else {
    echo "404 - Page not found";
}
