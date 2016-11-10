		function addMovie() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status ==200) {
					
				} 
			}
			xhttp.open("POST", "AddMovie.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			var movieTitle = $('input[name="movieTitle"]').val();
			xhttp.send("MovieTitle="+movieTitle);
		}