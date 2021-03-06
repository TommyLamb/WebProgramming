<?php session_start();
if ($_SESSION['loggedIn'] && !empty($_SESSION['uID'])){
	header('Location: MyAccount.php');
	#No die required as no sensitive info here
}
?>
<!DOCTYPE html>
 <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
   <head>
    <?php include 'include/HTMLhead.xhtml';?>
	 <link rel="stylesheet" type="text/css" href="css/createaccount.css"/>
   </head>

   	<body>
		
		<?php include 'include/header.php';?>

		<div id="content-wrap">

			<main>

				<?php include 'include/mainLogoTwo.xhtml'; ?>

				<?php include 'include/navbar.xhtml'; ?>
				
				<div id="login-wrap">

					<form autocomplete="on">
					<div>To create an account, please fill out the details below.</div>
					<div>Forename: </div>
					<input type="text" name="FName" size="30" maxlength="64" autofocus="autofocus" required="required" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+"/>
					<div>Surname: </div>
					<input type="text" name="SName" size="30" maxlength="64" required="required" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+"/>
					<div>Telephone Number: </div>
					<input type="text" name="TNumber" size="30" maxlength="24" required="required" pattern="[0-9\-]*"/>
					<div>Email Address: </div>
					<input type="email" name="Username1" size="30" maxlength="128"  required="required" onblur="checkUsername()" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+"/>
					<div>Confirm Email Address: </div>
					<input type="email" name="Username2" size="30" maxlength="128" required="required" onblur="validateUsername()" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+"/>

					<div>Password: </div>
					<input type="password" name="Password1" size="30" required="required" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+"/> <!-- The dollar and caret are assumed in HTML5 regex -->
					<div>Confirm password: </div>
					<input type="password" name="Password2" size="30" required="required" onblur="validatePassword()" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+" /> <!-- The dollar and caret are assumed in HTML5 regex -->
					<br/>
					<button type="button" onclick="createAccount()">Create Account</button>
					</form>

				</div>

				</main>

				<?php include 'include/footer.php';?>
				<?php include 'include/cookie.php';?>

			</div>

	</body>

	<script>

	$( document ).ready( function () {
		$.validator.messages.pattern = "Do not include ;&quot;&gt;'&lt;";
		$('form').validate();
	});
	
	function createAccount(){
		//First calls the Username checking AJAX, with this function acting as callback for that.
		usernameAJAX( function () {
if (this.readyState == 4 && this.status == 200){ //If username is availible, proceed to further validate
	if (validateUsername() && validatePassword() && $('form').valid()){

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200){
					location.href='MyAccount.php';
				}
			}
		xhttp.open("POST", "AJAX/CreateAccountAJAX.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var formstring = $('form').serialize();
		xhttp.send(formstring);
		
}
			}
		});
		
	}
	
function checkUsername(){
	usernameAJAX( function () {if (this.readyState == 4 && (this.status ==200 || this.status ==400)) {
			$('input[name="Username1"]+span').remove();
			$('input[name="Username1"]+label+span').remove(); //The Validation Plugin may add a label.
			$('input[name="Username1"]').removeClass('error');
		} else if (this.readyState == 4 && this.status == 403){
			if (!$('input[name="Username1"]+span').length){
				$('input[name="Username1"]').after('<span style="color:RGB(182, 0, 0);"> That Email address is already in use.</span>');
			}
			$('input[name="Username1"]').addClass('error');
		}
	});
}
	
	function usernameAJAX(callback) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = callback;
		xhttp.open("POST", "AJAX/CheckUsernameAJAX.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var username = $('input[name="Username1"]').val();
		xhttp.send("Username="+username);
	}

	function validateUsername() {
		var u1 = $('input[name="Username1"]').val();
		var u2 = $('input[name="Username2"]').val();
		if (u1 != u2){
			if (!$('input[name="Username2"]+span').length){
			$('input[name="Username2"]').after('<span style="color:RGB(182, 0, 0);"> Email Adresses do not match.</span>');
			$('input[name="Username2"]').addClass('error');
			return false;
			}
		} else {
			$('input[name="Username2"]+span').remove();
			$('input[name="Username2"]+label+span').remove();
			$('input[name="Username2"]').removeClass('error');
			return true;
			}
	}

	function validatePassword() {
		var u1 = $('input[name="Password1"]').val();
		var u2 = $('input[name="Password2"]').val();
		if (u1 != u2){
			if (!$('input[name="Password2"]+span').length){
			$('input[name="Password2"]').after('<span style="color:RGB(182, 0, 0);"> Passwords do not match.</span>');
			$('input[name="Password2"]').addClass('error');
			return false;
			}
		} else {
			$('input[name="Password2"]+span').remove();
			$('input[name="Password2"]+label+span').remove();
			$('input[name="Password2"]').removeClass('error');
			return true;
			}
	}
	</script>
</html>

