<?php session_start();
session_destroy();unset($user); header('Location: index.php'); ?>