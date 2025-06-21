<?php 

require 'classes/Connect.php';
require 'includes/config.php';

$db = new Connect();
$conn = $db->dbConnect();

?>

<?php require 'includes/header.php'; ?>

<?php require 'includes/navigation.php'; ?>

<h1 style="margin-top: 2rem">This is the PHP Content Management System</h1>

<?php require 'includes/footer.php'; ?>