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
<h1>Create a Product!</h1>
<form name="MyForm" method="post" action="insertproduct.php">
<table style="display:inline">
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Product Name:</font></div></td>
	<td><input type="text" name="productname" size=100></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Product Price:</font></div></td>
	<td><input type="text" name="productprice" size=100></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Product Image:</font></div></td>
	<td><input type="text" name="productimgurl" size=100></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Product Description:</font></div></td>
	<td><input type="text" name="productdesc" size=100></td>
</tr>
<tr>
	<td><div align="right"><font face="Arial, Helvetica, sans-serif" size="2">Category ID:</font></div></td>
	<td><input type="text" name="productcat" size=100></td>
</tr>
</table>
<br/>
<br/>
<input class="submit" type="submit" name="Submit2" value="Create Prodct">
</form>
<br/>
<a href = "index.php">return to home</a>
</div>
</body>
</html>