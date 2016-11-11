<<<<<<< HEAD
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (! $_SESSION['loggedIn'] || empty($_SESSION['loggedIn'])) {
	$_SESSION['loggedIn'] = false;
	header('Location: Login.php');
	die();
} else if ($_SESSION['loggedIn']) {
	$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
	$db = new PDO($dsn, 'til1', 'abctil1354');
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$statement = $db->prepare('Select ProductList.ProductName, DisplayName from ProductList, Favourites WHERE :uID = UID AND Favourites.ProductName = ProductList.ProductName');
	
	$statement->bindParam(':uID', $_SESSION['uID']);
	$querySuccess = $statement->execute();
}
?>

<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
		<head>
			<?php include 'include/HTMLhead.xhtml';?>
			<link rel="stylesheet" type="text/css" href="css/favourites.css"/>
		</head>

	<body>
	
		<?php include 'include/header.xhtml';?>
		
			<div id="content-wrap">
		
				<main>
					<?php include 'include/mainLogoTwo.xhtml';?>
					
					<?php include 'include/navbar.xhtml'; ?>
					
					<a href="MyAccount.php">Back to My Account</a>
					
					<div id="product-layout">
					
					<?php
					if ($statement->rowCount()) {
							foreach ($statement as $row){
							echo '<div class="product" onclick="location.href=\'http://www2.macs.hw.ac.uk:8080/til1/Year2Semester1/WebProgramming/CW1/ProductPage.jsp?ProductName=' . $row[0] . '\'">';
							echo '<img src="images/products/' . $row[0] . '.png" alt="' . $row[1] . '"/>';
							echo '<div>'.$row[1].'</div>';
							echo '</div>';
							}
					}
					?>
					
					</div>
					
					<button type="button" onclick="location.href='AddMoviesForm.php'">Add a movie</button>
					
				</main>
				
			<?php #include 'include/footer.jsp';?>
		
			</div>
		</body>
=======
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (! $_SESSION['loggedIn'] || empty($_SESSION['loggedIn'])) {
	$_SESSION['loggedIn'] = false;
	header('Location: Login.php');
	die();
} else if ($_SESSION['loggedIn']) {
	$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
	$db = new PDO($dsn, 'til1', 'abctil1354');
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$statement = $db->prepare('Select ProductList.ProductName, DisplayName from ProductList, Favourites WHERE :uID = UID AND Favourites.ProductName = ProductList.ProductName');
	
	$statement->bindParam(':uID', $_SESSION['uID']);
	$querySuccess = $statement->execute();
}
?>

<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
		<head>
			<?php include 'include/HTMLhead.xhtml';?>
			<link rel="stylesheet" type="text/css" href="css/favourites.css"/>
		</head>

	<body>
	
		<?php include 'include/header.xhtml';?>
		
			<div id="content-wrap">
		
				<main>
					<?php include 'include/mainLogoTwo.xhtml';?>
					
					<?php include 'include/navbar.xhtml'; ?>
					
					<a href="MyAccount.php">Back to My Account</a>
					
					<div id="product-layout">
					
					<?php
					if ($statement->rowCount()) {
							foreach ($statement as $row){
							echo '<div class="product" onclick="location.href=\'http://www2.macs.hw.ac.uk:8080/til1/Year2Semester1/WebProgramming/CW1/ProductPage.jsp?ProductName=' . $row[0] . '\'">';
							echo '<img src="images/products/' . $row[0] . '.png" alt="' . $row[1] . '"/>';
							echo '<div>'.$row[1].'</div>';
							echo '</div>';
							}
					}
					?>
					
					</div>
					
					<button type="button" onclick="location.href='AddMoviesForm.php'">Add a movie</button>
					
				</main>
				
			<?php #include 'include/footer.jsp';?>
		
			</div>
		</body>
>>>>>>> origin/master
	</html>