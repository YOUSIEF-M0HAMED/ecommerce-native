<?php

include_once "../../dbconnection.php";
session_start();
if($_SESSION['role']==="admin" ){

    if ($_SERVER['REQUEST_METHOD'] === 'POST'  
            && isset($_POST['category_id']) && isset($_POST['name']) && isset($_POST['price'])
            && isset($_POST['quantity']) && isset($_POST['description']) && isset($_FILES['img'])) {

        if(empty($_POST['product_id'])){
            echo "error: Product id cannot be empty";
            exit();
        }
        $product_id=htmlspecialchars($_POST['product_id']);

if(empty($_POST['category_id'])){
            $_SESSION['error'] = " field category is required";
            header('Location: edit.php?product_id=$product_id ');
            exit();
        
        }
        $category_id=htmlspecialchars($_POST['category_id']);


        if(empty($_POST['name'])){
            $_SESSION['error'] = " field name  is required";
            header("Location: edit.php?product_id=$product_id ");
            exit();
        
        }
        $name = htmlspecialchars($_POST['name']);


        if(empty($_POST['price'])){
            $_SESSION['error'] = " field price  is required";
            header("Location: edit.php?product_id=$product_id ");
            exit();

        }
        $price = htmlspecialchars($_POST['price']);



        if(empty($_POST['quantity'])){
            $_SESSION['error'] = " field quantity  is required";
            header("Location: edit.php?product_id=$product_id ");
            exit();

        }
        $quantity = htmlspecialchars($_POST['quantity']);

        if(empty($_POST['description'])){
            $_SESSION['error'] = " field description  is required";
            header("Location: edit.php?product_id=$product_id ");
            exit();

        }
        $description = htmlspecialchars($_POST['description']);


        if(empty($_FILES['img']['tmp_name'])){
                
    if(empty($_POST['old_img_path'])){

    $_SESSION['error'] = " field old_img_path is required";
                header("Location: edit.php?product_id=$product_id ");
                exit();
    }
            $old_img_path=$_POST['old_img_path'];
            $updated_at=date('YmdHis');
            
            $updateQuery = "UPDATE products 
            SET category_id='$category_id', name='$name',price='$price',quantity='$quantity',
            description='$description',img='$old_img_path',updated_at='$updated_at' WHERE id=$product_id";

            // Execute the query
            if ($conn->query($updateQuery) === TRUE) {
                $_SESSION['success'] = " product updated successfully";
                header("Location: display_all.php");
                exit();
            } else {

                $_SESSION['error'] = "Error: " . $insertQuery . "<br>" . $conn->error;
                header("Location: edit.php?product_id=$product_id");
                exit();
            }
            

        }
        
        $currentDateTime = date('YmdHis');

        // Handle file upload
        $targetDir = "images/";
        $targetFile = $targetDir . $currentDateTime . basename($_FILES["img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check === false) {
            $_SESSION['error'] = "File is not an image";
            header("Location: edit.php?product_id=$product_id");
            exit();
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            $_SESSION['error'] = "Sorry, file already exists";
            header("Location: edit.php?product_id=$product_id");
            exit();
        }

        // Check file size
        if ($_FILES["img"]["size"] > 500000) {
            $_SESSION['error'] = "Sorry, your file is too large";
            header("Location: edit.php?product_id=$product_id");
            exit();
        }

        // Allow certain file formats
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed";
            header("Location: edit.php?product_id=$product_id");
            exit();
        }

        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
            $updated_at=date('YmdHis');
            
            $updateQuery = "UPDATE products 
            SET category_id='$category_id', name='$name',price='$price',quantity='$quantity',
            description='$description',img='$targetFile',updated_at='$updated_at' WHERE id=$product_id";            
            // Execute the query
            if ($conn->query($updateQuery) === TRUE) {
                $_SESSION['success'] = " product updated successfully";
                header("Location: display_all.php");
                exit();
            } else {
                $_SESSION['error'] = "Error: " . $updateQuery . "<br>" . $conn->error;
                header("Location: edit.php?product_id=$product_id");
                exit();
            }
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file";
            header("Location: edit.php?product_id=$product_id");
            exit();
        }
    }else{
        $_SESSION['error'] = "Sorry, there was an error on submitting data";
        header("Location: edit.php?product_id=$product_id");

    }
} else {
    header("Location: ../../forbidden_page.php");
    exit();
}

// Close the connection
$conn->close();