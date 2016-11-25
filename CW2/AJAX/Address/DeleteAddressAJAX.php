<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (empty($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || empty($_SESSION['uID']) || empty($_POST['AddressID'])) {
	http_response_code(400);
	die();
}

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$delete = $db->prepare('Delete from Address WHERE UID=:uID AND AddressID=:addressID');
$delete->bindParam(':uID', $_SESSION['uID']);
$delete->bindParam(':addressID', $_POST['AddressID']);

if (!$delete->execute()){
	http_response_code(500);
	die();
}
?>