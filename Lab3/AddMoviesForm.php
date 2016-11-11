<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (! $_SESSION['loggedIn'] || empty($_SESSION['loggedIn'])) {
	$_SESSION['loggedIn'] = false;
	header('Location: Login.xhtml');
	die();
}
?>

<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
		<head>
			<?php include 'include/HTMLhead.xhtml';?>
			<link rel="stylesheet" type="text/css" href="css/myMovies.css"/>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		</head>

	<body>
	
		<?php include 'include/header.xhtml';?>
		
			<div id="content-wrap">
		
				<main>
					<?php include 'include/mainLogoTwo.xhtml';?>
					
					<?php include 'include/navbar.xhtml'; ?>
					
					<a href="MyMovies.php">Back to My Movies</a>
					
					<form onsubmit="addMovie()" autocomplete="off" >
					
					<input type="text" name="movieTitle" placeholder="Title" required="required" />
					<div id="response">Text</div>
					<button type="submit">Add</button>				
					</form>
					
					</main>
				
			<?php #include 'include/footer.jsp';?>
		
			</div>
		</body>
		<script> 
		function addMovie() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status ==200) {
					window.alert("Movie Added Successfully");
					$("#response").html('Movie added sccessfully!');
					$("#response").css('height','500px');
				} else if (this.readyState == 4 && this.status == 500){
					window.alert("Error- That movie is not in our Database");
					$("#response").html('That movie is not in the database.');
					$("#response").css('height','500px');
				}
			}
			xhttp.open("POST", "AJAX/AddMovie.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			var movieTitle = $('input[name="movieTitle"]').val();
			xhttp.send("MovieTitle="+movieTitle);
		}
		</script>
	</html>