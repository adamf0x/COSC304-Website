<!DOCTYPE html>
<html>
<head>
<style>

table, th, td {
    border: 1px solid black;
    width: 60%;
    background-attachment: fixed;
  }
table#t01 {
			width: 100%;
			background-color: #FFFF7E;
			border-collapse:collapse;
			align: right;
	}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Adam and Corey's Shoes Order List</title>
</head>
<body>


<?php
include 'include/db_credentials.php';
session_start();
include "navbar.php";
echo("<div align = 'center'>");
echo('<h1>Order List</h1>');
/** Create connection, and validate that it connected successfully **/

/**
Useful code for formatting currency:
	number_format(yourCurrencyVariableHere,2)
**/

/** Write query to retrieve all order headers **/

/** For each order in the results
		Print out the order header information
		Write a query to retrieve the products in the order
			- Use sqlsrv_prepare($connection, $sql, array( &$variable ) 
				and sqlsrv_execute($preparedStatement) 
				so you can reuse the query multiple times (just change the value of $variable)
		For each product in the order
			Write out product information 
**/


/** Close connection **/
$username = "afox";
	$password = "24304628";
	$database = "db_" . $username;
	$server = "sql04.ok.ubc.ca";
	$connectionInfo = array( "Database"=>$database, "UID"=>$username, "PWD"=>$password, "CharacterSet" => "UTF-8");

	$con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$sql = "SELECT orderId, orderDate, totalAmount, customerId FROM ordersummary";
	$results = sqlsrv_query($con, $sql, array());

	if(!$results){
		echo("<h2>the query failed to execute</h2>");
		exit();
	}

	echo("<table><tr><th>Order ID</th><th>order date</th><th>customer ID</th><th>Total Amount</th></tr>");
	while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
		$orderdate = $row['orderDate'];
		$datestring = $orderdate->format('Y-m-d H:i:s');
		echo("<tr><td>" . $row['orderId'] . "</td><td>" . $datestring . "</td><td>" . $row['customerId'] . "</td><td>" . '$' . number_format($row['totalAmount'],2) . "</td></tr>");
		$orderid = $row['orderId'];
		$sql2= "SELECT productId, quantity, price FROM orderproduct WHERE orderid = $orderid";
		$results2 = sqlsrv_query($con, $sql2, array());
		echo("<td colspan = '4'><table id = 't01'><tr><th>product id</th><th>quantity</th><th>price</th></tr></td>");
		while ($row2 = sqlsrv_fetch_array( $results2, SQLSRV_FETCH_ASSOC)) {
			echo("<tr><td>" . $row2['productId'] . "</td><td>" . $row2['quantity'] . "</td><td>" . '$' . number_format($row2['price'],2) . "</td></tr>");
		}
		echo("</table>");
	}
	echo("</table>");
	/*
	$sql3 = "SELECT userid, password FROM customer";
	$results3 = sqlsrv_query($con, $sql, array());
	echo("<table><tr><th>User ID</th><th>password</th></tr>");
	while ($row3 = sqlsrv_fetch_array( $results3, SQLSRV_FETCH_ASSOC)) {
		echo("<tr><td>" . $row['userId'] . "</td><td>" .  $row['password'] . "</td></tr>");
	}
	echo('</table>');
	*/
	echo("</div>");
	sqlsrv_close($con);
?>


</body>
</html>

