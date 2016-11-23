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
	$statement = $db->prepare('Select movieTitle, movieGenre, movieRating, movieURL from my_movies, users_movies where my_movies.movieID = users_movies.movieID AND :uID = users_movies.uID');	
	$statement->bindParam(':uID', $_SESSION['uID']);
	$querySuccess = $statement->execute();
}
?>

<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
		<head>
			<?php include 'include/HTMLhead.xhtml';?>
			<link rel="stylesheet" type="text/css" href="css/myMovies.css"/>
		</head>

	<body>
	
		<?php include 'include/header.xhtml';?>
		
			<div id="content-wrap">
		
				<main>
					<?php include 'include/mainLogoTwo.xhtml';?>
					
					<?php include 'include/navbar.xhtml'; ?>
					
					<a href="MyAccount.php">Back to My Account</a>
					
					<?php 
					if ($querySuccess) {
						echo '<table><tr><th>Title</th><th>Genre</th><th>Rating</th><th>Poster</th><th>Action</th></tr>';

						foreach ( $statement as $row ) {
							
							echo '<tr>';
							echo '<td>';
							echo $row['movieTitle'];
							echo '</td>';
							echo '<td>';
							echo $row['movieGenre'];
							echo '</td>';
							echo '<td>';
							echo $row['movieRating'];
							echo '</td>';
							echo '<td>';
							echo '<button type="button" name="poster" onclick="showPoster(\''.$row['movieTitle'].'\')" data-title="'.$row['movieTitle'].'">View</button>';
							echo '<td>';
							echo '<button type="button" name="remove" onclick="deleteMovie(\''.$row['movieTitle'].'\')" data-title="'.$row['movieTitle'].'">Remove</button>';

							echo '</td>';
							echo '</tr>';
						}
						echo '</table>';
					}
					?>
					
					<button type="button" onclick="location.href='AddMoviesForm.php'">Add a movie</button>
					
				</main>
				
			<?php #include 'include/footer.jsp';?>
		
			</div>
		</body>
		<script>
		function deleteMovie(movieTitle) {
			if (window.confirm("This will remove the movie form your list.\nProceed?")){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status ==200) {
					$("button[name='remove'][data-title='"+movieTitle+"']").replaceWith("Removed.");
				} else if (this.readyState == 4 && this.status == 500){
					$("button[name='remove'][data-title='"+movieTitle+"']").replaceWith("Sorry.");
				}
			}
			xhttp.open("POST", "AJAX/DeleteMovie.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("MovieTitle="+movieTitle);
			}
		}

		function showPoster(movieTitle) {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status ==200) {
					$("button[name='poster'][data-title='"+movieTitle+"']").replaceWith(this.responseText);
				} else if (this.readyState == 4 && this.status == 500){
					$("button[name='poster'][data-title='"+movieTitle+"']").replaceWith("Poster not found.");
				}
			}
			xhttp.open("POST", "AJAX/GetPoster.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("MovieTitle="+movieTitle);
			
		}
		</script>
	</html>