<?php
session_start();

if (empty($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || empty($_SESSION['uID']) ) {
	http_response_code(400);
	die();
}

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement=$db->prepare('Select * from Address WHERE UID = :uid');
$statement->bindParam(":uid", $_SESSION['uID']);
if ($statement->execute()){
	if ($statement->rowCount()){
		echo '<select name="SelectAddress" onchange="updateForm()">';
		foreach ($statement as $row){
			echo '<option label="'.$row['Line1'].'" value="'.$row['AddressID'].'"/>';
		}
		echo '</select>';
	} else {
		echo 'No Addresses Found!';
	}
} else {
	http_response_code(500);
	die();
}
?>