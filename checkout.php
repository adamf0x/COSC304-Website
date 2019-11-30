<!DOCTYPE html>
<html>
<head>
<style>
</style>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Adam and Corey's Shoes CheckOut Line</title>
</head>
<body>
<?php
session_start();
include "navbar.php";

$username = "afox";
$password = "24304628";
$database = "db_afox";
$server = "sql04.ok.ubc.ca";
$connectionInfo = array( "Database"=>$database, "UID"=>$username, "PWD"=>$password, "CharacterSet" => "UTF-8");

$con = sqlsrv_connect($server, $connectionInfo);
    if( $con === false ){
        die( print_r( sqlsrv_errors(), true));
    }
    if(isset($_SESSION['authenticatedUser'])){
        $query = "SELECT customerid FROM customer WHERE userid = ?";
        $result = sqlsrv_query($con, $query, array($_SESSION['authenticatedUser']));
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            $cid = $row['customerid'];
            header('Location: order.php?customerId='. $cid);
        }
    }
?>



<h1>Enter your username and password to complete the transaction:</h1>

<?php
    if(isset($_SESSION['loginMessage'])){
        echo("<h2>". $_SESSION['loginMessage']. "</h2>");
    }
?>

<form method="post" action="validateCheckout.php">
<table>
    <tr><td>Username:</td><td><input type="text" name="userid" size="20"></td></tr>
    <tr><td>Password:</td><td><input type="password" name="password" size="20"></td></tr>
    <tr><td><input type="submit" value="Submit"></td><td><input type="reset" value="Reset"></td></tr>
</table>
</form>

</body>
</html>

