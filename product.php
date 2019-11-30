<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  width: 60%;
}
</style>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
<title>Adam and Corey's Shoes - Product Information</title>
</head>
<body>

<?php 
	include 'include/db_credentials.php';
?>

<?php
session_start();
include "navbar.php";
echo("<div align = 'center'>");
include 'include/db_credentials.php';
$con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}



// Get product name to search for
// TODO: Retrieve and display info for the product
$id = $_GET['id'];
echo("<div align = 'center'>");


// TODO: If there is a productImageURL, display using IMG tag
$imurl = 'img/'.$id.'.jpg';
$imginsert = "UPDATE product SET productImageURL = ? WHERE productId = ?";
$imgins = sqlsrv_query($con, $imginsert, array($imurl, $id));

$sql = "SELECT productImageURL FROM product WHERE productId = ?";
$result = sqlsrv_query($con, $sql, array($id));
while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
	$imgurl = $row['productImageURL'];
	echo("<img src=" . $imgurl . " alt=image>");
}
$sql3 = "SELECT productDesc FROM product WHERE productId = ?";
$result3 = sqlsrv_query($con, $sql3, array($id));
while ($row = sqlsrv_fetch_array( $result3, SQLSRV_FETCH_ASSOC)) {
	$productDescription = $row['productDesc'];
	echo("<p>" . $productDescription . "</p>");
}
$sql = "SELECT productName, productPrice FROM product WHERE productId = ?"; 
$results = sqlsrv_query($con, $sql, array($id));
while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
	$pname = $row['productName'];
	$pprice = $row['productPrice'];
	$url = "addcart.php?id=" . $id . "&name=" . urlencode($pname) . "&price=" . $pprice;
}
$revUrl = "review.php?id=" . $id;
echo("<div align = 'center'>");
echo("<p style = 'margin-bottom:5px'><a href = listprod.php>Continue Shopping</a></p>");
echo("<p style = 'margin-bottom:5px'><a href = $url>Add to Cart</a></p>");
echo("<p style = 'margin-bottom:5px'><a href =" .  $revUrl . ">Review Product</a></p>");
echo("</div >");
echo("</div>");
$sql = "SELECT productId, productPrice, productName FROM product WHERE productId = ?";
$result = sqlsrv_query($con, $sql, array($id));
echo("<table><tr><th>Product Name</th><th>Product ID</th><th>Price</th></tr>");
while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
	echo("<tr><td>". $row['productName'] . "</td><td>". $row['productId'] . "</td><td>" . '$' . number_format($row['productPrice'],2) . "</td></tr></table>");
}
echo("</div >");

/*
if ($rst = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) 
{
	echo($rst['productId']);
	echo($rst['productPrice']);
	
	echo($rst['productImageURL']);
	$image = $rst['productImageURL'];
    $imageData = base64_encode(file_get_contents($image));
	echo('<img src="data:image/jpeg;base64,'.$imageData.'">');
}
*/
// TODO: Retrieve any image stored directly in database. Note: Call displayImage.php with product id as parameter.
//$binimg = include 'displayImage.php';
// TODO: Add links to Add to Cart and Continue Shopping

echo("</br>");
$reviews2 = "SELECT reviewRating, reviewComment FROM review WHERE productId = ?";
$reviewsResult2 = sqlsrv_query($con, $reviews2, array($id));
echo('<div class="middle" align = "center">');
	echo("<p><strong>Reviews</strong></p>");
	echo("<table><tr><th>Rating</th><th>Review</th></tr>");
		while ($row = sqlsrv_fetch_array($reviewsResult2, SQLSRV_FETCH_ASSOC)) {
			$reviewComment = $row['reviewComment'];
			$reviewRating = $row['reviewRating'];
			echo("<tr><td>" . $reviewRating . "</td><td>" . $reviewComment . "</td></tr>");
		}
	echo("</table>");
echo("</div>");


?>
</body>
</html>