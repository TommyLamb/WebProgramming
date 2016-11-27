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
					<div>Please enter the email address associated with your account below. An email will be sent containg a code you can use to reset your password. <span class="warning">Do not close this page.</span></div>
					<input type="email" name="Username" size="30" maxlength="128"  required="required" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+" title="Do not include: ' ; &quot; &gt; &lt;"/>
					<br/>
					<button type="button" onclick="requestReset()">Send email</button>
					</form>

				</div>
				
				<div id="step2" class="login-wrap">

					<form autocomplete="off">
					<div>An email has been sent to EMAIL. Please enter the reset code below.</div>
					<input type="text" name="Code" size="30" maxlength="256"  required="required"/>
					<br/>
					<button type="button" onclick="verifyCode()">Verify</button>
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
			if (this.readyState == 4){
					$('#step1').hide();
					$('#step2').show();
					$("#step2 div").text(function () {
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
			if (this.readyState == 4){
					window.alert(this.responseText);
				}
			};
		xhttp.open("POST", "AJAX/Password/VerifyCodeAJAX.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send('Code='+$('input[name="Code"]').val());
		
	}
	</script>
</html>

