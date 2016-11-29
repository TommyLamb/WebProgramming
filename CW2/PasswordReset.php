<?php session_start();?>
<!DOCTYPE html>
 <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
   <head>
    <?php include 'include/HTMLhead.xhtml';?>
	 <link rel="stylesheet" type="text/css" href="css/passwordReset.css"/>
   </head>

   	<body>
		
		<?php include 'include/header.php';?>

		<div id="content-wrap">

			<main>

				<?php include 'include/mainLogoTwo.xhtml'; ?>

				<?php include 'include/navbar.xhtml'; ?>
				
				<div id="step1" class="login-wrap">

					<form autocomplete="on">
					<div>Please enter the email address associated with your account below. An email will be sent containg a code you can use to reset your password. This code will expire after 1 hour. <span class="warning">Do not close this page.</span></div>
					<input type="email" name="Username" size="30" maxlength="128"  required="required" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+" title="Do not include: ' ; &quot; &gt; &lt;"/>
					<br/>
					<button type="button" onclick="requestReset()">Send email</button>
					</form>

				</div>
				
				<div id="step2" class="login-wrap">

					<form autocomplete="off">
					<div><span>An email has been sent to EMAIL. Please enter the reset code below.</span> <span class="warning">Do not close this page.</span></div>
					<input type="text" name="Code" size="30" maxlength="256"  required="required"/>
					<br/>
					<button type="button" onclick="verifyCode()">Verify</button>
					</form>

				</div>
				
				<div id="step3" class="login-wrap">

					<form autocomplete="off">
					<div>Please enter your new password below. Once your password has been updated, you will be redirected to your account page.<span class="warning">Do not close this page.</span></div>
					<div>Password: </div>
					<input type="password" name="Password1" size="30" required="required" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+" title="Do not include: ' ; &quot; &gt; &lt;"/> 
					<div>Confirm password: </div>
					<input type="password" name="Password2" size="30" required="required" onblur="validatePassword()" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+" title="Do not include: ' ; &quot; &gt; &lt;"/>
					<br/>
					<button type="button" onclick="updatePassword()">Update password</button>
					</form>

				</div>

				</main>

				<?php include 'include/footer.php';?>

			</div>

	</body>

	<script>

	var email ="";
	
	function requestReset(){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200){
					$('#step1').hide();
					$('#step2').show();
					$("#step2 div span:first-child").text(function () {
					    return $(this).text().replace("EMAIL", email); 
					});
				}
			};
		xhttp.open("POST", "AJAX/Password/ResetEmailAJAX.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		email = $('input[name="Username"]').val();
		xhttp.send('Username='+ email);
	}

	function verifyCode(){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status==200){
				$('#step2').hide();
				$('#step3').show();
			} else if (this.readyState == 4 && this.status == 500) {
				if (!$('input[name="Code"]+span').length){
					$('input[name="Code"]').after('<span> Code is invalid.</span>');
					$('input[name="Code"]+span').addClass('warning');
			}}};
		xhttp.open("POST", "AJAX/Password/VerifyCodeAJAX.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send('Code='+$('input[name="Code"]').val());
		
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
			$('input[name="Password2"]').removeClass('error');
			return true;
			}
	}

	function updatePassword(){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200){
					location.href="MyAccount.php"; 
				}
			};
		xhttp.open("POST", "AJAX/Password/UpdatePasswordAJAX.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send('Password2='+$('input[name="Password2"]').val());
	}
	</script>
</html>

