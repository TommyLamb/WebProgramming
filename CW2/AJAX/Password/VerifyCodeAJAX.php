<?php
session_start();
if (empty($_POST['Code']) || empty($_SESSION['resetTime']) || !isset($_SESSION['resetAttempts']) || empty($_SESSION['resetCode']) || empty($_SESSION['resetUID'])){
	http_response_code(400);
	die();
}

if ($_SESSION['resetTime']<time() || $_SESSION['resetAttempts']==5){
	#The code has expired, either by time or too many failed attempts
	unset($_SESSION['resetTime'],$_SESSION['resetCode'], $_SESSION['resetAttempts'],$_SESSION['resetAuthorised']);
	http_response_code(500);
	die();
}

if ($_SESSION['resetCode'] != $_POST['Code']) {
	$_SESSION['resetAttempts'] += 1;
	http_response_code(500);
	die();
}

if ($_SESSION['resetCode']==$_POST['Code']) {
	$_SESSION['resetAuthorised'] = TRUE;
}
?>