<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (empty($_POST['Username'])){
	http_response_code(400);
	die();
}

$statement = $db->prepare('Select * from Customer where Username = :username');
$statement->bindParam(':username', $_POST['Username']);
if ($statement->execute()){
	if ($statement->rowCount()){
		http_response_code(403);
		die();
	} else {
		http_response_code(200);
		die();
	}
} else {
	http_response_code(500);
	die();
}
?>