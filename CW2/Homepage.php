<?php session_start(); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>

<?php include 'include/HTMLhead.xhtml';?>

<link rel="stylesheet" type="text/css" href="css/hompage.css" />


</head>

 <?php 
 $dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
 $db = new PDO($dsn, 'til1', 'abctil1354');
 $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $statement = $db->prepare('Select * from ProductList');
 
$statement->execute();
?>

<body>

	<?php include 'include/headerHome.php';?>

	<div id="content-wrap">
		<main>

		<div class="logo">
			<img src="images/logoOne.png" alt="Duffy &amp; Lamb Paints Logo"
				width="100%" />
		</div>

		<?php include 'include/navbar.xhtml';?>


		<div id="product-layout">

		<?php 
		if ($statement->rowCount()) {
			foreach ($statement as $row){
				echo '<div class="product" data-name="'.$row[0].'" onclick="location.href=\'ProductPage.php?ProductName=' . $row[0] . '\'">';
				echo '<img src="images/products/' . $row[0] . '.png" alt="' . $row[1] . '"/>';
				echo '<div>'.$row[1].'</div>';
				echo '</div>';
			}
		}
		?>

		</div>

		</main>

		<?php include 'include/footer.php';?>

	</div>

</body>
</html>