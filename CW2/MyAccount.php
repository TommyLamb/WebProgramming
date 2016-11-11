<?php session_start(); 
			
error_reporting(E_ALL);
ini_set('display_errors', '1');

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['Username']) && isset($_POST['Password'])){
	$password = $_POST ['Password'];
	$username = $_POST ['Username'];
	
	$statement = $db->prepare('Select * from Customer WHERE username=:username AND password=:password');
	
	$statement->execute(array(':username' => $username, ':password' => $password));

	
	if ($statement->rowCount() == 1) {
		$_SESSION['loggedIn'] = True;
		$_SESSION['uID'] = $statement->fetchColumn(0);
	} else {
		$_SESSION['loggedIn'] = False;
		header('Location: Login.php?Login=False');
		die();
	}
} else {
	$_SESSION['loggedIn'] = False;
	header('Location: Login?Login=False');
	die();
}

				?>

<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
		<head>
			<?php include 'include/HTMLhead.xhtml';?>
			<link rel="stylesheet" type="text/css" href="css/login.css"/>
		</head>

	<body>
	
		<?php include 'include/header.xhtml';?>
		
			<div id="content-wrap">
		
				<main>
					<?php include 'include/mainLogoTwo.xhtml';?>
					
					<?php include 'include/navbar.xhtml'; ?>
					
					<a href="MyFavourites.php">My Favourites</a>
					<a href="Logout.php">Logout here</a>
				</main>
				
			<?php include 'include/footer.php';?>
		
			</div>
		</body>
	</html>
