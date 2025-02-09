<?php
namespace App\Models;

class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;

    public function __construct(array $data = []) {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->role = $data['role'] ?? 'member';
    }

    // Getters and setters
    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getRole() { return $this->role; }
    public function getPassword() { return $this->password; }
}

