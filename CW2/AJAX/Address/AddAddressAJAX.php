<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (empty($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || empty($_SESSION['uID']) || empty($_POST['Update']) || ($_POST['Update'] == "true" && empty($_POST['AddressID']))) {
	http_response_code(400);
	die();
}

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$required = ['AddressLine1','AddressLine2','AddressLine3','AddressLine4','AddressCity','AddressPostCode', 'AddressCounty','AddressCountry'];

foreach ( $required as $field ) {
	if (! isset($_POST[$field])) {
		http_response_code(400);
		die();
	} else {
		if (empty($_POST[$field])) {
			$values[] = '';
		} else {
			$values[] = $_POST[$field];
		}
	}
}

//Use UID in Update query to prevent accidental/malicious overwriting of someone else's address

if ($_POST['Update'] == "true"){
	array_push($values, $_SESSION['uID'], $_POST['AddressID']);
$statement = $db->prepare('UPDATE Address SET Line1 = :line1, Line2 = :line2, Line3 = :line3, Line4 = :line4, City = :city, Postcode = :postcode, County = :county, Country = :country WHERE UID = :uid AND AddressID = :addressID');
} else {
array_unshift($values, $_SESSION['uID']);
$statement = $db->prepare('insert into Address (UID, Line1, Line2, Line3, Line4, City, Postcode, County, Country)  VALUES (:uid, :line1, :line2, :line3, :line4, :city, :postcode, :county, :country)');
}

if ($statement->execute($values)){
	http_response_code(200);
 	die();
} else {
	http_response_code(500);
	die();
}

?>