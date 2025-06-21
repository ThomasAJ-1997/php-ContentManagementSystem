<?php 

class Connect {

    public function dbConnect() {

        $db_host = 'localhost';
        $db_name = 'tom_cms';
        $db_user = 'tom_cms';
        $db_pass = 'C*LT@/AI[]8DdF20';

        $dsn = 'mysql:host=' . $db_host . ";dbname=" . $db_name . ";charset=utf8";

        $conn = new PDO($dsn, $db_user, $db_pass);

        try {
            $db = new PDO($dsn, $db_user, $db_pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }

    }
}