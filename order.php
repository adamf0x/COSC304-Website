<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Adam and Corey's Shoes Order Processing</title>
</head>
<body>


<?php
include 'include/db_credentials.php';
include "navbar.php";
/** Get customer id **/
$enteredUser = null;
if(isset($_GET['customerId'])){
	$enteredUser = $_GET['customerId'];
}
session_start();
$productList = null;
if (isset($_SESSION['productList'])){
	$productList = $_SESSION['productList'];
}

/**
Determine if valid customer id was entered
Determine if there are products in the shopping cart
If either are not true, display an error message
**/

/** Make connection and validate **/

	$con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$valid = true;
	$userid = null;
	if(isset($_SESSION['authenticatedUser'])){
		$userid = $_SESSION['authenticatedUser'];
	}

	if($productList === null){
		echo("<h2>Empty cart</h2>");
		echo("<li><a href='index.php'>Return To Home</a></li>");
		$valid = false;
	}
	
	

	if($valid === true){
	$address = null;
	$city = null;
	$state = null;
	$postalCode = null;
	$country = null;
/** Save order information to database**/
	
	$sql = "SELECT address, city, state, postalCode, country FROM customer WHERE customerId = ?";
	$result = sqlsrv_query($con, $sql, array($enteredUser));
	while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$address = $row['address'];
		$city = $row['city'];
		$state = $row['state'];
		$postalCode = $row['postalCode'];
		$country = $row['country'];
	}
	$orderDate = date("Y/m/d");
	
	$totalAmount = 0;
	for($i = 0; $i < count($productList); $i++){
		$totalAmount = array_values(array_values($productList)[$i])[2] + $totalAmount;
	}
	
	
	$sql2 = "INSERT INTO orderSummary(orderDate, totalAmount, shiptoAddress, shiptoCity, shiptoState, shiptoPostalCode, shiptoCountry, customerId) OUTPUT INSERTED.orderId VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
	$pstmt = sqlsrv_query($con, $sql2, array($orderDate, $totalAmount, $address, $city, $state, $postalCode, $country, $enteredUser));
	if(sqlsrv_fetch($pstmt) === false){
		echo(sqlrsv_errors());
	}
	$orderId = sqlsrv_get_field($pstmt,0);
	
	/**
	// Use retrieval of auto-generated keys.
	$sql = "INSERT INTO <TABLE> OUTPUT INSERTED.orderId VALUES( ... )";
	$pstmt = sqlsrv_query( ... );
	if(!sqlsrv_fetch($pstmt)){
		//Use sqlsrv_errors();
	}
	$orderId = sqlsrv_get_field($pstmt,0);
	**/


/** Insert each item into OrderedProduct table using OrderId from previous INSERT **/

	$sql3 = "INSERT INTO orderproduct(orderId, productId, quantity, price) VALUES (?,?,?,?)";
	for($i = 0; $i < count($productList); $i++){
		$pstmt2 = sqlsrv_query($con, $sql3, array($orderId,array_values(array_values($productList)[$i])[0], array_values(array_values($productList)[$i])[3], array_values(array_values($productList)[$i])[2]));
	}
	
	

/** Update total amount for order record **/
	$sql4 = "UPDATE orderSummary SET totalAmount = ? WHERE orderId = ?";
	$updatestmt = sqlsrv_query($con, $sql4, array($totalAmount,$orderId));
/** For each entry in the productList is an array with key values: id, name, quantity, price **/

/**
	foreach ($productList as $id => $prod) {
		\\$prod['id'], $prod['name'], $prod['quantity'], $prod['price']
		...
	}
**/

/** Print out order summary **/
	$orderprice = null;
	$subtotal = null;
	echo("<table><tr><th>Product ID</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr>");
	foreach ($productList as $id => $prod) {
		$subtotal = $prod['price'] * $prod['quantity'];
		$orderprice = $orderprice + $subtotal;
		echo("<tr><td>" . $prod['id'] . "</td><td>" . $prod['name'] . "</td><td>" . $prod['quantity'] . "</td><td>" . '$' . $prod['price'] . "</td> <td>" . '$' . number_format($subtotal,2) . "</td></tr>");
	}
	
	echo("<h3><strong>The total price for this order is: " . '$' . number_format($orderprice,2) . "</strong></h3>");
	echo("<h3><strong>Please come again</strong></h3></table>");
	echo("<h2 align = 'center'><p><a href='index.php'>Return To Home</a></p></h2>");
	if (isset($_SESSION['authenticatedUser']) && $_SESSION['loggedIn'] == true){  
		echo("<div style = 'position:fixed; bottom:5px; right:5px;'>");
				echo("<p>Logged in as: " . $_SESSION['authenticatedUser'] . "</p>");
				echo("<a href = 'logout.php'>Log Out</a>");
			echo("</div>");
	}
	}
/** Clear session/cart **/
session_destroy();
sqlsrv_close($con);
?>
</body>
</html>

