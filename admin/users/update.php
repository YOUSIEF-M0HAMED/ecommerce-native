<?php

include_once "../../dbconnection.php";
session_start();
if($_SESSION['role']==="admin" ){

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['user_id'])
        && isset($_POST['username']) && isset($_POST['address']) 
        && isset($_POST['phone'])  && isset($_POST['email'])  && isset($_POST['password'])  ) {
            
    $currentTimestamp = new DateTime();
    $updated_at = $currentTimestamp->format('Y-m-d H:i:s');
       
    
    if(empty($_POST['user_id'])){
       echo "error: we not received user id";
        exit();
    }
    $user_id=$_POST['user_id'];


    if(empty($_POST['username'])){
        $_SESSION['error'] ="username is required";
        header("Location:edit.php?user_id=$user_id ");
        exit();
    }
    $username=$_POST['username'];

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
        $updateQuery = "UPDATE users SET username='$username', address='$address', phone='$phone', email='$email', updated_at='$updated_at' WHERE id=$user_id";
                // Execute the query
        if ($conn->query($updateQuery) === TRUE) {
            $_SESSION['success']="user updated successfully";
        header("Location: display_all.php");
        } else {
        echo "Error: " . $updateQuery . "<br>" . $conn->error;
}        exit();

    }
    $password =password_hash( $_POST['password'],PASSWORD_DEFAULT);

    
    $updateQuery = "UPDATE users SET username='$username', address='$address', phone='$phone', email='$email', password='$password', updated_at='$updated_at' WHERE id=$user_id";
        // Execute the query
if ($conn->query($updateQuery) === TRUE) {
    $_SESSION['success']="user updated successfully";
header("Location: display_all.php");
} else {
echo "Error: " . $updateQuery . "<br>" . $conn->error;
}


$conn->close();
}else{
    echo "error on submitting data ";
    exit();

}



}else{
    header("Location: ../../forbidden_page.php");
}