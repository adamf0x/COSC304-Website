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
<body>
<?php 
session_start();
include "navbar.php";
?>

<?php
// Get the current list of products
$productList = null;
if (isset($_SESSION['productList'])){
	echo("<div align = 'center'>");
	$productList = $_SESSION['productList'];
	echo("<h1>Your Shopping Cart</h1>");
	echo("<table><tr><th>Product Id</th><th>Product Name</th><th>Quantity</th>");
	echo("<th>Price</th><th>Subtotal</th></tr>");

	$total =0;
	foreach ($productList as $id => $prod) {
		echo("<tr><td>". $prod['id'] . "</td>");
		echo("<td>" . $prod['name'] . "</td>");

		echo("<td align=\"center\">". $prod['quantity'] . "</td>");
		$price = $prod['price'];

		echo("<td align=\"right\">$" . number_format($price ,2) ."</td>");
		echo("<td align=\"right\">$" . number_format($prod['quantity']*$price, 2) . "</td></tr>");
		echo("</tr>");
		$total = $total +$prod['quantity']*$price;
	}
	echo("<tr><td colspan=\"4\" align=\"right\"><b>Order Total</b></td><td align=\"right\">$" . number_format($total,2) ."</td></tr>");
	echo("</table>");
	echo("<h2><a href=\"checkout.php\">Check Out</a></h2>");
	echo("</div>");
} else{
	echo("<div align = 'center'>");
		echo("<H1>Your shopping cart is empty!</H1>");
	echo("</div>");
}
?>
<div align = 'center'><h2><a href="listprod.php">Continue Shopping</a></h2></div>
</body>
</html> 

