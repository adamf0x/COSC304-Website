<?php

session_start();

include 'include/db_credentials.php';
include "navbar.php";

$con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	
$productname = $_POST['productname'];
$productprice = $_POST['productprice'];
$productimage = $_POST['productimgurl'];
$productdesc = $_POST['productdesc'];
$productcat = $_POST['productcat'];



$sql = "INSERT INTO Product (productName, productPrice, productImageURL, productDesc, categoryId) VALUES (?,?,?,?,?)";
$results = sqlsrv_query($con, $sql, array($productname,$productprice,$productimage,$productdesc,$productcat));

$query = "SELECT productId FROM product WHERE productName = ?";
$result = sqlsrv_query($con, $query, array($productname));
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    echo(" " . $row['productId']);
}

$_SESSION['errorMsg'] = "product created!";
header('Location: admin.php'); 


?>