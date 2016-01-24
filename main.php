<?php #main controller
include 'config.php';
users::protectArea();
$user = new user($_SESSION['id']);
$title="Home";
include 'templates/header.phtml';
include 'templates/main.phtml';
include 'templates/footer.phtml';
?>			