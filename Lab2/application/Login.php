<?php error_reporting(E_ALL);
ini_set('display_errors', '1');
#echo 'something';
?>

<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
		<head>
			<?php include 'include/HTMLhead.xhtml'; ?>
			<link rel="stylesheet" type="text/css" href="css/login.css"/>
		</head>

   	<body>
			<?php include 'include/header.xhtml'; ?>

		<div id="content-wrap">

			<main>

				<?php include 'include/mainLogoTwo.xhtml';?>

				<?php include 'include/navbar.xhtml'; ?>

				
				

				<div id="login-wrap">

					<?php if(isset($_GET['Login']) && $_GET['Login']=='False') {
						 echo "<h3 class=\"error\">Incorrect details supplied</h3>";
						 }
						?>
					<form action="MyAccount.php" method="post" autocomplete="on">

					<div>Username: </div>
					<input type="text" name="Username" placeholder="e.g. JohnShepard" size="30" maxlength="64" autofocus="autofocus" required="required" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+" title="Do not include: ' ; &quot; &gt; &lt;"/> <!-- Database has limit of 64 chars -->

					<div>Password: </div>
					<input type="password" name="Password" size="30" maxlength="64" required="required" pattern="[^;&quot;'&gt;&lt;\r\t\f\v]+" title="Do not include: ' ; &quot; &gt; &lt;"/> <!-- The dollar and caret are assumed in HTML5 regex -->
					<br/>
					<input type="submit" value="Login"/>
					</form>

				</div>






				</main>

				<footer>


				<span class="left">Legal Junk</span>
				<span class="middle">Legal Junk</span>
				<span class="right">Legal Junk</span>

			</footer>

			</div>

	</body>
</html>
