<?php 

session_start();

require 'classes/Connect.php';
require 'classes/Authenticate.php';

$secure = new Authenticate();
$secure->secure();

$db = new Connect();
$conn = $db->dbConnect();

?>

<?php require 'includes/header.php'; ?>

<?php require 'includes/navigation.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <h1 class="display-1">Dashboard</h1>
  
        <a href="users.php">User Management</a>
        <a href="posts.php">Post Management</a>

    </div>
</div>

<?php require 'includes/footer.php'; ?>