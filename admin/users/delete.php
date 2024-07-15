<?php 
include_once "../../dbconnection.php";
session_start();
if($_SESSION['role']==="admin" ){

if (isset($_GET['user_id'])){

    if(empty($_GET['user_id'])){
        $_SESSION['error'] ="User ID is required";
        header("Location:display_all.php");
        exit();
    
    }
    $user_id=$_GET['user_id'];
    $deleteQuery = "DELETE FROM users WHERE id=$user_id ";

    if($conn->query($deleteQuery)===TRUE){
        header("location: display_all.php");
    }
    
else{
    echo "Error: " . $deleteQuery . "<br>" . $conn->error;

}
}

}else{
    header("Location: ../../forbidden_page.php");
}