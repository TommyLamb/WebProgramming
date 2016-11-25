<?php
session_start();

if (empty($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || empty($_SESSION['uID']) || empty($_POST['AddressID'])) {
	http_response_code(400);
	die();
} 

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $db->prepare('Select * from Address Where UID = :uID AND AddressID = :addressID');
$statement->bindParam(':uID', $_SESSION['uID']);
$statement->bindParam('addressID', $_POST['AddressID']);

if ($statement->execute()){
	$result = $statement->fetch(PDO::FETCH_ASSOC);
	echo json_encode($result);
} else {
	http_response_code(500);
	die();
}
?>