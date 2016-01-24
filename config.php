<?php

//configure database
require 'classes/db.php';

function __autoload($classname) {
	require 'classes/' . $classname . '.php';
}


//initiate variables and objects
$errors = array();

//universals
$company_name = "Our Service";
?>