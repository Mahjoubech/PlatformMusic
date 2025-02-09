<?php
namespace App\Controllers;

use App\Services\AuthService;

class AuthController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $user = $this->authService->login($email, $password);
            if ($user) {
                header('Location: /dashboard');
                exit;
            }
            
            // Handle error
            $error = 'Invalid credentials';
        }
        
        require_once 'views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData = [
                'username' => $_POST['username'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'role' => 'member'
            ];
            
            if ($this->authService->register($userData)) {
                header('Location: /login');
                exit;
            }
            
            // Handle error
            $error = 'Registration failed';
        }
        
        require_once 'views/auth/register.php';
    }
}