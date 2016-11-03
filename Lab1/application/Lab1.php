<!DOCTYPE html>
<html>
<head>

</head>

<body>

<?php
$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET ['MovieName'])) {
	$movieName = $_GET ['MovieName'];
	$statement = $db->prepare('SELECT movieTitle FROM my_movies where movieTitle = :name');
	$statement->execute(array (':name' => $movieName ));
	
	foreach ( $statement as $row ) {
		echo "The movie of today is " . $row ['movieTitle'] . "!";
	}
}
?>


</body>


</html>

