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
	
		<?php include 'include/header.php';?>
		
			<div id="content-wrap">
		
				<main>
					<?php include 'include/mainLogoTwo.xhtml';?>
					
					<?php include 'include/navbar.xhtml'; ?>
					
					<a href="MyAccount.php">Back to My Account</a>
					
					<h1>Favourites</h1>
					
					<div id="product-layout">
					
					<?php
					if ($statement->rowCount()) {
							foreach ($statement as $row){
							echo '<div class="product" data-name="'.$row[0].'" onclick="location.href=\'ProductPage.php?ProductName=' . $row[0] . '\'">';
							echo '<img src="images/products/' . $row[0] . '.png" alt="' . $row[1] . '"/>';
							echo '<div>'.$row[1].'</div>';
							echo '<div> <button type="button" onclick="removeFavourite(\''.$row[0].'\')"> Remove </button> </div>';
							echo '</div>';
							}
					}
					?>
					
					</div>
				</main>
				
			<?php include 'include/footer.php';?>
		
			</div>
		</body>
		
		<script>

		function removeFavourite(name){
			event.stopPropagation();
			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					$('.product[data-name="'+name+'"]').css('display','none');
		} else if (this.readyState==4 && (this.status==500||this.status==400)){
					$('.product[data-name="'+name+'"]').replaceWith("Error");
		}
		};
			xhttp.open("POST", "AJAX/RemoveFavouriteAJAX.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("ProductName="+name);
			
		}
		</script>
	</html>