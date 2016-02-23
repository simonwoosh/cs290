<?php #flightlookup controller
include 'config.php';
users::protectArea();
$user = new user($_SESSION['id']);
$title="Book Flight";
include 'templates/header.phtml';
include 'templates/flightlookup.phtml';
include 'templates/footer.phtml';
?>			