<?php session_start();

if (empty($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || empty($_SESSION['uID'])) {
	header('Location: Login?Login=False');
	die();
}

$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
$db = new PDO($dsn, 'til1', 'abctil1354');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$statement = $db->prepare('Select * from Transaction Where UID=:uid');
$statement->bindParam(':uid', $_SESSION['uID']);
$statement->execute();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
   
		<?php include 'include/HTMLhead.xhtml';?>
   
 <link rel="stylesheet" type="text/css" href="css/transactions.css"/>
   	 
	</head>
	
	<body>
		<?php include 'include/header.php';?>
		
		<div id="content-wrap">

			<main>

			<?php include "include/mainLogoTwo.xhtml"; ?>

			<?php include "include/navbar.xhtml"; ?>
			
			<a href="MyAccount.php">Back to My Account</a>
			
			<h1>Transactions</h1>
			
			<p>Here you can view all of your previous and current orders, including their current delivery status. Select any of them for more details.</p>
			
			<?php 
			 if ($statement->rowCount()) {
			 	
			 	foreach ($statement as $row){
			 		echo '<div class="order" onclick="location.href=\'Order?Transaction='.$row['TransactionTimestamp'].'\'">
							<div class="order-details">'.$row['TransactionTimestamp'].' | Products: '.$row['NoProducts'].' | Cost: £'.$row['Cost'].'</div>
							 <div class="delivery-details">'.$row['DeliveryStatus'].'</div>
						</div>';
			 	}
			 	
			 } else {
			 	echo '<p>You have no orders</p>';
			 }
			?>
			
			</main>
			
			<?php include 'include/footer.php';?>
			<?php include 'include/cookie.php';?>
		</div>
	</body>
	

</html>

		
