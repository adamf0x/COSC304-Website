<?php 
    session_start();          
    $authenticatedUser = validateLogin();
    
	if ($authenticatedUser != null){
		$_SESSION['loginMessage'] = null;
		header('Location: index.php'); 
	    }     		// Successful login
    else
		header('Location: login.php');	             // Failed login - redirect back to login page with a message   
		  
    
	function validateLogin()
	{	
	    $user = $_POST["username"];	 
	    $pw = $_POST["password"];
		$retStr = null;

		if ($user == null || $pw == null)
			return null;
		if ((strlen($user) == 0) || (strlen($pw) == 0))
			return null;

		include 'include/db_credentials.php';
		$con = sqlsrv_connect($server, $connectionInfo);
		
		// TODO: Check if userId and password match some customer account. If so, set retStr to be the username.
		$sql = "SELECT userid, password FROM customer WHERE userid = ? AND password = ?";	
		$result = sqlsrv_query($con, $sql, array($user, $pw));
		$valid = true;
		if($result === false){
		$valid = false;
		} elseif(sqlsrv_has_rows($result) === false){
		$valid = false;
		$_SESSION["loginMessage"] = "Could not connect to the system using that username/password.";

		}
		$retStr = null;
		if($valid === true){
			$retStr = $user;
		}
		sqlsrv_free_stmt($pstmt);
		sqlsrv_close($con);
		
		if ($retStr != null)
		{	$_SESSION["loginMessage"] = null;
			$_SESSION["loggedIn"] = true;
			$_SESSION["authenticatedUser"] = $user;
		}
		else
			$_SESSION["loginMessage"] = "Could not connect to the system using that username/password.";


		return $retStr;
	}	
?>