<?php 
session_start(); 
include_once "../dbconnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {

	

	$email=$_POST['email'];
	$pass = $_POST['password'];

	if (empty($email)) {
		header("Location: login.php?error=Email is required");
	    exit();
	}elseif(! filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: login.php?error=Invalid Email Format");
	    exit();
	}elseif(empty($pass)){
        header("Location: login.php?error=Password is required");
	    exit();
	}else{

		$sql = "SELECT * FROM users WHERE email='$email' ";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {

			$row = mysqli_fetch_assoc($result);
			
			$db_password=$row['password'];
			if (password_verify($pass, $db_password)){
				$_SESSION['id'] = $row['id'];
            	$_SESSION['username'] = $row['username'];
            	$_SESSION['email'] = $row['email'];
            	$_SESSION['role'] = $row['role'];

            	header("Location: ../index.php");
		        exit();		
			
			}else{
				header("Location: login.php?error=Incorect password");

			}
		}

		else{
			header("Location: login.php?error=Incorect Email ");
			exit();
		} 
		
	}
	
}else{
	echo "Error on supmitting data";
}