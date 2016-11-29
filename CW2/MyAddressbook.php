<?php
session_start();
if (! $_SESSION['loggedIn'] || empty($_SESSION['loggedIn'])) {
	$_SESSION['loggedIn'] = false;
	header('Location: Login.php');
	die();
}
?>
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

					<h1>Addressbook</h1>

					<button type="button" name="AddAddress" onclick="newAddress()">Add address</button>

					
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
				<tr> <td> </td> <td><button type="button" onclick="deleteAddress()" name="Delete">Remove</button> <button type="button" onclick="sendFormData()" name="Next"> Next </button></td></tr>
				</table>

					

				</form>


				</div>
					
				</main>
				
			<?php include 'include/footer.php';?>
		
			</div>
		</body>
		
		<script>

		var update = true;
		
		$( document ).ready( function () {
			getAddressList();
		});

function getAddressList() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
			$('select[name="SelectAddress"]+br').remove();
			$('select[name="SelectAddress"]').remove();
			$('button[name="AddAddress"]').before(this.responseText+"<br/>");
			updateForm();
} else if (this.readyState==4 && (this.status==500||this.status==400)){
	window.alert("An error occurred processing your request");
}
};
	xhttp.open("POST", "AJAX/Address/GetAddressSelectorAJAX.php", true);
	xhttp.send();
}
		
		function updateForm(){
			update = true;
			$('button[name="Next"]').html('Update address');
			$('button[name="Delete"]').removeAttr('disabled');
			var selection = $('select option:selected').val();
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					var address = JSON.parse(this.responseText);
					$('input[name="AddressLine1"]').val(address['Line1']);
					$('input[name="AddressLine2"]').val(address['Line2']);
					$('input[name="AddressLine3"]').val(address['Line3']);
					$('input[name="AddressLine4"]').val(address['Line4']);
					$('input[name="AddressCity"]').val(address['City']);
					$('input[name="AddressPostCode"]').val(address['Postcode']);
					$('input[name="AddressCounty"]').val(address['County']);
					$('input[name="AddressCountry"]').val(address['Country']);
					$('input').removeAttr('placeholder');
		} else if (this.readyState==4 && (this.status==500||this.status==400)){
			window.alert("An error occurred processing your request");
		}
		};
			xhttp.open("POST", "AJAX/Address/GetAddressAJAX.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("AddressID="+selection);
			
		}
			
		function newAddress() {
			update=false;
			$('button[name="Next"]').html('Add address');
			$('button[name="Delete"]').attr('disabled','disabled');
			$('input[name="AddressLine1"]').attr('placeholder',"Captain's Cabin");
			$('input[name="AddressLine2"]').attr('placeholder',"Deck 1");
			$('input[name="AddressLine3"]').attr('placeholder',"SSV Normandy SR-2");
			$('input[name="AddressLine4"]').attr('placeholder',"Bay D24");
			$('input[name="AddressCity"]').attr('placeholder',"Citadel");
			$('input[name="AddressPostCode"]').attr('placeholder',"EH14 4AS");
			$('input[name="AddressCounty"]').attr('placeholder',"Inner Citadel Space");
			$('input').val("");
		}
		
		function sendFormData(){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					getAddressList();
		} else if (this.readyState==4 && (this.status==500||this.status==400)){
					window.alert("An error occurred processing your request");
		}
		};
			xhttp.open("POST", "AJAX/Address/AddAddressAJAX.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("Update="+update+"&AddressID="+$('select option:selected').val()+"&"+$("form").serialize());
			
		}

		function deleteAddress(){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
				getAddressList();
		} else if (this.readyState==4 && (this.status==500||this.status==400)){
			window.alert("An error occurred processing your request");
		}
		};
			xhttp.open("POST", "AJAX/Address/DeleteAddressAJAX.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			if (window.confirm('This will remove this address from your account. This cannot be undone. Proceed?')){
			xhttp.send("AddressID="+$('select option:selected').val());
			}
			
		}
		</script>
	</html>