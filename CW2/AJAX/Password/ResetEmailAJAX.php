<?php session_start();
if (empty($_POST['Username'])){
	http_response_code(400);
	die();
}

error_reporting(E_ALL);
ini_set('display_errors', '1');

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $db->prepare('Select Username, UID From Customer WHERE Username = :username');
$statement->bindParam(':username', $_POST['Username']);
$statement->execute();

if($statement->rowCount() != 1){
	die();
	#No error code, as this should silently fail:
	#Hackers should not be told if the email was sent successfully,
	#or if the email corresponds to an acutal account.
	#However the CheckUsernameAJAX does this, which is a vulnerability.
}

$result = $statement->fetch(PDO::FETCH_ASSOC);
$resetCode = password_hash(time(), PASSWORD_DEFAULT);

if(!mail($result['Username'], "A Test", "Reset Code is $resetCode", 'From: Lamb Paints <til1@hw.ac.uk>'."\r\n")){
	#The result of the DB uery is used to prevent $_POST being used as a vector for email injection.
	die();
}

$_SESSION['resetUID']=$result['UID'];
$_SESSION['resetTime']=(time()+3600); #Current UNIX timestamp time + 1 hour
$_SESSION['resetCode']=$resetCode;
$_SESSION['resetAttempts'] = 0;

?>