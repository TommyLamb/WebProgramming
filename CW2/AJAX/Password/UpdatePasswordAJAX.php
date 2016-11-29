<?php
session_start();

if (empty($_SESSION['resetAuthorised']) || empty($_SESSION['resetUID']) || !isset($_POST['Password2'])){
	http_response_code(400);
	die();
}

if ($_SESSION['resetAuthorised']==TRUE){
	$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
	$db = new PDO($dsn, 'til1', 'abctil1354');
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$statement = $db->prepare('Update Customer SET Password = :newpassword WHERE UID = :uid');
	$statement->bindParam(':newpassword', password_hash($_POST['Password2'], PASSWORD_DEFAULT));
	$statement->bindParam(':uid', $_SESSION['resetUID']);
	
	$statement->execute();
	
	if ($statement->rowCount() != 1){
	http_response_code(500);
	die();
	}
	
	$_SESSION['uID'] = $_SESSION['resetUID'];
	$_SESSION['loggedIn'] = TRUE;
	unset($_SESSION['resetAuthorised'],$_SESSION['resetUID'], $_SESSION['resetTime'],$_SESSION['resetCode'], $_SESSION['resetAttempts']);
	
} else {
	http_response_code(403);
	die();
}

?>