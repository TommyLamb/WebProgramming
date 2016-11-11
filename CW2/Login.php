<<<<<<< HEAD
<!DOCTYPE html>
 <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
   <head>
    <?php include 'include/HTMLhead.xhtml';?>
	 <link rel="stylesheet" type="text/css" href="css/login.css"/>
   </head>

   	<body>
		
		<?php include 'include/header.xhtml';?>

		<div id="content-wrap">

			<main>

				<?php include 'include/mainLogoTwo.xhtml'; ?>

				<?php include 'include/navbar.xhtml'; ?>
				
				<div id="login-wrap">

					<form action="MyAccount.php" method="post" autocomplete="on">
					<?php if(isset($_GET['Login']) && $_GET['Login']=='False') {
						 echo '<div id="error">Incorrect details supplied</div>';
						 }
						?>
					<div>Username: </div>
					<input type="text" name="Username" size="30" maxlength="128" autofocus="autofocus" required="required" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+" title="Do not include: ' ; &quot; &gt; &lt;"/>

					<div>Password: </div>
					<input type="password" name="Password" size="30" required="required" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+" title="Do not include: ' ; &quot; &gt; &lt;"/> <!-- The dollar and caret are assumed in HTML5 regex -->
					<br/>
					<input type="submit" value="Login"/>
					</form>

				</div>






				</main>

				<?php include 'include/footer.php';?>

			</div>

	</body>
</html>

