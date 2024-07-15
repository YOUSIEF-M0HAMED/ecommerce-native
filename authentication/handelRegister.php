<?php 

include_once "../dbconnection.php";
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST'  ) {
   
    
    
    if(empty($_POST['username'])){
        $_SESSION['error']="username is required";
        header("Location:authentication/register.php");
        exit();
    }
    
    $username = htmlspecialchars($_POST['username']);
    
    
    if(empty($_POST['address'])){
        $_SESSION['error'] ="address is required";
        header("Location:authentication/register.php");
        exit();
    }
    $address = $_POST['address'];
    
    
    if(empty($_POST['phone'])){
        $_SESSION['error'] ="phone is required";
        header("Location:authentication/register.php");
        exit();
    }
    $phone = $_POST['phone'];
    
    if(empty($_POST['email'])){
        $_SESSION['error'] ="email is required";
        header("Location:authentication/register.php");
        exit();
    }
    $email = $_POST['email'];
    
    
    if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['error'] ="valid email format";
        header("Location:authentication/register.php");
        exit();
    
    }
    
    if(empty($_POST['password'])){
        $_SESSION['error'] ="password is required";
        header("Location:authentication/register.php");
        exit();
    
    }
    $password =password_hash( $_POST['password'],PASSWORD_DEFAULT);
    
    
    
    
    $insertQuery = "INSERT INTO users (username,address,phone,email,password) VALUES ('$username','$address','$phone','$email','$password')";
    
                    
                    if ($conn->query($insertQuery) === TRUE) {
                        
                        
                        header("location:../index.php");
    
                    } else {
                        echo "Error: " . $insertQuery . "<br>" . $conn->error;
                    }
                    
                    // Close the connection
                    $conn->close();
                
    
                } else {
                    echo "Sorry, there was an error on submitting data.";
                }
    
                
        