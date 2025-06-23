<?php

class Posts 
{

    private $conn;


    public function __construct($conn)    {
        $this->conn = $conn;

    }

        public function all_posts($conn): array|false 
    {
        $sql = "SELECT * FROM posts";
        
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     public function add_post($title, $content, $author, $date, $edited): bool 
    {
        
        $sql = "INSERT INTO posts (title, content, author, date, edited) VALUES (:title, :content, :author, :date, :edited)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':edited', $edited, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function get_post_by_id($id): array|false 
    {
        $sql = "SELECT * FROM posts WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function edit_post($id, $title, $content, $author, $date, $edited): bool 
    {
        $sql = "UPDATE posts SET title = :title, content = :content, author = :author, date = :date, edited = :edited WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':edited', $edited, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function delete_post($id): bool 
    {
        $sql = "DELETE FROM posts WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
  

}