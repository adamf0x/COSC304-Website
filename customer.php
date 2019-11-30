<!DOCTYPE html>
<html>
<style>
    table, th, td {
  		border: 1px solid black;
  		width: 60%;
		}
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Customer Page</title>
</head>
<body>

<body>

<?php 
    include 'auth.php';
    include 'include/db_credentials.php';
    include "navbar.php";
?>

<?php
echo("<div align = 'center'>");
$con = sqlsrv_connect($server, $connectionInfo);
$user = $_SESSION['authenticatedUser'];
    
// TODO: Print Customer information
echo("<h1>Customer Information Page</h1>");
$sql = "SELECT customerId, firstName, lastName, email, phonenum, address, city, state, postalCode, country, userid FROM customer WHERE userid = ?";
$result = sqlsrv_query($con, $sql, array($user));
$custid = "";
$firstname = "";
$lastname = "";
$email = "";
$phonenum = "";
$address = "";
$city = "";
$state = "";
$postalcode = "";
$country = "";
$userid = "";
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $custid .= "<td>" . $row['customerId'] . "</td>";  
    $firstname .= "<td>" . $row['firstName'] . "<td>";
    $lastname .= "<td>" . $row['lastName'] . "<td>";
    $email .= "<td>" . $row['email'] . "<td>";
    $phonenum .= "<td>" . $row['phonenum'] . "<td>";
    $address .= "<td>" . $row['address'] . "<td>";
    $city .= "<td>" . $row['city'] . "<td>";
    $state .= "<td>" . $row['state'] . "<td>";
    $postalcode .= "<td>" . $row['postalCode'] . "<td>";
    $country .= "<td>" . $row['country'] . "<td>";
    $userid .= "<td>" . $row['userid'] . "<td>";
}
echo('<table>
        <tr>
            <th>Customer ID</th>' . $custid . '
        </tr>
        <tr>
            <th>First Name</th>' . $firstname . ' 
        </tr>
        <tr>
            <th>Last Name</th>' . $lastname . '
        </tr>
        <tr>
            <th>email</th>' . $email . ' 
        </tr>
        <tr>
            <th>Phone Number</th>' . $phonenum . '
        </tr>
        <tr>
            <th>Address</th>' . $address . '
        </tr>
        <tr>
            <th>City</th>' . $city . '
        </tr>
        <tr>
            <th>State</th>' . $state . '
        </tr>
        <tr>
            <th>Postal Code</th>' . $postalcode . ' 
        </tr>
        <tr>
            <th>Country</th>' . $country . '
        </tr>
        <tr>
            <th>User ID</th>' . $userid . '
        </tr>');

// Make sure to close connection
echo('</div>');
sqlsrv_close($con);
?>
</body>
</html>