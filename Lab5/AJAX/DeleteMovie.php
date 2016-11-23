<?php
session_start();

if (empty($_POST['MovieTitle']) || empty($_SESSION['uID'])){
	http_response_code(400);
	die();
}

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$fetch = $db->prepare('Select movieID from my_movies where movieTitle = :movieTitle');
$delete = $db->prepare('Delete from users_movies WHERE movieID=:movieID AND uID=:uID');

$fetch->bindParam(':movieTitle', $_POST['MovieTitle']);
if (!$fetch->execute()){
	http_response_code(500);
	die();
}

$movieID = $fetch->fetchColumn(0);

$delete->bindParam(':uID', $_SESSION['uID']);
$delete->bindParam(':movieID', $movieID);
if (!$delete->execute()){
	http_response_code(500);
	die();
}
?>