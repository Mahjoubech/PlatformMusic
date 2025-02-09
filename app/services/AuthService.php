<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;

class AuthService {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function login(string $email, string $password): ?User {
        $user = $this->userRepository->findByEmail($email);
        
        if ($user && password_verify($password, $user->getPassword())) {
            $_SESSION['user_id'] = $user->getId();
            return $user;
        }
        
        return null;
    }

    public function register(array $userData): bool {
        $user = new User($userData);
        return $this->userRepository->create($user);
    }

    public function isAuthenticated(): bool {
        return isset($_SESSION['user_id']);
    }
}
