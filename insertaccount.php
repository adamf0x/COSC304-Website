<?php

session_start();

include 'include/db_credentials.php';
include "navbar.php";

$con = sqlsrv_connect($server, $connectionInfo);
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$email = $_GET['email'];
$phonenum = $_GET['phonenum'];
$address = $_GET['address'];
$city= $_GET['city'];
$state = $_GET['state'];
$country = $_GET['country'];
$postalcode = $_GET['postalcode'];
$username = $_GET['username'];
$password = $_GET['password'];

echo($firstname . " " . $lastname. " " . $email . " " . $phonenum . " " . $address . " " . $city . " " . $state . " " . $country . " " . $postalcode . " " . $username . " " . $password);



$sql = "INSERT INTO Customer (firstName, lastName, email, phonenum, address, city, state, postalCode, country, userid, password, isAdmin) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
$results = sqlsrv_query($con, $sql, array($firstname,$lastname,$email,$phonenum,$address,$city,$state,$postalcode,$country,$username,$password, 0));

$query = "SELECT customerId FROM customer WHERE userid = ?";
$result = sqlsrv_query($con, $query, array($username));
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    echo(" " . $row['customerId']);
}

$_SESSION['errorMsg'] = "account created!";
header('Location: index.php'); 


?>