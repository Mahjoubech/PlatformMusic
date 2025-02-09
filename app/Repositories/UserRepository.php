<?php
namespace App\Repositories;

use App\Models\User;
use Config\Database;

class UserRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByEmail(string $email): ?User {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return $userData ? new User($userData) : null;
    }

    public function create(User $user): bool {
        $stmt = $this->db->prepare(
            'INSERT INTO users (username, email, mot_pass, role) 
             VALUES (:username, :email, :password, :role)'
        );
        
        return $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'role' => $user->getRole()
        ]);
    }
}
