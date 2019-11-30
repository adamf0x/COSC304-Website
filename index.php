<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>  
    <title>Adam and Corey's Shoes Main Page</title>
</head>

<body>

<?php 
    session_start();
    // TODO: Display user name that is logged in (or nothing if not logged in)	
    include "navbar.php";
?>
<?php
error_reporting(0);
 if (isset($_SESSION['loginMessage'])){
    echo ("<p style = 'color:black'>" . $_SESSION['loginMessage'] . "</p>");
}
$_SESSION['loginMessage'] = null;
if(isset($_SESSION['errorMsg'])){
    echo ("<h3 style = 'color:black'>" . $_SESSION['errorMsg'] . "</h3>");
}
$_SESSION['errorMsg'] = null;

?>

<h1 align="center" style = "color: black">Welcome to Adam and Corey's Shoes</h1>

<h2 align="center"><a href="login.php">Login</a></h2>

<h2 align="center"><a href="listprod.php">Begin Shopping</a></h2>

<h2 align="center"><a href="listorder.php">List All Orders</a></h2>

<h2 align="center"><a href="customer.php">Customer Info</a></h2>

<h2 align="center"><a href="admin.php">Administrators</a></h2>

<h2 align="center"><a href="logout.php">Log out</a></h2>
</body>
</head>


