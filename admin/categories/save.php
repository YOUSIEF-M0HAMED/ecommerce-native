<?php 

include_once "../../dbconnection.php";
session_start(); 
if($_SESSION['role']==="admin" ){

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) ) {
   
if(empty($_POST['name'])){
    $_SESSION['error']="category name is required";
    header("Location:create.php ");
    exit();
}

$name = htmlspecialchars($_POST['name']);

    $insertQuery = "INSERT INTO categories (name) VALUES ('$name')";
                // Execute the query
                if ($conn->query($insertQuery) === TRUE) {
                    
                    $_SESSION['success']="category inserted successfully";
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
                header('Location: ../../forbidden_page.php');
            }
    