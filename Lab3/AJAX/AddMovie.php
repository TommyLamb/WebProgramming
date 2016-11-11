<<<<<<< HEAD
<?php session_start();

if (empty($_GET['MovieTitle']) || empty($_SESSION['uID'])){
	http_response_code(400);
	die();
}

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$insert = $db->prepare('Insert Into users_movies VALUES (:uID,:movieID)');
$verify = $db->prepare('Select movieID from my_movies where movieTitle = :movieTitle');

$verify->bindParam(':movieTitle', $_GET['MovieTitle']);
if (!$verify->execute()){
	http_response_code(500);
	die();
}
$movieID = $verify->fetchColumn(0);

$insert->bindParam(':uID', $_SESSION['uID']);
$insert->bindParam(':movieID', $movieID);
if (!$insert->execute()){
	http_response_code(500);
	die();
}



?>
=======
<?php session_start();

if (empty($_POST['MovieTitle']) || empty($_SESSION['uID'])){
	http_response_code(400);
	die();
}

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$insert = $db->prepare('Insert Into users_movies VALUES (:uID,:movieID)');
$verify = $db->prepare('Select movieID from my_movies where movieTitle = :movieTitle');

$verify->bindParam(':movieTitle', $_POST['MovieTitle']);
if (!$verify->execute()){
	http_response_code(500);
	die();
}
$movieID = $verify->fetchColumn(0);

$insert->bindParam(':uID', $_SESSION['uID']);
$insert->bindParam(':movieID', $movieID);
if (!$insert->execute()){
	http_response_code(500);
	die();
}



?>
>>>>>>> origin/master
	