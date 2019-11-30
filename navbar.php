<?php 
    if (isset($_SESSION['authenticatedUser']) && $_SESSION['loggedIn'] == true){  
		echo('<div class="collapse navbar-collapse" id="myNavbar">');
			echo('<ul class="nav navbar-nav navbar-right">');
				echo('<li><a href="index.php">Home</a></li>');
				echo('<li><a href="listprod.php">Begin Shopping</a></li>');
				echo('<li><a href="listorder.php">List all Orders</a></li>');
				echo('<li><a href="showcart.php">Shopping Cart</a></li>');
				echo('<li><a href="customer.php">Customer Page</a></li>');
				echo('<li><a href="admin.php">Admin</a></li>');
				echo('<li><a href="login.php">Login</a></li>');
				echo("<li><a href = 'logout.php'>Logged in as: " . $_SESSION['authenticatedUser'] .". Click to Log Out</a></li>");
			echo('</ul>');
		echo('</div>');
	}
	else{
		echo('<div class="collapse navbar-collapse" id="myNavbar">');
			echo('<ul class="nav navbar-nav navbar-right">');
				echo('<li><a href="index.php">Home</a></li>');
				echo('<li><a href="listprod.php">Begin Shopping</a></li>');
				echo('<li><a href="listorder.php">List all Orders</a></li>');
				echo('<li><a href="showcart.php">Shopping Cart</a></li>');
				echo('<li><a href="customer.php">Customer Page</a></li>');
				echo('<li><a href="admin.php">Admin</a></li>');
				echo('<li><a href="login.php">Login</a></li>');
				echo('<li><a href="createaccount.php">No Account? Create one!</a></li>');
			echo('</ul>');
		echo('</div>');
	}
	

?>