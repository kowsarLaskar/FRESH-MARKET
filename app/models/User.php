<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // 1. REGISTER NEW USER
    public function register($data) {
        $this->db->query('INSERT INTO users (full_name, email, password, phone, role) VALUES(:name, :email, :password, :phone, :role)');
        
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']); // This will be the Hashed password
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':role', $data['role']); // Save the role selected by user

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // 2. LOGIN USER
    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check if user exists first
        if($row) {
            $hashed_password = $row->password;
            // Verify Password using PHP's built-in secure function
            if(password_verify($password, $hashed_password)) {
                return $row; // Success: Return the user row
            } else {
                return false; // Wrong Password
            }
        } else {
            return false; // User not found
        }
    }

    // 3. FIND USER BY EMAIL (Check for duplicates)
    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}