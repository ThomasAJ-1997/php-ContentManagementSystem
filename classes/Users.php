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
  
}