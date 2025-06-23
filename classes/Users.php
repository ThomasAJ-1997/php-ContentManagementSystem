<?php

class Users 
{
    private $conn;
    private $email;
    private $password;

    public function __construct($conn, $email, $password) 
    {
        $this->conn = $conn;
        $this->email = $email;
        $this->password = $password;
    }

    public function login($conn, $email, $password): array|false 
    {
        $sql = "SELECT * FROM users WHERE email = :email" . " AND password = :password" . " AND active = 1";

        $hashed_password = SHA1($password);
        
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function all_users($conn): array|false 
    {
        $sql = "SELECT * FROM users";
        
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add_user($username, $email, $password, $active = 1): bool 
    {
        $hashed_password = SHA1($password);
        
        $sql = "INSERT INTO users (username, email, password, active) VALUES (:username, :email, :password, :active)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':active', $active, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function edit_user($id, $username, $email, $password, $active = 1): bool 
    {
        $hashed_password = SHA1($password);
        
        $sql = "UPDATE users SET username = :username, email = :email, password = :password, active = :active WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':active', $active, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function get_user_by_id($id): array|false 
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete_user($id): bool 
    {
        $sql = "DELETE FROM users WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }


}