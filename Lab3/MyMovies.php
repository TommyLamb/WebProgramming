<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (! $_SESSION['loggedIn'] || empty($_SESSION['loggedIn'])) {
	$_SESSION['loggedIn'] = false;
	header('Location: Login.xhtml');
	die();
} else if ($_SESSION['loggedIn']) {
	$dsn = 'mysql:dbname=til1;host=mysql-server-1.macs.hw.ac.uk;charset=utf8';
	$db = new PDO($dsn, 'til1', 'abctil1354');
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	#$statement = $db->prepare('Select movieTitle, movieGenre, movieRating, movieURL from my_movies, users_movies where my_movies.movieID = users_movies.movieID AND :uID = users_movies.uID');
$statement = $db->prepare('Select movieTitle, movieGenre, movieRating from my_movies, users_movies where my_movies.movieID = users_movies.movieID AND :uID = users_movies.uID');
	
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
					
					<?php foreach ($statement as $row){
								echo '<div class="movie-wrap">';
								echo '<span>';
								echo $row['movieTitle'];
								echo '</span>';
								echo '<span>';
								echo ' | ';
								echo $row['movieGenre'];
								echo '</span>';
								echo '<span>';
								echo ' | ';
								echo $row['movieRating'];
								echo '</span>';
								echo '<span>';
								echo ' | ';
								echo 'Action';
								echo '</span>';
								echo '<span>';
								echo ' | ';
								echo 'Poster';
								echo '</span>';
								echo '</div>';
						}
					?>
					
					<button type="button" onclick="location.href='AddMoviesForm.php'">Add a movie</button>
					
				</main>
				
			<?php #include 'include/footer.jsp';?>
		
			</div>
		</body>
	</html>