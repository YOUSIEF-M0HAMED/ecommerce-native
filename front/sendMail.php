<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
    // Consolidate error handling
    $requiredFields = ['name', 'email', 'subject', 'message'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['error'] = ucfirst($field) . " Field Is Required";
            header("Location:contactUs.php");
            exit();
        }
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Valid Email Format";
        header("Location:contactUs.php");
        exit();
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Specify your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'yousiefmohamed7788@gmail.com'; // SMTP username
        $mail->Password = 'smbqpygyuznatnuy'; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable SSL encryption
        $mail->Port = 465; // TCP port to connect to


        // Sender and recipient settings
        $mail->setFrom($email);  //sender
        $mail->addAddress('yousiefmohamed7788@gmail.com');  //recipient

        // Email content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send email
        $mail->send();
        echo 'Email sent successfully.';
    } catch (Exception $e) {
        echo 'Email sending failed. Error: ' . $mail->ErrorInfo;
    }
} else {
    $_SESSION['error'] = "Error on submitting data";
    header("Location:contactUs.php");
    exit();
}