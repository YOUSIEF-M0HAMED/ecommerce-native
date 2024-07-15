<?php 

include_once "../../dbconnection.php";
session_start(); 
if($_SESSION['role']==="admin" ){

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_role']) && isset($_POST['username']) && isset($_POST['address']) 
    && isset($_POST['phone'])  && isset($_POST['email'])  && isset($_POST['password'])     ) {
   
    
if(empty($_POST['user_role'])){
    $_SESSION['error']="user_role is required";
    header("Location:create.php ");
    exit() ;
}

$user_role = $_POST['user_role'];


   
if(empty($_POST['username'])){
    $_SESSION['error']="username is required";
    header("Location:create.php ");
    exit();
}

$username = htmlspecialchars($_POST['username']);


if(empty($_POST['address'])){
    $_SESSION['error'] ="address is required";
    header("Location:edit.php?user_id=$user_id");
    exit();
}
$address = $_POST['address'];


if(empty($_POST['phone'])){
    $_SESSION['error'] ="phone is required";
    header("Location:edit.php?user_id=$user_id");
    exit();
}
$phone = $_POST['phone'];

if(empty($_POST['email'])){
    $_SESSION['error'] ="email is required";
    header("Location:edit.php?user_id=$user_id");
    exit();
}
$email = $_POST['email'];


if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
    $_SESSION['error'] ="valid email format";
    header("Location:edit.php?user_id=$user_id ");
    exit();

}

if(empty($_POST['password'])){
    $_SESSION['error'] ="password is required";
    header("Location:edit.php?user_id=$user_id");
    exit();

}
$password =password_hash( $_POST['password'],PASSWORD_DEFAULT);




$insertQuery = "INSERT INTO users (role,username,address,phone,email,password) VALUES ('$user_role','$username','$address','$phone','$email','$password')";

                
                if ($conn->query($insertQuery) === TRUE) {
                    
                    $_SESSION['success']="user inserted successfully";
                    header("location: create.php");

                } else {
                    echo "Error: " . $insertQuery . "<br>" . $conn->error;
                }
                
                // Close the connection
                $conn->close();
            

            } else {
                echo "Sorry, there was an error on submitting data.";
            }

            }else{
                header("Location: ../../forbidden_page.php");
            }
    