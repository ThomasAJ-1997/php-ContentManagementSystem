<?php 

class Authenticate 
{
    public function secure()
    {
        if (!isset($_SESSION['id'])) {
            echo 'You are not logged in. Please log in to access this page.';
            die();
        }
    }

    public function set_message($message)
    {
        $_SESSION['message'] = $message;
    }

    public function get_message()
    {
        if (isset($_SESSION['message'])) {
            echo '<p>' . $_SESSION['message'] . '</p> <hr>';
            unset($_SESSION['message']);
           
        }
    }
       
}