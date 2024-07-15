<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Custom styles for this template */
    body {
        padding-top: 56px;
    }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">E-Commerce Store</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="aboutUs.php">About Us</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="contactUs.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->

    <div class="carousel-item active">
        <div class="container">


            <h1>About Us</h1>

            <p>Welcome to My Supermarket, your one-stop destination for all your grocery needs. We've been serving our
                community since 1980, and our commitment to quality and service has only grown stronger over the years.
            </p>

            <h2>Our Mission</h2>
            <p>At My Supermarket, our mission is to provide the freshest and highest-quality products to our customers.
                We believe that everyone deserves access to nutritious and delicious food, and we work tirelessly to
                make that a reality for our community.</p>

            <h2>Our Values</h2>
            <p>We take pride in our core values:</p>
            <ul>
                <li>Quality: We source the best products to ensure your satisfaction.</li>
                <li>Community: We are an active part of our community and support local initiatives.</li>
                <li>Sustainability: We are committed to sustainable practices and reducing our environmental impact.
                </li>
                <li>Customer Service: Our friendly staff is always ready to assist you with a smile.</li>
            </ul>

            <h2>Our Team</h2>

            <p>We have a talented and diverse team of experts who are dedicated to achieving our mission. Our team
                members bring a wealth of experience and knowledge to the table, allowing us to tackle even the most
                challenging projects.</p>


            <h2>Our Locations</h2>
            <p>We have multiple convenient locations to serve you better. Visit us at the following addresses:</p>
            <ul>
                <li>Main Store: 1234 Grocery Lane, Cairo</li>
                <li>Branch Store 1: 5678 Market Street,Alexandria</li>
                <li>Branch Store 2: 9876 Food Avenue,Giza</li>
            </ul>

            <h2>Working Hours</h2>
            <p>Our stores are open for your convenience. Here are our regular operating hours:</p>
            <ul>
                <li>Monday-Friday: 8:00 AM - 8:00 PM</li>
                <li>Saturday-Sunday: 9:00 AM - 6:00 PM</li>
            </ul>

        </div>
    </div>




    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>