<?php 
    session_start();    
    include 'include/db_credentials.php';
	$con = sqlsrv_connect($server, $connectionInfo);     
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenum = $_POST['phonenum'];
    $address = $_POST['address'];
    $city= $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $postalcode = $_POST['postalcode'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpass = $_POST['confirmpass'];


    $valid = true;
    $details = array($firstname, $lastname, $email, $phonenum, $address, $city, $state, $country, $postalcode, $username, $password, $confirmpass);
    for($x = 0; $x < count($details); $x++){
        if(!isset($details[$x]) || $details[$x] == ''){
            echo("missing detail");
            $_SESSION['errorMsg'] = "please enter all account details in order to create account!";
            $valid = false;
            header("Location: createaccount.php");
        }
    }
    
    $sql = "SELECT customerId FROM customer WHERE userid = ?";
    $result = sqlsrv_query($con, $sql, array($username));
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        if($row['customerId'] != null || $row['customeId'] != ''){
            $_SESSION['errorMsg'] = "Username already in use";
            $valid = false;
            $reason = "username in use";
            header("Location: createaccount.php");
        }
    }
    if($username == "" || $username == null){
        $_SESSION['errorMsg'] = "enter a username!";
        $valid = false;
        header("Location: createaccount.php");
    }
    if($password != $confirmpass){
        $_SESSION['errorMsg'] = "the passwords did not match";
        $valid = false;
        header("Location: createaccount.php");
    }
    else if($valid == true){
        $url = "insertaccount.php?firstname=".$firstname."&lastname=".urlencode($lastname)."&email=".$email."&phonenum=".$phonenum."&address=".urlencode($address)."&city=".$city."&state=".urlencode($state)."&country=".$country."&postalcode=".urlencode($postalcode)."&username=".$username."&password=".$password;
        header("Location: ".$url);
    }
    else if($valid == false && $reason == "username in use"){
        $_SESSION['errorMsg'] = "Username already in use";
        header("Location: createaccount.php");
    }
    else{
        $_SESSION['errorMsg'] = "Information was not entered correctly please try again.";
        header("Location: createaccount.php");
    }
?>