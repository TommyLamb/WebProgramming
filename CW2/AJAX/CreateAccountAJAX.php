<?php
session_start();

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$required = ['Username2','Password2','FName','SName','TNumber'];

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


$customerStatement = $db->prepare('insert into Customer (Username,Password,FName,SName, TNumber) VALUES (:Username,:Password,:FName,:SName,:TNumber)');
$getuID = $db->prepare('Select UID from Customer where Username = :username');
$getuID->bindParam(':username', $_POST['Username']);

if ($customerStatement->execute($values)){
	if($getuID->execute()){
		$uid = $getuID->fetchColumn(0);
		$_SESSION['loggedIn']=True;
		$_SESSION['uID']=$uid;
		http_response_code(200);
		die();
	} else {
		http_response_code(418); #"I'm a teapot" response code
	}
} else {
	http_response_code(500);
	die();
}

?>