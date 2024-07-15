<?php

include_once "../../dbconnection.php";
session_start();
if($_SESSION['role']==="admin" ){

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'])  ) {

    if(empty($_POST['category_id'])){
        echo "error not received category id ";
       exit();
    }

    $category_id=$_POST['category_id'];

    if(empty($_POST['name'])){
        $_SESSION['error'] ="category name is required";
        header("Location:edit.php?category_id=$category_id ");
    exit();
    }

    $name=$_POST['name'];
    $currentTimestamp = new DateTime();
    $updated_at = $currentTimestamp->format('Y-m-d H:i:s');


        $updateQuery = "UPDATE categories SET name='$name', updated_at='$updated_at' WHERE id=$category_id";
        // Execute the query
    if ($conn->query($updateQuery) === TRUE) {
        $_SESSION['success']="category updated successfully";
    header("Location: display_all.php");
    } else {
    echo "Error: " . $updateQuery . "<br>" . $conn->error;
    }
    
    $conn->close();
    }else{
        $_SESSION['error']="error on submitting data";
        header("Location: edit.php?category_id=$category_id ");

    }
    }else{
        header('Location: ../../forbidden_page.php');
    }