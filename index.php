<?php #index controller
include 'config.php';
$title="Home";
include 'templates/header.phtml';
if(users::loggedIn()) { 
header('Location: main.php');
exit;
}else {	
	include 'includes/login.php';
	include 'templates/home.phtml';
}
include 'templates/footer.phtml';
?>			