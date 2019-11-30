<?php 
    session_start();    
    include 'include/db_credentials.php';
	$con = sqlsrv_connect($server, $connectionInfo);     
    $username = $_POST['userid'];
    $password = $_POST['password'];
    if($username != null){
        $sql = "SELECT firstName FROM customer WHERE userid = ?";
        $result = sqlsrv_query($con, $sql, array($username));
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            if(!isset($row['firstName'])){
                $_SESSION['loginMessage'] = "Incorrect username entered please try again";
                header('Location: checkout.php');
            }
    }

    }
    else{
        $_SESSION['loginMessage'] = "Incorrect username entered please try again";
        header('Location: checkout.php');
    }
    if($password != null){
        $sql = "SELECT password FROM customer WHERE userid = ?";
        $result = sqlsrv_query($con, $sql, array($username));
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            if($row['password'] == $password){
                $sql = "SELECT customerId FROM customer WHERE userid = ?";
                $result = sqlsrv_query($con, $sql, array($username));
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    header('Location: order.php?customerId=' . $row['customerId']);
                }
            }
            else{
                $valid = False;
                $_SESSION['loginMessage'] = "Incorrect password entered please try again";
                header('Location: checkout.php');
            }
        }
    }
    else{
        $_SESSION['loginMessage'] = "Incorrect password entered please try again";
        header('Location: checkout.php');
    }
  