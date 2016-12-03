<header>

	<div class="header-content">

		<div id="search">
			<input type="text" name="search" class="searchbox"
				placeholder="Not Implemented" />
		</div>


		<div class="logo">
			<img src="images/logoTwo.png" alt="Duffy &amp; Lamb Paints Logo" />
		</div>


		<div id="userbar">
			<span><a href="404">Basket</a> | 
			<?php 
			if ($_SESSION['loggedIn'] && !empty($_SESSION['uID'])){
				echo '<a href="MyAccount.php">My Account</a></span>';
			} else {
				echo '<a href="Login.php">Login/Register</a></span>';
			}
			?>
			
		</div>

	</div>
	
</header>
