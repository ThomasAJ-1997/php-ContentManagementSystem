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

<h1 style="margin-top: 2rem">Admin dashboard </h1>

<?php require 'includes/footer.php'; ?>