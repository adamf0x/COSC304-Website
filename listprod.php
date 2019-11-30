<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  width: 60%;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Adam and Corey's Shoes Products</title>
</head>
<body>
<?php
session_start();
include "navbar.php";
?>


<div align = 'center'>
	<h1>Search for the products you want to buy:</h1>

	<form method="get" action="listprod.php">
	<input type="text" name="productName" size="50">
	<input type="submit" value="Submit"><input type="reset" value="Reset"> (Leave blank for all products)
	</form>
</div>

<?php
echo("<div align = 'center'>");
	include 'include/db_credentials.php';
	$name = null;
	/** Get product name to search for **/
	if (isset($_GET['productName'])){
		$name = $_GET['productName'];
		echo("<h2> Products containing: " . $name . "</h2>");
	}
	else if(!isset($_GET['productName']) || $_GET['productName'] == null){
		echo("<h2> All Products: </h2>");
	}

	/** $name now contains the search string the user entered
	 Use it to build a query and print out the results. **/

	/** Create and validate connection **/


	$con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}

	if(isset($_SESSION['errorMsg'])){
		echo("<h3>" . $_SESSION['errorMsg'] ."</h3>");
	}
	$_SESSION['errorMsg'] = null;
	$hasName = isset($name) && strlen($name) != 0; 
	$sql = "SELECT P.productId, P.productName, P.productPrice, COUNT(O.productId) AS countProdOrders FROM product P LEFT OUTER JOIN orderproduct O ON P.productId = O.productId WHERE productName LIKE ? GROUP BY P.productId, P.productName, P.productPrice ORDER BY countProdOrders DESC";
	$name = '%' . $name . '%';
	$results = sqlsrv_query($con, $sql, array($name));
	
	echo("<table><tr><th> </th><th>Review</th><th>Product Name</th><th>Price</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
		$pid = $row['productId'];
		$pname = $row['productName'];
		$pprice = $row['productPrice'];
		$url = "addcart.php?id=" . $pid . "&name=" . urlencode($pname) . "&price=" . $pprice;
		$produrl = "product.php?id=" . $pid;
		$revUrl = "review.php?id=" . $pid;
		echo("<tr><td><a href = $url>Add to Cart</a></td><td><a href = $revUrl>Review</a></td><td><a href = $produrl>". $row['productName'] . "</a></td><td>" . '$' . number_format($row['productPrice'],2) . "</td></tr>");
	}
	echo("</table>");
	/** Print out the ResultSet **/

	/** 
	For each product create a link of the form
	addcart.php?id=<productId>&name=<productName>&price=<productPrice>
	Note: As some product names contain special characters, you may need to encode URL parameter for product name like this: urlencode($productName)
	**/

	echo("</div>");
	/** Close connection **/
	sqlsrv_close($con)
	/**
        Useful code for formatting currency:
	       number_format(yourCurrencyVariableHere,2)
     **/
?>

</body>
</html>