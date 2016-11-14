<?php session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
		<head>
			<?php include 'include/HTMLhead.xhtml';?>
			<link rel="stylesheet" type="text/css" href="css/login.css"/>
		</head>

	<body>
	
		<?php include 'include/header.php';?>
		
			<div id="content-wrap">
		
				<main>
					<?php include 'include/mainLogoTwo.xhtml';?>
					
					<?php include 'include/navbar.xhtml'; ?>
					
					<h1>You have now logged out.</h1>
				</main>
				
			<?php #include 'include/footer.jsp';?>
		
			</div>
		</body>
	</html>
