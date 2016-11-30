<?php session_start();

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $db->prepare('Select * from ProductList Where ProductName=:productname');
$statement->bindParam(':productname', $_GET['ProductName']);

$favourite = $db->prepare('Select * from Favourites Where ProductName=:productname AND UID=:uid');
$favourite->bindParam(':productname', $_GET['ProductName']);
$favourite->bindParam(':uid', $_SESSION['uID']);

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
   
		<?php include 'include/HTMLhead.xhtml';?>
   
		<link rel="stylesheet" type="text/css" href="css/productpage.css"/>
   	 
	</head>
	
	<body>
		<?php include 'include/header.php';?>
		
		<div id="content-wrap">

			<main>

			<?php include "include/mainLogoTwo.xhtml"; ?>

			<?php include "include/navbar.xhtml"; ?>
			
			<?php 
			if (!empty($_GET['ProductName'])){
			if ($statement->execute() && $favourite->execute()){
				$result = $statement->fetch(PDO::FETCH_ASSOC);
				echo '<div id="product">
						<img src="images/products/'.$result['ProductName'].'.png" alt="'.$result['DisplayName'].'" />';
						if ($_SESSION['loggedIn'] && !$favourite->rowCount()){
							echo'<span id="favourite"><button type="button" onclick="addFavourite()">Add To Favourites</button></span>';
						} else if ($_SESSION['loggedIn'] && $favourite->rowCount()){
							echo '<span id="favourite">Favourited Product</span>';
						}
						echo '<div id="product-details">
						'.$result['DisplayName'].'<br/>'
						.$result['HexCode'].'<br/>'
						.$result['RGBCode'].'<br/>'
						.'£'.$result['Price']
						.'</div>';
				echo '<p>'.$result['Description'].'</p>';
				
				echo '<p>Postage and Packaging is included in the price of all
				products. UK national shipping takes 3-5 working days, international
				delivery may take up to 3 weeks. Products are dispatched from our
				climate-controlled warehouse in Riccarton, Edinburgh using Royal
				Mail Signed For Delivery for peace of mind.</p>


			<div id="controls">

			<img class="button-image" src="images/addToCart.png" alt="Add to Cart" onclick="addtoBasket()";/>
				<input id="productAmount" type="number" name="quantity" value="1" min="1" max="50" />
			</div>


		</div>';
			} else {
				echo 'Error - Product not found';
			}
			} else {
				echo 'Error - Product not found';
			}
			?>
			
			</main>
			
			<?php include 'include/footer.php';?>
			<?php include 'include/cookie.php';?>
		</div>
	</body>
	<?php if ($_SESSION['loggedIn']&& !$favourite->rowCount()){
	echo '
		<script>
		function addFavourite() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200){
				$("#favourite>button").replaceWith("Added");
	} else if (this.readyState==4 && (this.status==500||this.status==400)){
				$("#favourite>button").replaceWith("Error");
	}
	};
		xhttp.open("POST", "AJAX/AddFavouriteAJAX.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("ProductName='.$result['ProductName'].'");
				}
		</script>
		';
	}?>
</html>

		
