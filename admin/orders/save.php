<?php 

include_once "../../dbconnection.php";
session_start(); 
if($_SESSION['role']==="admin" ){

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['customer_id'])) {
    
if(empty($_POST['customer_id'])){
    $_SESSION['error']="Customer ID is required";
    header("Location:create.php ");
    exit();
}

$customer_id = $_POST['customer_id'];

    $insertQuery = "INSERT INTO orders (customer_id) VALUES ('$customer_id')";
                // Execute the query
                if ($conn->query($insertQuery) === TRUE) {
                    
                    $_SESSION['success']=" order inserted successfully";
                    header("location: create.php");

                } else {
                    echo "Error: " . $insertQuery . "<br>" . $conn->error;
                }
                
                // Close the connection
                $conn->close();
            

            } else {
                $_SESSION['error']=" error on submitting data ";
                header("location: create.php");

            }

            }else{
                header("Location: ../../forbidden_page.php");
            }
    