<?php

$user = 'ventrea2';
$password = 'thoE9iEm';

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_fall17_ventrea2', $user, $password);

include('functions.php');

session_start();

$current_url = basename($_SERVER['REQUEST_URI']);

function autoloader($class) {
	include 'class.' . $class . '.php';
}

spl_autoload_register('autoloader');

if (!isset($_SESSION["crewid"]) && $current_url != 'login.php') {
    if (!isset($_SESSION["crewid"]) && $current_url == 'signup.php?action=add'){
		
	}
	else{
		header("Location: login.php");
	}
}

elseif (isset($_SESSION["crewid"])) {
	$user = new User($_SESSION['crewid'], $database);
}
