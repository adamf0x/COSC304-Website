<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Add a review</title>
</head>
<body>

<?php 
session_start();
$username = "afox";
$password = "24304628";
$database = "db_afox";
$server = "sql04.ok.ubc.ca";
$connectionInfo = array( "Database"=>$database, "UID"=>$username, "PWD"=>$password, "CharacterSet" => "UTF-8");

$con = sqlsrv_connect($server, $connectionInfo);    
if(!isset($_SESSION['authenticatedUser'])){
	$_SESSION['errorMsg'] = "Please log in to leave a review!";
	header('Location:listprod.php');
}
include 'include/db_credentials.php';
include "navbar.php";
echo("<div align = 'center'>");
	echo("<h2>Write a review</h2>");
	$prodId = $_GET['id'];
	$sql = "SELECT productName FROM product WHERE productId = ?";
	$result = sqlsrv_query($con, $sql, array($prodId));
	while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		echo("<h3> you are reviewing: ". $row['productName']);
	}
echo("</div>");
?>

<br>
<div align = 'center'>
<form name="MyForm" method="get" action="reviewInsert.php">
<table style="display:inline">
<tr>
	<tr><td><p>Please select a rating for the product and enter a review</p></td></tr>
	<tr><td><input type="range" name="reviewrating" min="1" max="5"></td></tr>
	<tr><td><textarea rows = 4 cols = 50 name="review" onfocus="this.value=''" maxlength=1000>Enter your review here:</textarea></td></tr>
	<input type='hidden' name='prodId' value='<?php echo "$prodId";?>'/> 
	<td><input class="submit" type="submit" name="Submit2" value="Submit">
</table>
</form>
<a href = "listprod.php">return to product page</a>
</div>

</body>
</html>


