<?php
    session_start();  
    include 'include/db_credentials.php';
    $con = sqlsrv_connect($server, $connectionInfo);
    $admin = False;
    $authenticated = $_SESSION['authenticatedUser']  == null ? false : true;
    if (!$authenticated)
	{
		$loginMessage = "You have not been authorized to access the URL " . $_SERVER['REQUEST_URI'];
        $_SESSION['loginMessage']  = $loginMessage;        
		header('Location: login.php');
	}
    $sql = "SELECT isAdmin FROM customer WHERE userid = ?";
    $result = sqlsrv_query($con, $sql, array($_SESSION['authenticatedUser']));
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        if($row['isAdmin'] == 1){
            $admin = True;
        }
        else{
            $loginMessage = "You have not been authorized to access the URL " . $_SERVER['REQUEST_URI'];
            $_SESSION['loginMessage']  = $loginMessage;        
            header('Location: index.php');
        }
    }
?>
