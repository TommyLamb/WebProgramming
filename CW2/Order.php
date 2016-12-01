<?php session_start();

if (empty($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || empty($_SESSION['uID']) || empty($_GET['Transaction'])) {
	header('Location: Login?Login=False');
	die();
}

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$productquery = $db->prepare('Select (Transaction.TransactionTimestamp),AddressID,Info,Cost,Amount,ProductList.ProductName,DisplayName, HexCode,RGBCode, Price from ProductList, TransactionProductList, Transaction, DeliveryInfo Where Transaction.TransactionTimestamp=:timestamp AND TransactionProductList.TransactionTimestamp = Transaction.TransactionTimestamp AND Code=DeliveryStatus AND ProductList.ProductName = TransactionProductList.ProductName AND UID=:uid');
$productquery->bindParam(':uid', $_SESSION['uID']);
$productquery->bindParam('timestamp', urldecode($_GET['Transaction']));
$productquery->execute();
$basket = $productquery->fetchAll(PDO::FETCH_ASSOC);

$adressquery = $db->prepare('Select * From Address where UID=:uid AND AddressID=:addressid');
$adressquery->bindParam(':uid', $_SESSION['uID']);
$adressquery->bindParam(':addressid', $basket[0]['AddressID']);
$adressquery->execute();
$address=$adressquery->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
   
		<?php include 'include/HTMLhead.xhtml';?>
   
 <link rel="stylesheet" type="text/css" href="css/order.css"/>
   	 
	</head>
	
	<body>
		<?php include 'include/header.php';?>
		
		<div id="content-wrap">

			<main>

			<?php include "include/mainLogoTwo.xhtml"; ?>

			<?php include "include/navbar.xhtml"; ?>
			
			<span style="whitespace:no-wrap;">Back to: <a href="MyAccount.php">My Account</a> | <a href="TransactionHistory.php">Transactions</a></span>
			
			<h1>Order <?php echo urldecode($_GET['Transaction']);?></h1>
			
			<div id="form-wrap">

				<table id="form-table">
					<tr> <td>Line 1:		</td> 	<td><?php echo $address['Line1']; ?> </td> 		</tr>
					<tr> <td>Line 2:		</td> 	<td><?php echo $address['Line2']; ?> </td>		</tr>
					<tr> <td>Line 3:		</td> 	<td><?php echo $address['Line3']; ?> </td>		</tr>
					<tr> <td>Line 4:		</td> 	<td><?php echo $address['Line4']; ?> </td> 		</tr>
					<tr> <td>City:			</td>	<td><?php echo $address['City']; ?> </td>		</tr>
					<tr> <td>Post Code:		</td>	<td><?php echo $address['Postcode']; ?> </td>		</tr>
					<tr> <td>County:		</td>	<td><?php echo $address['County']; ?> </td>		</tr>
					<tr> <td>Country:		</td> 	<td><?php echo $address['Country']; ?> </td>		</tr>
				</table>

				<p id="info">
					<span>Status: <?php echo $basket[0]['Info'];?></span><br/>
					The total cost for this order was £<?php echo $basket[0]['Cost'];?> <br/>
					If you have any issues with this order, please <a href="mailto:til1@hw.ac.uk?subject=F28WP%20-%20Coursework%202">contact us</a>.
				</p>		

			</div>
			
			<?php 
			foreach ($basket as $item){
				echo 	'<div class="basket-item">';
				echo	'<div class="item-image"> <img src="images/products/'.$item['ProductName'].'.png" alt="'.$item['DisplayName'].'"/> </div>';
				echo	'<div class="item-description">';
				echo 	'<span>'.$item['DisplayName'].'</span> <br/>';
				echo 	'<span>'.$item['RGBCode'].'</span> <br/>';
				echo 	'<span>'.$item['HexCode'].'</span>';
				echo 	'</div>';
				echo 	'<div class="item-form">';
				echo 	'<input type="number" name="quantity" value="'.$item['Amount'].'" readonly="readonly" />';
				echo 	'</div>
						<div class="price"> £'.$item['Price'].'</div>';
				echo 	'</div>';
			}
			
			?>			
			
			</main>
			
			<?php include 'include/footer.php';?>
			<?php include 'include/cookie.php';?>
		</div>
	</body>
	

</html>
