<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (! $_SESSION['loggedIn'] || empty($_SESSION['loggedIn'])) {
	$_SESSION['loggedIn'] = false;
	header('Location: Login.php');
	die();
} else if ($_SESSION['loggedIn']) {
	$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
	$db = new PDO($dsn, 'til1', 'abctil1354');
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
?>