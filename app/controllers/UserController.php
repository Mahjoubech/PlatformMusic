<?php

namespace App\Controllers;

use App\Models\User;

class UserController {
    public function index() {
        require_once '../app/views/user/dashboard.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            if ($user->authenticate($_POST['email'], $_POST['password'])) {
                header('Location: /');
            } else {
                echo "Invalid credentials!";
            }
        } else {
            require_once '../app/views/user/login.php';
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $user->register($_POST['name'], $_POST['email'], $_POST['password']);
            header('Location: /login');
        } else {
            require_once '../app/views/user/register.php';
        }
    }
}
