<?php
// class User {
//     private $db;

//     public function __construct() {
//         $this->db = require '../config/database.php';
//     }

//     public function authenticate($email, $password) {
//         $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
//         $stmt->execute([$email]);
//         $user = $stmt->fetch(PDO::FETCH_ASSOC);
//         return password_verify($password, $user['password']);
//     }

//     public function register($username, $email, $password,$role) {
//         $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
//         $stmt = $this->db->prepare("INSERT INTO users (name, email, password,role) VALUES (?, ?, ?,?)");
//         return $stmt->execute([$username, $email, $hashedPassword,$role]);
//     }
// }

class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;

    public function __construct($id = null, $username = null, $email = null, $password = null, $role = null) {
        $this->id = $id;
      
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }
    public static function signup($name, $username, $email, $password, $role) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        if (strlen($password) < 6) {
            throw new Exception("Password must be at least 6 characters long");
        }
        $username = htmlspecialchars($username);

        if (self::findByEmail($email)) {
            throw new Exception("Email is already registered");
        }

        try {
            $db = Database::getInstance()->getConnection();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO user (name, last_name, email, password, role_id) 
                    VALUES (:name, :last_name, :email, :password, :role_id)";
            
            $stmt = $db->prepare($sql);
            $stmt->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                'role_id' => $role
            ]);
            
            return $db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Error during registration");
        }
    }  
    public function getId() {
        return $this->id;
    }
    
    
    public function getEmail() {
        return $this->email;
    }
    public function getrole(){
        return $this->role;
    }

    // Login method
    public static function signin($email, $password ,$role_id) {
        $user = self::findByEmail($email);
        
        if (!$user || !password_verify($password, $user->password)) {
            throw new Exception("Invalid email or password");
        }

        return $user;
    }

    // Find user by email
    public static function findByEmail($email) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User(
                $result['id'],
                $result['name'],
                $result['last_name'],
                $result['email'],
                $result['password'],
                $result['role_id']
            );
        }

        return null;
    }
}
