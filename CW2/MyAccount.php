<?php session_start(); 
			
error_reporting(E_ALL);
ini_set('display_errors', '1');

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['Username']) && isset($_POST['Password'])) {
	$password = $_POST['Password'];
	$username = $_POST['Username'];
	
	$statement = $db->prepare('Select * from Customer WHERE Username=:username');
	$statement->bindParam(':username', $username);
	
	$statement->execute();
	$result = $statement->fetch(PDO::FETCH_ASSOC);
	$hash = $result['Password'];
	

	if ($statement->rowCount() == 1 && password_verify($password, $hash)) {
		$_SESSION['loggedIn'] = True;
		$_SESSION['uID'] = $result['UID'];
	} else {
		$_SESSION['loggedIn'] = False;
		header('Location: Login?Login=False');
		die();
	}
} elseif (empty($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == False || empty($_SESSION['uID'])) {
	$_SESSION['loggedIn'] = False;
	header('Location: Login?Login=False');
	die();
} elseif ($_SESSION['loggedIn']) {
	// Do nothing. Just don't die.
} else {
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
	
		<?php include 'include/header.php';?>
		
			<div id="content-wrap">
		
				<main>
					<?php include 'include/mainLogoTwo.xhtml';?>
					
					<?php include 'include/navbar.xhtml'; ?>
					
					<h1>My Account</h1>
					
					<nav>
					<div class="nav-element"><a href="MyFavourites.php">Favourites</a></div>
					<div class="nav-element"><a href="MyAddressbook.php">Addressbook</a></div>
					<div class="nav-element"><a href="TransactionHistory.php">Orders</a></div>
					<div class="nav-element"><a href="Logout.php"><span class="highlight">Logout here</span></a></div>
					</nav>
				</main>
				
			<?php include 'include/footer.php';?>
		
			</div>
		</body>
	</html>
