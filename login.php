<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Login Screen</title>
</head>
<body>
<div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav navbar-right">
			<li><a href="index.php">Home</a></li>
			<li><a href="listprod.php">Begin Shopping</a></li>
			<li><a href="listorder.php">List all Orders</a></li>
			<li><a href="showcart.php">Shopping Cart</a></li>
			<li><a href="customer.php">Customer Page</a></li>
			<li><a href="admin.php">Admin</a></li>
            <li><a href="login.php">Login</a></li>
		</ul>
</div>

<div style="margin:0 auto;text-align:center;display:inline">

<h3>Please Login to System</h3>

<?php 
	session_start();  
    if ($_SESSION['loginMessage']  != null){
		echo ("<p>" . $_SESSION['loginMessage'] . "</p>");
	}
	$_SESSION['loginMessage'] = null;
?>

<br>
<form name="MyForm" method="post" action="validateLogin.php">
<table style="display:inline">
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Username:</font></div></td>
	<td><input type="text" name="username"  size=10 maxlength=20></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Password:</font></div></td>
	<td><input type="password" name="password" size=10 maxlength="20"></td>
</tr>
</table>
<br/>
<input class="submit" type="submit" name="Submit2" value="Log In">
</form>

</div>

</body>
</html>

