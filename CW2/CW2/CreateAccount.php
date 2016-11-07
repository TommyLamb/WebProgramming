<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$required = ['Username','Password','FName','SName','TNumber','Line1','Line2','Line3','Line4','City','Postcode','County','Country'];

foreach ($required as $field){
	if (!isset($_GET[$field])) {
		echo 'Great big dirty error';
		die();
	} else {
		if (empty($_GET[$field])){
			$values[] = '';
			echo 'X';
			} else {
		$values[] = $_GET[$field];
		echo $_GET[$field];
		}
	}
}

$values = array_reverse($values);

for ($i = 0; $i<=4 ; $i++){
	$customerValues[] = array_pop($values);
}

for ($i = 0; $i<=7; $i++){
	
	$addressValues[] = array_pop($values);
}

$customerStatement = $db->prepare('insert into Customer (Username,Password,FName,SName, TNumber) VALUES (:Username,:Password,:FName,:SName,:TNumber)');
$addressStatement = $db->prepare('insert into Address (UID,Line1,Line2,Line3,Line4,City,Postcode,County,Country) Values (10,:Line1,:Line2,:Line3,:Line4,:City,:Postcode,:County,:Country)');

if ($customerStatement->execute($customerValues)){
	echo 'CustomerSuccess';
} else {
	echo 'CustomerFail';
}

if ($addressStatement->execute($addressValues)){
	echo 'AddressSuccess';
} else {
	echo 'AddressFailure';
}
?>