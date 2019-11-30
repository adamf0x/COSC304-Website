<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
<?php
	include 'include/db_credentials.php';
	include 'navbar.php';
	$con = sqlsrv_connect($server, $connectionInfo);
	echo("<h1>Connecting to database.</h1><p>");
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$fileName = "./data/orderdb_sql.ddl";
	$file = file_get_contents($fileName, true);
	$lines = explode(";", $file);
	echo("<ol>");
	foreach ($lines as $line){
		$line = trim($line);
		if($line != ""){
			echo("<li>".$line . ";</li><br/>");
			sqlsrv_query($con, $line, array());
		}
	}
	sqlsrv_close($con);
	echo("</p><h2>Database loading complete!</h2>");
?>
</body>
</html>