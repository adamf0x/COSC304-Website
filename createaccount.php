<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Adam and Corey's Shoes</title>
</head>
<body>
<?php
session_start();
include "navbar.php";
if(isset($_SESSION['errorMsg'])){
	echo("<h3>" . $_SESSION['errorMsg'] . "</h3>");
}
$_SESSION['errorMsg'] = null;
?>
<div align = "center">
<h1>Create an Account!</h1>
<form name="MyForm" method="post" action="validateaccount.php">
<table style="display:inline">
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">First Name:</font></div></td>
	<td><input type="text" name="firstname" size=20></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Last Name:</font></div></td>
	<td><input type="text" name="lastname" size=20></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Email:</font></div></td>
	<td><input type="email" name="email" size=20></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Phone Number:</font></div></td>
	<td><input type="text" name="phonenum" size=20></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Address:</font></div></td>
	<td><input type="text" name="address" size=20></td>
</tr>
<tr>
	<td><input type="text" name="city" size=20 placeholder = "city"></td>
	<td><input type="text" name="state" size=20 placeholder = "state"></td>
	<td><input type="text" name="country" size=20 placeholder = "country"></td>
	<td><input type="text" name="postalcode" size=20 placeholder = "postal code"></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Username:</font></div></td>
	<td><input type="text" name="username"  size=20 maxlength=20></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Password:</font></div></td>
	<td><input type="password" name="password" size=20 maxlength="30"></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Confirm Password:</font></div></td>
	<td><input type="password" name="confirmpass" size=20 maxlength="30"></td>
</tr>
</table>
<br/>
<br/>
<input class="submit" type="submit" name="Submit2" value="Create Account">
</form>
<br/>
<a href = "index.php">return to home</a>
</div>
</body>
</html>