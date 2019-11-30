<!DOCTYPE html>
<html>
<head>
<style>
    table, th, td {
  		border: 1px solid black;
  		width: 60%;
		}
</style>
<title>Your Shopping Cart</title>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
</head>
<title>Administrator Page</title>
</head>
<body>

<?php 
// TODO: Include files auth.php and include/db_credentials.php
include 'include/db_credentials.php';
include 'authadmin.php';
include 'navbar.php';
?>

<?php
// TODO: Write SQL query that prints out total order amount by day
if(isset($_SESSION['errorMsg'])){
    echo ("<h3 style = 'color:black'>" . $_SESSION['errorMsg'] . "</h3>");
}
$_SESSION['errorMsg'] = null;

echo("<div align = 'center'>");
	echo("<h2>Administrator Sales Report by Day</h2>");
echo("</div>");

$con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}

$sql = "SELECT SUM(totalAmount) as tot, orderDate FROM orderSummary GROUP BY orderDate ORDER BY orderDate ASC";
$result = sqlsrv_query($con, $sql, array());
echo('<div class="middle" align = "center">');
	echo("<table><tr><th>Order Date</th><th>Total Order Amount</th></tr>");
		while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			$odate = $row['orderDate'];
			$totalOrderAmount = $row['tot'];
			echo("<tr><td>". $odate->format('Y-m-d') . "</td><td>" . '$' . number_format($row['tot'],2) . "</td></tr>");
		}
	echo("</table>");
echo("</div>");

$sql2 = "SELECT userId FROM customer";
$result2 = sqlsrv_query($con, $sql2, array());
echo('<div class="middle" align = "center">');
	echo("<table><tr><th>Customer List</th></tr>");
		while ($row = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)) {
			$customername = $row['userId'];
			echo("<tr><td>" . $customername . "</td></tr>");
		}
	echo("</table>");


echo("</div>");
echo("<div algin = 'center'>");
	echo("<a href = createproduct.php>Add a new product</a>");
echo("</div>");
echo("<div algin = 'center'>");
	echo("<a href = loaddata.php>reset the DB</a>");
echo("</div>");	

?>
</body>
</html>