<?php #index controller
include 'config.php';
$title="Home";
include 'templates/header.phtml';
if(users::loggedIn()) { 
include 'templates/main.phtml';
}else {
	include 'templates/home.phtml';
}
include 'templates/footer.phtml';
?>			