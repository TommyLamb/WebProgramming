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
}?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<?php include 'include/HTMLhead.xhtml';?>
			<link rel="stylesheet" type="text/css" href="css/checkout.css"/>
		</head>

	<body>
	
		<?php include 'include/header.php';?>
		
			<div id="content-wrap">
		
				<main>
					<?php include 'include/mainLogoTwo.xhtml';?>
					
					<?php include 'include/navbar.xhtml'; ?>
					
					<a href="MyAccount.php">Back to My Account</a>
					
					<?php $statement=$db->prepare('Select * from Address WHERE UID = :uid');
					 $statement->bindParam(":uid", $_SESSION['uID']);
					if ($statement->execute()){
						if ($statement->rowCount()){
							echo '<select onchange="changeAddress()">';
								foreach ($statement as $row){
									echo '<option label="'.$row['Line1'].'" value="'.$row['AddressID'].'"/>';
								}
							echo '</select>';
							echo '<button type="button" onclick="addAddressForm()">Add address</button>';
						} else {
							echo 'No Address Found!';
							echo '<button type="button" onclick="addAddressForm()">Add address</button>';
						}
					} else {
						http_response_code(500);
						die();
					}
					?>
					
								<div id="form-wrap">

				<form action="Confirmation.jsp" method="post" autocomplete="on">

				<table id="form-table">

				<tr> <td>Line 1:		</td> 	<td class="required"> 		<input type="text" name="AddressLine1" placeholder="Captain's Cabin" required="required" />			</td> 		</tr>
				<tr> <td>Line 2:		</td> 	<td> 						<input type="text" name="AddressLine2" placeholder="Deck 1" /> 										</td>		</tr>
				<tr> <td>Line 3:		</td> 	<td> 						<input type="text" name="AddressLine3" placeholder="SSV Normandy SR-2" />								</td>		</tr>
				<tr> <td>Line 4:		</td> 	<td>						<input type="text" name="AddressLine4" placeholder="Bay D24" /> 										</td> 		</tr>
				<tr> <td>City:			</td>	<td class="required"> 		<input type="text" name="AddressCity" placeholder="Citadel" required="required" />						</td>		</tr>
				<tr> <td>Post Code:		</td>	<td class="required">		<input type="text" name="AddressPostCode" placeholder="EH14 4AS" required="required" />				</td>		</tr>
				<tr> <td>County:		</td>	<td class="required">		<input type="text" name="AddressCounty" placeholder="Inner Citadel Space" required="required" />		</td>		</tr>
				<tr> <td>Country:		</td> 	<td class="required">		<select name="AddressCountry">
																				<option value="United Kingdom">United Kingdom</option>
																				<option value="United States">United States</option>
																				<option value="Germany">Germany</option>









				</select>	</td>		</tr>
				</table>

					<button type="button" onclick="sendFormData()" name="Next"> Next </button>

				</form>


				</div>
					
				</main>
				
			<?php include 'include/footer.php';?>
		
			</div>
		</body>
		
		<script>

		function sendFormData(name){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					window.alert(this.responseText);
		} else if (this.readyState==4 && (this.status==500||this.status==400)){
					window.alert("500");
		}
		};
			xhttp.open("POST", "AJAX/AddAddressAJAX.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send($("form").serialize());
			
		}
		</script>
	</html>