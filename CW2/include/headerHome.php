<header>

	<div class="header-content">

		<div id="search">
			<input type="text" name="search" class="searchbox"
				placeholder="Not Implemented" />
		</div>

		<div id="userbar">
			<span><a href="http://www2.macs.hw.ac.uk:8080/til1/Year2Semester1/WebProgramming/CW1/Basket.jsp">Basket</a> | 
			<?php 
			if ($_SESSION['loggedIn'] && !empty($_SESSION['uID'])){
				echo '<a href="MyAccount.php">My Account</a></span>';
			} else {
				echo '<a href="Login.php">Login/Register</a></span>';
			}
			?>
			
		</div>

		<!-- 		<script> 

// 		function getBasket(){
// 			var productName ="";
// 			var productAmount = "";

// 			if (typeof (localStorage.getItem("product")) != 'undefined' && typeof (localStorage.getItem("amount")) != 'undefined') {
// 				if (localStorage.getItem("product") != null && localStorage.getItem("amount") != null) {
// 					product = (JSON.parse(localStorage.getItem("product")));
// 					amount = (JSON.parse(localStorage.getItem("amount")));
// 				}

// 				for (var i = 0; i < product.length; i++){
// 				 productName = productName +"&ProductName=" + product[i];
// 				 productAmount= productAmount +"&Amount=" + amount[i];
// 					}
// 				}
// 				window.open("Basket.jsp" + "?BasketSize="+ product.length + productName + productAmount);
// 			}
		</script> -->

	</div>
</header>
