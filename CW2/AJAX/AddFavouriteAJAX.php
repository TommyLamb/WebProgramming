<?php
session_start();

if (empty($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || empty($_SESSION['uID']) || empty($_POST['ProductName'])) {
	http_response_code(400);
	die();
} else {
	$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
	$db = new PDO($dsn, 'til1', 'abctil1354');
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$statement = $db->prepare('Insert Into Favourites VALUES (:ProductName, :UID)');
	$statement->bindParam(':ProductName', $_POST['ProductName']);
	$statement->bindParam(':UID', $_SESSION['uID']);
	if ($statement->execute()){
		if ($statement->rowCount()) {
			http_response_code(200);
			die();
		} else {
			http_response_code(500);
			die();
		}
	} else {
		http_response_code(500);
		die();
	}
}
?>