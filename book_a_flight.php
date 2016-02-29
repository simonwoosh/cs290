<?php #Book a flight controller
include 'config.php';
users::protectArea();
$user = new user($_SESSION['id']);
$airports = airports::getAll();
$title="Book a flight";
include 'templates/header.phtml';
include 'templates/book_a_flight.phtml';
include 'templates/footer.phtml';
?>			