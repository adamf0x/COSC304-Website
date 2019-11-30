<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Adam and Corey's Grocery</title>
</head>
<body>
<?php

session_start();

include 'include/db_credentials.php';
include "navbar.php";

$prodId = $_GET['prodId'];
$review = $_GET['review'];
$reviewrating = $_GET['reviewrating'];
$userId= $_SESSION['authenticatedUser'];
echo($prodId . " " . $reviewrating . " " . $review);
$reviewrating = intval($reviewrating);
$_SESSION['reviewrating'] = $reviewrating;
$_SESSION['reviewcomment'] = $review;

$username = "afox";
$password = "24304628";
$database = "db_afox";
$server = "sql04.ok.ubc.ca";
$connectionInfo = array( "Database"=>$database, "UID"=>$username, "PWD"=>$password, "CharacterSet" => "UTF-8");
$con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}


$getcusId = "SELECT customerId, isAdmin FROM customer WHERE userId = ?";
$getcusIdr = sqlsrv_query($con, $getcusId, array($userId));
$custId = null;
while ($row = sqlsrv_fetch_array($getcusIdr, SQLSRV_FETCH_ASSOC)) {
		$custId = $row['customerId'];
		$isAdmin = $row['isAdmin'];
}

$checkIfReview = "SELECT reviewId FROM review, customer WHERE review.customerId = ? AND productId = ?";
$checkIfReviewQry = sqlsrv_query($con, $checkIfReview, array($custId, $prodId));

$valid = false;
if($isAdmin == 1){
	$valid = true;
}
if(!$valid){
	if(sqlsrv_has_rows($checkIfReviewQry)){
		$_SESSION['errorMsg'] = "Sorry, but you cant leave 2 reviews on the same product";
	}
}



if($valid){

$insDate = date("Y/m/d");

$sql = "INSERT INTO review (reviewRating, reviewDate, customerId, productId, reviewComment) VALUES (?,?,?,?,?)";
$results = sqlsrv_query($con, $sql, array($reviewrating,$insDate,$custId,$prodId,$review));
}

header('Location: listprod.php'); 

?>
</body>
</html>